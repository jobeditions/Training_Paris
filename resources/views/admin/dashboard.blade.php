@extends('admin.layouts.app')

@section('page_name')
    Accueil
@endsection

@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">&Eacute;coles</h3>
                <ul class="list-inline two-part">
                    <li><i class="glyphicon glyphicon-education text-info"></i></li>
                    <li class="text-right"><span class="counter">{{ $schools }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">&Eacute;lèves</h3>
                <ul class="list-inline two-part">
                    <li><i class="icon-people text-purple"></i></li>
                    <li class="text-right"><span class="counter">{{ $students }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Examens</h3>
                <ul class="list-inline two-part">
                    <li><i class="fa fa-times-circle text-danger"></i></li>
                    <li class="text-right"><span class="counter">{{ $exams }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">Matières</h3>
                <ul class="list-inline two-part">
                    <li><i class="ti-wallet text-success"></i></li>
                    <li class="text-right"><span class="counter">117</span></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /row -->
@endsection
