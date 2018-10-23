@extends('teachers.layouts.app')

@section('page_name')
    Version
@endsection

@section('content')
    @if (count($versions)>0)
        @foreach ($versions as $version)
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <h4>Version {{ $version->version_number }}</h4>
                        <hr/>
                        @markdown($version->update)
                    </div>
                </div>
            </div>
        @endforeach
    @else
    @endif

@endsection