@extends('frontoffice.layouts.app')

@section('content')
    <style>
        section.header-fix {
            padding: 56px;
        }
    </style>

    <section class="header-fix dark" data-overlay="9"></section>

    <section class="extra-pad">
        <div class="container">
            <div class="content-fixer">
                <div class="content-holder">
                    <h5>Bienvenue sur TeacherHawk</h5>
                    <h2>Qu'est ce que TeacherHawk ?</h2>
                    <p>TeacherHawk est un outil puissant développé dans le but de faciliter les communications élève-professeurs en dehors des
                        heures de cours. Il permet aux professeurs de diffuser simplement devoirs, documents, liens ou autre à ses différentes
                        classes. Si le professeur le souhaite, il peut collecter les devoirs en ligne. Les devoirs seront ensuite facilement exportables, et pourront passer
                        par notre filtre anti-plagiat.
                    </p>
                    <h2>D'où vient TeacherHawk ?</h2>
                    <p>La première version de TeacherHawk fu développée par la société Weokit dés 2013. Rapidement abandonné, le projet est relancé mi-2016 lorsque Weokit ferme et que certains des associés de cette première entreprise décident d'en lancer
                    une nouvelle, Liigem. Une deuxième version, forte des retours fait à la première, est donc en développement depuis cette période</p>
                    <h2>Qu'avez vous de plus que vos concurrents ?</h2>
                    <p>
                        Beaucoup de choses ! Notre gestion des devoirs est extrêmement complète, et gère parfaitement un grand nombre de situations un peu spéciales, de demis groupes,
                        de groupes de travail, etc. TeacherHawk laisse les professeurs uploader 10G de fichiers, soit très largement plus que la plupart de ses concurrents.<br />
                       </p>
                    <p> Nous avons développé une interface de travail sobre, agréable et simple à l'utilisation. </p>
                    <p>
                        Mais ce qui fait une de nos plus grandes forces, c'est surtout d'être dans les premiers à proposer la collecte de devoirs en lignes pairée d'un système anti-plagiat.
                    </p>
                    <p>
                        Economisant temps, papier et évitant de la tricherie, les possibilités qu'offrent notre système seront indispensables dans le monde de l'éducation de demain. Alors, n'attendez plus, et rejoignez la bêta !
                    </p>
                </div>
            </div>
        </div>
    </section>



@endsection
