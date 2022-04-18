@extends('frontend.layouts.ins-master')
@section('content')
<style>
    #chat-area {
		height: 100%;
	}
</style>
@if(Auth::guard('author')->check())
<div class="row-author">
@else
<div class="container mt-40">
<div class="row">
@endif
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-comments"></i> {{__('Messages')}}</h2>
    </div>
</div>
@if(Auth::guard('author')->check())
<div class="row-author">
@else
<div class="row">
@endif
    <div class="col-12">
        <div class="all_msg_bg">
            <div class="row no-gutters">
                <div class="col-xl-4 col-lg-5 col-md-12">
                    <div class="msg_search">
                        <div class="ui search focus">
                            <div class="ui left icon input swdh11 swdh15">
                                <h2 class="st_title"><i class="uil uil-comments"></i> {{__('Messages List')}} </h2>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-content-wrapper">
                        <div class="group_messages">
                            @php
							 $ac = $chat->id ?? 0;
                            @endphp
                            @foreach($data as $d)

                            <div class="chat__message__dt {{ $ac == $d->id ? 'active' : ''}}" data-gid="{{$d->id}}">
                                <div class="user-status">
                                    <div class="user-avatar">
                                        <img src="{{ file_asset($d->user->image ?? 'default.svg') }}" alt="">
                                    </div>
                                    <p class="user-status-title"><span class="bold">{{$d->user->name ?? "No Data"}}</span></p>
                                    <p class="user-status-text">{{$d->last_msg ?? "нет сообщений"}}</p>
                                    <p class="user-status-time floaty">
									
									@isset($d->last_msg) {{$d->last_chat->diffForHumans()}} @endisset
									
									</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if ($chat)
                <div class="col-xl-8 col-lg-7 col-md-12">
                    <input type="hidden" id="gid" name="gid" value="{{$chat->id}}">
                    <input type="hidden" id="user-type" name="user-type" value="{{Auth::guard('author')->check() ? 'author' : 'customer' }}">
                    <input type="hidden" id="user-id" name="user-id" value="{{Auth::id()}}">
                    <input type="hidden" id="send-uri" name="send-uri" value="{{Auth::guard('author')->check() ? route('ins-message.send'): route('stu-message.send')}}">
                    <input type="hidden" id="getmsguri" name="getmsguri" value=" {{Auth::guard('author')->check() ? route('ins-message.ajax') : route('message.ajax') }}">
                    <div class="chatbox_right">
                        <div class="chat_header">
                            <div class="user-status">
                                <div class="user-avatar">
                                    <img src="{{ file_asset($chat->user->image ?? 'default.svg') }}" alt="" id="select-user-img">
                                </div>
                                <p class="user-status-title"><span class="bold" id="select-user-title">{{$chat->user->name ?? "No Data"}}</span></p>
                            </div>
                        </div>
                        <div class="messages-line simplebar-content-wrapper2 scrollstyle_4">
                            @if (count($chat->messages) <= 0) <input type="hidden" name="lastmsg" id="lastmsg" value="0">
                                @else
                                <input type="hidden" name="lastmsg" id="lastmsg" value="{{$chat->messages->last()->id}}">
                                @endif
                                <div class="mCustomScrollbar" id="chat-area">

                                    @foreach ($chat->messages as $msg)

                                    @if(($msg->sender_id == "customer" && Auth::guard('customer')->check()) || ($msg->sender_id == "author" && Auth::guard('author')->check()))
                                    <div class="main-message-box ta-right">
                                        <div class="message-dt float-right">
                                            <div class="message-inner-dt float-right">
                                                <p class="msg-p">{{$msg->msg}}</p>
                                            </div>
                                            <br>
                                            <!--message-inner-dt end-->
                                            <span> {{$msg->created_at->diffForHumans()}}</span>
                                        </div>
                                        <!--message-dt end-->
                                    </div>
                                    @else
                                    <div class="main-message-box st3">
                                        <div class="message-dt st3">
                                            <div class="message-inner-dt">
                                                <p>{{$msg->msg}}</p>
                                            </div>
                                            <!--message-inner-dt end-->
                                            <span>{{$msg->created_at->diffForHumans()}}</span>
                                        </div>
                                        <!--message-dt end-->
                                    </div>
                                    @endif
                                    @endforeach</div>
                        </div>
                        <div class="message-send-area">

                            <div class="mf-field">
                                <div class="ui search focus input__msg">
                                    <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" id="chat-box" name="chat-box"
                                            placeholder="Write a message...">
                                    </div>
                                </div>
                                <button class="add_msg" onclick="sendMessage()"><i class="uil uil-message"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
                @else
                <div class="col-xl-8 col-lg-7 col-md-12">
                  <x-nodata></x-nodata>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script src="{{ static_asset('frontend/js/messages.js')}}"></script>
<script>
$(function(){
	$(".messages-line").animate({scrollTop: $('#chat-area').prop("scrollHeight")}, 1000);
});
</script>
@endpush