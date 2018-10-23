<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class Meyenii extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meyenii:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        echo "\n==================================\n";
        echo "Meyenii - ".date('d-m-Y H:i:s');
        echo "\n==================================\n";

        $documents = \App\AssignmentDocument::whereNull("meyenii")->get();
        foreach ($documents as $document) {
            $file = storage_path("app/uploaded/students/".$document->path);
            echo "Analyzing ".$document->path."... ";
            $output = exec('node '.app_path("Console/Node/app.js").' '.$file.' -q -l 60');// -w 40 5 "lutins"
            $document->meyenii = $output;
            $document->save();
            echo "Done !\n";
        }

        /*if ($handle = opendir(storage_path("app/uploaded/students"))) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $file = storage_path("app/uploaded/students/".$entry);
                    echo "Analyzing ".$file."\n";
                    $output = exec('node '.app_path("Console/Node/app.js").' '.$file.' -q -l 60');// -w 40 5 "lutins"
                    $output = json_decode($output);
                    $score = $output->tests->levenshtein->score ;
                    echo $score."\n";

                    DB::table("assignments_documents")->where("path", $entry)->update(["plagiarism" => $score]);
                }
            }
            closedir($handle);
        }*/


        echo "\n==================================\n";
    }
}
