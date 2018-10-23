//============================================
//Dépendances
    const fs = require("fs");
    const path = require("path");
    const PDFParser = require("pdf2json");
    const Levenshtein = require("levenshtein");
    const http = require("http");
    const https = require("https");
    const htmlToText = require("html-to-text");
    const printJSON = require("prettyjson");

//============================================
//Initialisation
    let modules = {} ;
    let output = {tests:{}, status:"pending"} ;
    let analyzed = {global:0, local:0}, count = {global:0, local:0};
    let file = process.argv[2], content = "" ;
    if ((process.argv.indexOf("-q") >= 0)||(process.argv.indexOf("--quiet") >= 0)) { console.info = console.error = () => { /* EMPTY */ }; }
    if (!fs.existsSync(file)) { console.error(`${file} not found`) ; output.status = "error" ; }

//============================================
//Lecture du fichier
    var Start = function File() {
        let parser = new PDFParser(this, 1);
        //Erreur
            parser.on("pdfParser_dataError", (err) => {
                console.error(`An error occured : ${err}`) ;
                output.status = "error" ;
            })
        //Lu
            parser.on("pdfParser_dataReady", (data) => {
                console.info(`File content successfully retrievied`) ;
                content = parser.getRawTextContent() ;
                Modules();
            })
        parser.loadPDF(file);
    }

//============================================
//Lectures des modules actifs
    let jump = 0;
    function Modules() {
        if (output.status == "error") { End() ; } else { output.status = "analyzing" ; }
        console.info(`Checking enabled modules...`) ;
        process.argv.forEach((v, i, a) => {
            //Jump
                if (jump-- > 0) { return ; } else { jump = Math.max(0, jump) ; }
            //Levenshtein
                if ((v == "-l")||(v == "--levenshtein")) {
                    let trigger = Number.isFinite(parseFloat(a[i+1])) ? (jump = 1, parseFloat(a[i+1])) : 101 ;
                    modules.levenshtein = trigger ;
                    count.global++;
                    console.info(`Levenshtein, trigger ${modules.levenshtein <= 100 ? "at "+modules.levenshtein : "disabled"}`) ;
                }
            //Vérifier sur les internets
                if ((v == "-w")||(v == "--web")) {
                    let check = Number.isFinite(parseFloat(a[i+1])) ? (jump = 1, parseFloat(a[i+1])) : 5 ;
                    let trigger = Number.isFinite(parseFloat(a[i+2])) ? (jump++, parseFloat(a[i+2])) : 15 ;
                    let subject = (typeof a[i+jump+1] == "string")&&(a[i+jump+1].charAt(0) != "-") ? a[i+jump+1] : "" ; if (subject.length) { jump++; }
                    modules.web = subject.length ? {check, subject, trigger} : undefined ;
                    count.local += modules.web ? 1 : 0;
                    console.info(`Web checker, ${modules.web ? `check ${modules.web.check} sites about ${modules.web.subject}, trigger at ${modules.web.trigger}` : "auto-disabled because no subject was provided"}`) ;
                }
        })
        if (count.local) { LocalAnalyze(); }
        if (count.global) { Files(); }
        End();
    }

//============================================
//Lectures des autres fichiers
    function Files() {
        console.info(`Checking file directory...`)
        let dir = file.substr(0, file.lastIndexOf("/")) ;
        let files = fs.readdirSync(dir), fname = file.substr(file.lastIndexOf("/")+1) ;
        count.global = files.length - 1 ;
        console.info(`${count.global} other file(s) found in ${dir}`) ;
        files.forEach((f) => {
            if (f == fname) { return ; } else { f = path.join(dir, f); }
            let parser = new PDFParser(this, 1) ;
            //Erreur
                parser.on("pdfParser_dataError", (err) => {
                    console.error(`${f} : An error occured`) ;
                    analyzed.global++;
                    End();
                })
            //Lu
                parser.on("pdfParser_dataReady", (data) => {
                    console.info(`${f} : Tests in progress`) ;
                    Analyze(f, parser.getRawTextContent()) ;
                })
            parser.loadPDF(f);
        }) ;
    }

//============================================
//Application des modules
    function Analyze(f, fcontent) {
        if (modules.levenshtein != undefined) { ModuleLevenshtein(f, fcontent /*, /uploaded[/\\]{1,2}students[/\\]{1,2}(.*)/ */) ; }
        analyzed.global++;
        End();
    }

    function LocalAnalyze() {
        if (modules.web != undefined) { ModuleWeb() ; }
        End();
    }

//============================================
//Levenshtein
    function ModuleLevenshtein(f, fcontent, pattern = /storage.app.uploaded.student.(.*)/) {
        let score = ModuleComponentLevenshtein(fcontent) ;
        if (!output.tests.levenshtein) { output.tests.levenshtein = {score:0, suspects:[]} ; }
        output.tests.levenshtein.score += score;
        if (score >= modules.levenshtein) { output.tests.levenshtein.suspects.push(f.match(pattern)[1]) ; }
        console.info(`Levenshtein <${f}> : ${score}`);
    }

    function ModuleComponentLevenshtein(fcontent) {
        let max = Math.max(content.length, fcontent.length) ;
        let levenshtein = new Levenshtein(content, fcontent);
        let score = 1-(levenshtein.distance/max) ;
        score = Math.round(score*100000)/1000 ;
        return score ;
    }


    function ModuleWeb() {
        console.info(`Web Check in progress`);
        let subject = modules.web.subject ;
        let check = modules.web.check
        let banned = /(?:webcache)|(?:youtube)|(?:facebook)|(?:pinterest)|(?:google)/
        ModuleWeb.checked = 0;
        let pending = 0;
        let visited = new Set();

        if (!output.tests.web) { output.tests.web = {score:0, suspects:[]} ; }


        ModuleComponentWeb("www.google.fr", `/search?q=${encodeURIComponent(subject)}`, {
            success(body) {
                let links = body.match(/(?:url\?q=)[.:/?#@!$&'()*+,;=%\[\]\w_-]+/g) ;
                if (links == null) { return ; }
                for (let i = 0; i < links.length; i++) {
                    if (ModuleWeb.checked < check) {
                        //Skip si site en liste noire
                            if (links[i].match(banned)) { continue ; }
                            let secure = (links[i].match(/https:\/\//) != null);
                            let link = links[i].match(/(?:url\?q=)([.:/?#@!$&'()*+,;=%\[\]\w_-]+)/)[1].replace(/&amp;sa=U&amp;ved=.*/, "").replace(/https?:\/\//, "")
                        //Test
                            let host = link.match(/[.\w-_]+/)[0]
                            if (visited.has(host)) { continue ; } else { visited.add(host) ; }
                            let path = link.substr(link.indexOf("/"))
                            ModuleWeb.checked++; pending++;
                        //Analyse
                            console.info(`Analyse de ${host}${path}`)
                            ModuleComponentWeb(host, path, {
                                error(e) {
                                    console.error(`Web <${host}>, erreur : ${e.message}`);
                                    pending--;
                                    if (pending <= 0) { analyzed.local++; End(); }
                                },
                                success(data) {
                                    //Levenshtein
                                        let text = htmlToText.fromString(data, {ignoreHref:true, ignoreImage:true, noLinkBrackets:true});
                                        let score = ModuleComponentLevenshtein(text)
                                    //
                                        output.tests.web.score += score;
                                        if (score >= modules.web.trigger) { output.tests.web.suspects.push(`${host}${path}`) ; }
                                        console.info(`Web <${host}> : ${score}`);
                                    //
                                        pending--;
                                        if (pending <= 0) { analyzed.local++; End(); }
                                }
                            }, secure)

                        //
                    } else if (pending <= 0) { analyzed.local++; End(); }
                }
            }
        })
    }

    function ModuleComponentWeb(host, path, callback, secure) {
        //Compatibilité
            if (typeof path != "string") { callback = arguments[1] ; path = "/" ; }
            if (!callback) { callback = {} }
            if (!callback.error) { callback.error = (e) => console.error(`Une erreur s'est produite : ${e.message}`) }
            if (!callback.success) { callback.success = (d) => console.info(d) }

        //Options
            let options = {
                host, path,
                port:secure ? 443 : 80, method: "GET"
            };

        //Requête
            var req = (secure ? https : http).request(options, function(res) {
                //Succès
                    if (res.statusCode == 200) {
                        res.setEncoding('utf8');
                        let data = "";
                        res.on('data', d => data += d );
                        res.on('end', () => { callback.success(data) ; });
                    }
            });
            req.on('error', callback.error);
            req.end();
    }


    function End() {
        if (output.status == "error") {

            console.log(JSON.stringify(output))
        } else if ((analyzed.global >= count.global)&&(analyzed.local >= count.local)&&(output.status == "analyzing")) {
            output.status = "success";

            if (modules.levenshtein != undefined) {
                let score = output.tests.levenshtein.score/Math.max(1, count.global) ;
                output.tests.levenshtein.score = Math.round(score*1000)/1000 ;
            }

            if (modules.web != undefined) {
                let score = output.tests.web.score/Math.max(1, ModuleWeb.checked) ;
                output.tests.web.score = Math.round(score*1000)/1000 ;
            }
            console.info("==== DEBUG  ======================")
            console.info(printJSON.render(output))
            console.info("==== OUTPUT ======================")
            console.log(JSON.stringify(output))
        }

    }

//============================================
//Lancement
    if (output.status == "error") { End() ; } else { Start() ; }
