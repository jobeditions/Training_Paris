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
                    <h5>FAQ</h5>

                    <h3>Comment puis-je m'inscrire ?</h3>
                    <p>TeacherHawk est actuellement en bêta fermé, ce qui signifie que les inscriptions ne sont
                        pour le moment pas ouvertes à tous. Si vous avez reçus une clé pour vous inscrire,
                        rendez vous sur <a href="{{url('register')}}">cette page</a>. Si vous souhaitez tester TeacherHawk,
                        n'hésitez pas à nous envoyer un email à <a href="mailto:beta@liigem.io">beta@liigem.io</a>.
                    </p>

                    <hr />

                    <h3>Mon établissement souhaiterait abandonner le système qui gère actuellement les devoirs et passer à TeacherHawk. Comment faire ?</h3>
                    <p>Nous pouvons probablement vous aider à transférer les données. Envoyez-nous un email
                        à <a href="mailto:contact@liigem.io">contact@liigem.io</a> pour que nous puissons voir ce qu'il est possible de faire.</p>

                    <hr />

                    <h3>Quand TeacherHawk sera-t-il accessible au grand public ?</h3>
                    <p>Nous sommes actuellement en période de test. Selon les retours qui nous sont fait, TeacherHawk prendra plus ou moins de temps
                    à passer en bêta publique.</p>

                    <hr />

                    <h3>Il y a-t-il de la place pour moi dans votre équipe ?</h3>
                    <p>Probablement ! N'hésitez pas à nous faire parvenir votre CV par email.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
