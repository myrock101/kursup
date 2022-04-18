<footer class="footer mt-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-10 col-md-10">
                <div class="item_f1">
                    <a href="{{ url('/blog') }}">{{__('Blog')}}</a>
                    <a href="{{ url('legal/'.'become-author') }}">{{__('Become an authorr')}}</a>
                    <a href="{{ url('legal/'.'contacts') }}">{{__('Contacts')}}</a>
                    <a href="{{ url('legal/'.'rules') }}">{{__('Copyright Policy')}}</a>
                    <a href="{{ url('legal/'.'policy') }}">{{__('Privacy Policy')}}</a>
                    @if(Auth::guard('author')->check())
                    <a href="{{ url('author/'.'help') }}">{{__('Help')}}</a>
                    @else
                    <a href="{{ url('/help') }}">{{__('Help')}}</a>
                    @endif
                    
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12">
                <div class="item_f1">

                    <div class="lng_btn mt-0">
                        <div class="ui language bottom right pointing dropdown floating" id="languages"
                            data-content="Select Language">
                            <a href="#"><i class='uil uil-globe lft'></i>{{__('Language')}}<i
                                    class='uil uil-angle-down rgt'></i></a>
                            <div class="menu">
                                <div class="scrolling menu">
                                    <!-- <div class="item" data-percent="100" data-value="en" data-english="English"
                                        onclick="window.location.href ='{{ route('locale.change',['locale' => 'en']) }}';">
                                        <span class="description">English</span>
                                        En
                                    </div> -->
                                    @foreach ($weblang as $webl)
                                    <div class="item" data-percent="100" data-value="en" data-english="English"
                                        onclick="window.location.href ='{{ route('locale.change',['locale' => $webl->short_name]) }}';">
                                        <span class="description">{{$webl->name}}</span>
                                        {{$webl->short_name}}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="footer_bottm">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="fotb_left">
                                <li>
                                    <a href="{{url('/')}}">
                                        <div class="footer_logo">
                                            <img src="{{ static_asset('frontend/images/logo1.svg')}}" alt="">
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <p>© {{date('Y')}}
                                        <strong>{{env("APP_NAME")}}</strong>. {{__('All Rights Reserved.')}}</p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="edu_social_links">
                                <a href="http://www.instagram.com/{{$admin_setting[15]['value']}}" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="tg://resolve?domain={{$admin_setting[12]['value']}}" target="_blank"><i class="fab fa-telegram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</footer>