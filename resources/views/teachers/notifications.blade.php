@extends('teachers.layouts.app')

@section('page_name')
    Notifications
@endsection

@section('content')
    @if (count(Auth::user()->notifications)>0)
        @foreach (Auth::user()->notifications as $notification)
            {{    $notification->markAsRead() }}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">
                        @markdown($notification->data['content'])
                        <em>{{ $notification->created_at }}</em>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        Aucune notification actuellement
    @endif

@endsection