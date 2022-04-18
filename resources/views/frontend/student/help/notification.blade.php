@extends('frontend.layouts.ins-master')
@section('content')
@if(Auth::guard('author')->check())
<div class="row-author">
@else
<div class="container mt-40">
<div class="row">
@endif
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-bell"></i> {{__('Notifications')}}</h2>
    </div>
</div>
@if(Auth::guard('author')->check())
<div class="row-author">
@else
<div class="row">
@endif
    <div class="col-12">
        <div class="all_msg_bg">
            @foreach ($noti as $n)
            <div class="channel_my item all__noti5">
                <div class="profile_link">
                    <div id="noti-avtar" class="bg-danger text-white">{{substr($n->title, 0, 1)}}</div>
                    <div class="pd_content">
                        <p class="noti__text5">{{$n->title}}</p>
                        <span class="nm_time">{{$n->created_at->diffForHumans()}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection