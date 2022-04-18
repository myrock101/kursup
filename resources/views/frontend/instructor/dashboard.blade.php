@extends('frontend.layouts.ins-master')

@push('styles')

<link href="{{ static_asset('frontend/css/instructor-dashboard.css')}}" rel="stylesheet">
<link href="{{ static_asset('frontend/css/instructor-responsive.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="row-author">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-apps"></i> {{__('Instructor Dashboard')}}</h2>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Sales')}}</h5>
                <h2>{{$master['total_sell']}} {{$admin_setting[7]['value']}}</h2>
                <span class="crdbg_1">{{__('Today')}} {{$master['total_sell_d']}} {{$admin_setting[7]['value']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ static_asset('frontend/images/dashboard/achievement.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Enroll')}}</h5>
                <h2>{{$master['total_enroll']}}</h2>
                <span class="crdbg_2">{{__('Today')}} {{$master['total_enroll_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ static_asset('frontend/images/dashboard/graduation-cap.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Courses')}}</h5>
                <h2>{{$master['course_count']}}</h2>
                <span class="crdbg_3">{{__('Today')}} {{$master['course_count_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ static_asset('frontend/images/dashboard/online-course.svg') }}" alt="">
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card_dash">
            <div class="card_dash_left">
                <h5>{{__('Total Students sub')}}</h5>
                <h2>{{$master['total_subscribers']}}</h2>
                <span class="crdbg_4">{{__('Today')}} {{$master['total_subscribers_d']}}</span>
            </div>
            <div class="card_dash_right">
                <img src="{{ static_asset('frontend/images/dashboard/knowledge.svg') }}" alt="">
            </div>
        </div>
    </div>
    <!-- <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Jump Into Course Creation')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash"
                    onclick="window.location.href ='{{ route('courses.create') }}';">{{__('Create Your Course')}}</button>
            </div>
        </div>
    </div> -->
</div>
<div class="row-author">
    <div class=" col-lg-12 col-md-12">
        <!-- <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Profile Analytics')}}</h4>
            <div class="la5lo1">
                <div class="fcrse_1">
                    <div class="fcrse_content">
                        <h6 class="crsedt8145">{{__('Current subscribers')}}</h6>
                        <h3 class="subcribe_title">{{$master['total_subscribers']}}</h3>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('View')}}</div>
                            <div class="crse-perf-right">{{$master['total_subscribers']}}<span class="analyics_pr">
                                    ({{$master['total_subscribers_d']}})</span>
                            </div>
                        </div>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('Sell')}}<span class="per_text">{{__('(today)')}}</span>
                            </div>
                            <div class="crse-perf-right">{{$master['total_sell']}}<span class="analyics_pr">
                                    ({{$master['total_sell_d']}})</span></div>
                        </div>
                        <div class="allvperf">
                            <div class="crse-perf-left">{{__('Enroll')}}<span class="per_text">{{__('(today)')}}</span>
                            </div>
                            <div class="crse-perf-right">{{$master['total_enroll']}}<span class="analyics_pr">
                                    ({{$master['total_enroll_d']}})</span></div>
                        </div>
                        <div class="auth1lnkprce">
                            <a href="{{ route('ins-analytics') }}"
                                class="cr1fot50">{{__('Go to profile analytics')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Latest Sell')}}</h4>
            <div class="la5lo1">

                @forelse ($master['l_sell'] as $item)

                <div class="fcrse_1 mb-1">
                    <div class="fcrse_content">
                        <div class="d-flex justify-content-between">
                            <p>{{$item->course->title  ?? __('No Data')}}</p>
                            <div class="crse-perf-right">
                                <span class="analyics_pr">{{$item->price}} {{$admin_setting[7]['value']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
				@empty
					{{__('No enrolled courses')}}
                @endforelse
            </div>
        </div>



        @if (count($master['review_c']))

        <div class="section3125 mt-50">
            <h4 class="item_title">{{__('Submit Coursess')}}</h4>
            <div class="la5lo1">
                @foreach ($master['review_c'] as $item)

                <div class="fcrse_1 mb-10">
                    <div class="fcrse_content">
                        <div class="upcming_card">
                            <b class="crsedt145">{{$item->title}}<span class="pndng_145">{{__('Draft')}}</span></b>
                            <p class="submit-course">{{__('Status time')}} <span class="ml-0">{{$item->created_at->diffForHumans()}}</span></p>
                            <form action="{{ route('courses.destroy', $item) }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="la5l76">
                                    <a href="https://kursup.com/courses/{{ $item->slug }}" target="_blank">{{__('View')}}</a>
                                    <span class="mx-2"> | </span>
                                    <a href="#" type="submit" onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''" title="{{ __('Delete')}}" class="delete_link10">{{__('Delete forever')}}</a> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
    </div>
</div>
@endsection

@push('scripts')

@endpush