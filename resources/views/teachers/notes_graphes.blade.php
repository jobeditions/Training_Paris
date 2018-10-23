@extends('teachers.layouts.app')

@section('page_name')
    Graphique des notes
@endsection

@section('javascript')
    <script>
        Morris.Line({
            element: 'morris-moyennes',
            data: [{
                y: '0',
                moyenne: 0
            }, {
                y: '1',
                moyenne: 0
            }, {
                y: '2',
                moyenne: 0
            }, {
                y: '3',
                moyenne: 0
            }, {
                y: '4',
                moyenne: 1
            }, {
                y: '5',
                moyenne: 1
            }, {
                y: '6',
                moyenne: 2
            }, {
                y: '7',
                moyenne: 1
            }, {
                y: '8',
                moyenne: 1
            }, {
                y: '9',
                moyenne: 2
            }, {
                y: '10',
                moyenne: 10
            }, {
                y: '11',
                moyenne: 2
            }, {
                y: '12',
                moyenne: 0
            }, {
                y: '13',
                moyenne: 0
            }, {
                y: '14',
                moyenne: 1
            }, {
                y: '15',
                moyenne: 2
            }, {
                y: '16',
                moyenne: 6
            }, {
                y: '17',
                moyenne: 4
            }, {
                y: '18',
                moyenne: 3
            }, {
                y: '19',
                moyenne: 5
            }, {
                y: '20',
                moyenne: 2
            }],
            xkey: 'y',
            ykeys: ['moyenne'],
            labels: ['Moyenne'],
            gridLineColor: '#eef0f2',
            lineColors: ['#a3a4a9'],
            lineWidth: 1,
            hideHover: 'auto',
            resize: true
        });
    </script>

    <script>
        Morris.Bar({
            element: 'morris-stab',
            data: [{
                y: 'Baisse',
                a: 10
            }, {
                y: 'Stable',
                a: 2
            }, {
                y: 'Hausse',
                a: 21
            }],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Elèves'],
            barColors: ['#b8edf0', '#b4c1d7', '#fcc9ba'],
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            resize: true
        });
    </script>
@endsection

@section('content')
<div class="panel panel-inverse">
    <div class="panel-heading">Statistiques de la classe *_classe_*</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
              <div class="col-xs-12 col-md-6">
              <h3>Par moyenne</h3>
                  <div id="morris-moyennes"
                       style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
            </div>

              <div class="col-xs-12 col-md-6">
                  <h3>Par stabilité</h3>
                  <div id="morris-stab"
                       style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
            </div>
          </div>

        </div>
    </div>
</div>
@endsection
