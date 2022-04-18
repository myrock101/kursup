@php
$categoryList = \App\Models\Category::whereStatus(1)->limit(10)->get();
@endphp
<header class="header clearfix">
    <div class="container">
    <div class="row">
        <button type="button" id="toggleMenu" class="toggle_menu">
            <i class='uil uil-bars'></i>
        </button>
        <!-- <button id="collapse_menu" class="collapse_menu">
            <i class="uil uil-bars collapse_menu--icon "></i>
            <span class="collapse_menu--label"></span>
        </button> -->
        <div class="main_logo" id="logo">
            <a href="{{url('/')}}"><img src="{{ static_asset('frontend/images/logo.svg')}}" alt=""></a>
            <a href="{{url('/')}}"><img class="logo-inverse" src="{{ static_asset('frontend/images/ct_logo.svg')}}" alt=""></a>
        </div>
        <div class="top-category">
            <div class="ui compact menu cate-dpdwn">
                <div class="ui simple item">
                    <a href="{{url('/categories')}}" class="option_links p-0" title="{{__('Categories')}}"><i class="uil uil-apps"></i></a>
                    <!-- <div class="menu dropdown_category5">
                        @foreach($categorys as $cat)
                        <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}"
                            class="item channel_item">{{$cat->name}}</a>
                        @endforeach
                    </div> -->
                </div>
            </div>
        </div>
        
        
    @php
        $nc = 0;
        $nl = [];
        $lcc = 0;
        $lc = [];
        $cartc = 0;
    @endphp
        
        <div class="header_right">
            <ul>
                @if(Auth::guard('customer')->check())
                <li>
                    <a href="{{ route('order.index') }}" class="upload_btn">{{__('EnrolledTopBar')}}</a>
                </li>
                @else
                <li>
                    <a href="{{ url('login') }}" class="upload_btn">{{__('Login')}}</a>
                </li>
                <li>
                    <a href="{{ url('register') }}" class="upload_btn">{{__('Sign Up')}}</a>
                </li>
                @endif
    @if(Auth::guard('customer')->check())
        @php
            $cartc = Auth::guard('customer')->user()->loadCount('cart')->cart_count;
            $nl = Auth::guard('customer')->user()->notifications->take(5);
            $nc= count($nl);
            $lc=Auth::guard('customer')->user()->latestChat->take(5);
            $lcc=count($lc);
        @endphp
        
                <li>
                    <a href="{{ url('cart') }}" class="option_links" title="{{__('cart')}}"><i class='uil uil-shopping-cart-alt'></i>@if($cartc>0)<span class="noti_count">{{$cartc}}</span>@endif</a>
                </li>
                <li class="ui dropdown">
                    <a href="#" class="option_links messcnt" title="{{__('Messages')}}"><i class='uil uil-envelope-alt'></i>@if($lcc>0)<span class="noti_count ">{{$lcc}}</span>@endif</a>
                    <div class="menu dropdown_ms">
                        @forelse ($lc as $ch)

                        <a href="/messages/{{$ch->user_one}}" class="channel_my item">
                            <div class="profile_link">
                                <img src="{{ file_asset($d->user->image ?? 'default.svg') }}" alt="">
                                <div class="pd_content">
                                    <h6>{{$ch->user->name ?? __('No Data')}}</h6>
                                    <p>{{$ch->msg}}</p>
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
                        <a class="vbm_btn" href="{{ route('stu-messages') }}">{{__('View All')}} <i
                                class='uil uil-arrow-right'></i></a>
                    </div>
                </li>

                <li class="ui dropdown">
                    <a href="#" class="option_links noticnt" title="{{__('Notifications')}}"><i class='uil uil-bell'></i> @if($nc>0) <span class="noti_count ">{{$nc}}</span> @endif </a>
                    <div class="menu dropdown_mn">
                        @forelse ($nl as $item)
                        <a href="{{ url('notifications') }}" class="channel_my item">
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


                        <a class="vbm_btn" href="{{ url('notifications') }}">{{__('View All')}} <i
                                class='uil uil-arrow-right'></i></a>
                    </div>
                </li>
                @endif


                @if(Auth::guard('customer')->check())
                <li class="ui dropdown">
                    <a href="#" class="opts_account">
                        <img src="/{{ auth('customer')->user()->image ?? 'frontend/images/hd_dp.jpg' }}" alt="">
                    </a>
                    <div class="menu dropdown_account">
                        <div class="channel_my">
                            <div class="profile_link">
                                <img src="/{{ auth('customer')->user()->image ?? 'frontend/images/hd_dp.jpg' }}" alt="">
                                <div class="pd_content">
                                    <div class="rhte85">
                                        <h6 class="mb-0">{{auth('customer')->user()->name ?? __('Guest')}}</h6>
                                        @if (auth('customer')->user()->email_verified_at ?? false)
      
                                        @endif
                                    </div>
                                    @if(Auth::guard('customer')->check())
                                    <span>{{auth('customer')->user()->email ?? __('')}}</span>
                                    @else
                                
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- <div class="night_mode_switch__btn">
                            <a href="#" id="night-mode" class="btn-night-mode">
                                <i class="uil uil-moon"></i> {{__('Night mode')}}
                                <span class="btn-night-mode-switch">
                                    <span class="uk-switch-button"></span>
                                </span>
                            </a>
                        </div> -->
                        @if(Auth::guard('customer')->check())
                        <a href="{{ url('saved-course') }}" class="item channel_item">{{__('Saved courses')}}</a>
                        <a href="{{ route('subscription') }}" class="item channel_item">{{__('Subscription')}}</a>
                        <a href="{{ route('profile.editstu') }}" class="item channel_item">{{__('Setting')}}</a>
                        <a href="{{ url('feedback') }}" class="item channel_item">{{__('Send Feedback')}}</a>
                        <a href="{{ route('stu.logout') }}" class="item channel_item">{{__('Sign Out')}}</a>
                        @else
                        <a href="{{ url('login') }}" class="item channel_item">{{__('Sign in')}}</a>
                        <a href="{{ url('register') }}" class="item channel_item">{{__('Sign Up')}}</a>
                        @endif

                    </div>
                </li>
                @else
                
                @endif
            </ul>
        </div>
        </div>
    </div>
</header>
<!-- <div class="menu-nav">
    <div class="container">
        <div class="row">
            @foreach($categoryList as $cat)
            <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}"
                class="item channel_item">{{$cat->name}}</a>
            @endforeach
        </div>
    </div>
</div> -->