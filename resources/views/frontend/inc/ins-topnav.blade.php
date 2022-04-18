<header class="header clearfix">
    <button type="button" id="toggleMenu" class="toggle_menu">
        <i class='uil uil-bars'></i>
    </button>
    <button id="collapse_menu" class="collapse_menu">
        <i class="uil uil-bars collapse_menu--icon "></i>
        <span class="collapse_menu--label"></span>
    </button>
    <div class="main_logo" id="logo">
        
        <a href="{{route('ins-home')}}"><img src="{{ static_asset('frontend/images/logo.svg ')}}" alt=""></a>
        <a href="{{route('ins-home')}}"><img class="logo-inverse" src="{{ static_asset('frontend/images/ct_logo.svg')}}" alt=""></a>
    </div>
    <div class="top-category">
        
    </div>
    <div class="search120">
       
    </div>
    <div class="header_right">
        <ul>
            <li>
                <a href="{{ route('courses.create') }}" class="upload_btn">{{__('Create New   Course')}}</a>
            </li>
        @if(Auth::guard('author')->check())
        @php
        $nl = Auth::guard('author')->user()->notifications->take(5);
        $nc= count($nl);
        $lc=Auth::guard('author')->user()->latestChat->take(5);
        $lcc=count($lc);
        @endphp
        @else
        @php
        $nc = 0;
        $nl = [];
        $lcc = 0;
        $lc = [];
        @endphp
        @endif
        <li class="ui dropdown">
            <a href="#" class="option_links" title="{{__('Messages')}}"><i class='uil uil-envelope-alt'></i>@if($lcc>0)<span class="noti_count">{{$lcc}}</span>@endif</a>
            <div class="menu dropdown_ms">
                @forelse ($lc as $ch)

                <a href="/author/messages/{{$ch->user_two}}" class="channel_my item">
                    <div class="profile_link">
                        <img src="{{ file_asset($ch->user->image ?? 'default.svg') }}" alt="">
                        <div class="pd_content">
                            <h6>{{$ch->user->name ?? __('No Data')}}</h6>
                            <p>{{$ch->last_msg}}</p>
                            <span class="nm_time">{{$ch->last_chat->diffForHumans()}}</span>
                        </div>
                    </div>
                </a>
                @empty
                <a href="#" class="channel_my item">
                    <div class="profile_link">
        
                        <div class="pd_content">
        
                            <p>{{__('No Chat')}}</strong>.</p>
                            <span class="nm_time">{{__('Ones upon time')}}</span>
                        </div>
                    </div>
                </a>
                @endforelse
                <a class="vbm_btn" href="{{ route('ins-messages') }}">{{__('View All')}} <i class='uil uil-arrow-right'></i></a>
            </div>
        </li>
            <li class="ui dropdown">
                <a href="#" class="option_links" title="{{__('Notifications')}}"><i class='uil uil-bell'></i>@if($nc>0)<span class="noti_count">{{$nc}}</span>@endif</a>
                <div class="menu dropdown_mn">
                    @forelse ($nl as $item)
                    <a href="{{route('ins-notification')}}" class="channel_my item">
                        <div class="profile_link">
            
                            <div class="pd_content">
            
                                <p>{{$item->title}}</p>
                                <span class="nm_time">{{$item->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <a href="#" class="channel_my item">
                        <div class="profile_link">
            
                            <div class="pd_content">
            
                                <p>{{__('No Notifications')}}</strong>.</p>
                                <span class="nm_time">{{__('Ones upon time')}}</span>
                            </div>
                        </div>
                    </a>
                    @endforelse
            
            
                    <a class="vbm_btn" href="{{route('ins-notification')}}">{{__('View All')}}<i class='uil uil-arrow-right'></i></a>
                </div>
            </li>
            <li class="ui dropdown">
                <a href="#" class="opts_account">
                    <img src="/{{ auth('author')->user()->image ?? static_asset('frontend/images/hd_dp.jpg') }}" alt="">
                </a>
                <div class="menu dropdown_account">
                    <div class="channel_my">
                        <div class="profile_link">
                            <img src="/{{auth('author')->user()->image ?? static_asset('frontend/images/hd_dp.jpg')}}" alt="">
                            <div class="pd_content">
                                <div class="rhte85">
                                    <h6>{{auth('author')->user()->name ?? __('Guest')}}</h6>
                                    @if (isset(auth('author')->user()->verify_pro) && auth('author')->user()->verify_pro == 1)
                                    <!-- <div class="mef78" title="Verify">
                                        <i class='uil uil-check-circle'></i>
                                    </div> -->
                                    @endif
                                </div>
                                <span>{{auth('author')->user()->email ?? __('')}}</span>
                            </div>
                        </div>
                  
                    </div>
                    <!-- <div class="night_mode_switch__btn">
                        <a href="#" id="night-mode" class="btn-night-mode">
                            <i class="uil uil-moon"></i>{{__('Night mode')}}
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>
                    </div> -->
                    @if(Auth::guard('author')->check())
                    <a href="{{ route('ins-home') }}" class="item channel_item">{{__('Dashboard')}}</a>

                    <a href="{{ route('profile.edit') }}" class="item channel_item">{{__('Setting')}}</a>
                    <a href="{{ url('author/help') }}" class="item channel_item">{{__('Help')}}</a>
                    <a href="{{ url('author/feedback') }}" class="item channel_item">{{__('Send Feedback')}}</a>
                    <a href="{{ route('ins.logout') }}" class="item channel_item">{{__('Sign Out')}}</a>
                    @else
                    <a href="{{ url('login') }}" class="item channel_item">{{__('Sign in')}}</a>
                    <a href="{{ url('register') }}" class="item channel_item">{{__('Sign Up')}}</a>
                    
                    @endif
                </div>
            </li>
        </ul>
    </div>
</header>