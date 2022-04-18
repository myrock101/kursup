@extends('frontend.layouts.ins-master')
@php
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
$courses = Course::with(['instructor:id,name,slug', 'category:id,name,slug,name_ua', 'subCategory:id,name,subname_ua,slug'])->where('category_id', $course->category_id)->where('status', '1')->latest()->limit(10)->get();
$newId = $course->id;

$cat = \App\Models\Category::where('id', $course->category_id)->limit(1)->get()->first();
$subcat = \App\Models\subCategory::where('id', $course->subcategory_id)->limit(1)->get()->first();
@endphp
@push("styles")
<link href="{{ static_asset('frontend/css/video-js.css')}}" rel="stylesheet" />
<style>.rating-stars ul {list-style-type: none;padding: 0;-moz-user-select: none;-webkit-user-select: none;}.rating-stars ul>li.star {display: inline-block;}.rating-stars ul>li.star>i.fa {font-size: 19px;color: #ccc;}.rating-stars ul>li.star.hover>i.fa {color: #FFCC36;}.rating-stars ul>li.star.selected>i.fa {color: #FF912C;    }/*     #my-video,    #let-video {        height: 100%;        width: 100%;    } */</style>
@endpush
@section('content')

<div class="breadcrumbs">
    <div class="container">
    	<div class="row">
	        <div>
		        <a href="{{url('/')}}">{{__('Home')}}</a> /  
		        <a href="{{url('/categories')}}">{{__('Categories')}}</a> /  
                @if(str_replace('_', '-', app()->getLocale()) == 'Ua') 
                
				    @if($course->subcategory_id)
                        <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name_ua}}</a> / 
                        <a href="{{ route('subcategoriesCourses',['category'=>  $subcat->slug,'slug'=> $cat->slug]) }}">{{$subcat->name_ua}}</a> /
                    @else 
                        <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name_ua}}</a> / 
                    @endif

                @else
                    @if($course->subcategory_id)
                        <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name}}</a> / 
                        <a href="{{ route('subcategoriesCourses',['category'=>  $subcat->slug,'slug'=> $cat->slug]) }}">{{$subcat->name}}</a> /
                    @else 
                        <a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name}}</a> / 
                    @endif
                @endif
                <b>{{$course->title}}</b>
	        </div>
        </div>
    </div>
</div>
<div class="modal vd_mdl fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <video id="my-video" class="video-js vjs-theme-forest" controls preload="auto"
                    poster="{{file_asset($course->cover_image) }}" data-setup="{}">
                    <source src="{{ file_asset( $course->promotional_video)}}"
                        type="video/{{substr($course->promotional_video, strpos($course->promotional_video, ".") + 1)}}" />
                </video>
            </div>

        </div>
    </div>
</div>
<div class="modal vd_mdl fade" id="let-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="let-header">Modal Header</h4>
                <button type="button" class=" btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="video-div">

                    <video id="let-video" class="video-js vjs-theme-forest" controls preload="auto"
                        poster="{{file_asset($course->cover_image) }}" data-setup="{}">
                        <source src="{{ static_asset('demo.mp4') }}" type="video/mp4" />
                    </video>
                </div>

                <div class="p-4">
                    <h4>{{__('Detail')}}</h4>
                    <span id="let-detail">

                    </span>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="container mt-30">
<div class="row">
<div class="_byt1458 w-100">
    <div class="_215b01">
        <div class="label-flex">
            <div class="crse_reviews">
                <i class="uil uil-star"></i>{{$course->avg_rating}}
            </div>
            @if ($course->is_bestseller)
                <div class="badge_sellers">{{__('Bestseller')}}</div>
            @endif
            @if ($discount)
                <div class="crse_reviews bg-danger">
                    <i class="uil uil-pricetag-alt"></i>{{ round(100 - (($discount->percentage * 100) / $course->real_price)) }}%
                </div>
            @endif
        </div>

        <div class="container">
            <div class="">
                <div class="col-lg-12">
                    <div class="section3125">
                        <div class="row justify-content-center">
                            <div class="col-xl-4 col-lg-5 col-md-6 d-flex align-items-center flex-column">
                                <div class="course-main_img" style="background: url('{{file_asset($course->cover_image) }}') no-repeat center/cover;"></div>
                                @if ($course->promotional_video)
                                <div class="_215b44">
                                    <a href="#" data-toggle="modal" data-target="#videoModal">
                                        <span>{{__('Preview this course')}}<i class="uil uil-play"></i></span>
                                    </a>  
                                </div>
                                @else
                                @endif
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-6">
                                <div class="_215b03">
                                    <h2>{{$course->title}}</h2>
                                    <span class="_215b04">{{$course->subtitle}}</span>
                                    @if ($course->is_free == 0)
                                        <!-- Акция -->
					                    @if($course->special) 
					                    	<div class="prce122">{{$course->special}}{{$admin_setting[7]['value']}}</div>
                                            <div class="prce122 pr-2 text-danger"><s style="font-size: 15px;">{{$course->real_price}}{{$admin_setting[7]['value']}}</s></div>
					                    @else
                                            <!-- Со скидкой -->
                                            @if ($course->discount_price == 0)
                                                <!-- Обычная цена -->
                                                <div class="prce122">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>   
                                            @else
                                                @if ($course->discount_price < $course->price)
                                                    <div class="d-flex">
                                                        <div class="prce122">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>
                                                        <div class="prce122 prce832 pr-2 text-danger"><s style="font-size: 15px;">{{$course->price}}{{$admin_setting[7]['value']}}</s></div>
                                                    </div>
                                                @else
                                                <!-- Обычная цена -->
                                                <div class="prce122">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>
                                                @endif
                                            @endif
                                        @endif
                                        @else
                                            <!-- Бесплатная цена -->
                                            <div class="prce122">{{__('Free course')}}</div>
                                        @endif
                                </div>
                                @if ($discount)
                                <div class="_215fgt1 text-danger">
                                    <!-- {{$discount->title}} -->
                                    {{__('end-discount')}} {{$discount->end_time->format('d.m.Y')}}
                                </div>
                                @endif
                                <ul class="_215b31">
                                    @if ($course->is_buy >= 1)
                                    <li><a href="{{ $course->kurslink }}" target="_blank" class="btn_buy d-flex justify-content-center align-items-center">{{__('Download kurs')}}</a></li>
                                    @else
                                @if ($course->status == 1)
                                    @if ($course->in_cart == 1)
                                    <li><button class="btn_adcart bg-light text-dark"
                                            onclick="window.location.href = '{{ route('removefromcart',['id'=>$course->id]) }}';">{{__('Remove From Cart')}}</button></li>
                                    @else
                                    <li><button class="btn_adcart"
                                            onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id,'from'=>'normal']) }}';">{{__('Add to Cart')}}</button></li>
                                    @endif
                                    <li><button class="btn_buy" onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id, 'from'=>'buy']) }}';">{{__('Buy Now')}}</button></li>
                                    @endif
                                
                                @endif
                                @if ($course->status != 1)
                                <p>Курс не обубликован</p>
                                @endif
                                
                                </ul>
                                
                                <div class="_215b06">
                                    <div class="_215b07">
                                        <b>{{__('Course language')}}:</b> {{$course->language->name ?? __('No Data')}}
                                        <span><i class='uil uil-comment'></i></span>
                                    </div>
                                </div> 
                                <div class="_215b05">
                                    <b>{{__('students enrolled')}}:</b> {{number_format($course->enroll_count)}} 
                                </div>
                                <div class="_215b05">
                                    <b>{{__('Last updated')}}:</b> {{$course->updated_at->format('d.m.Y')}}
                                </div>
                                <div class="_215b10">
                                    @if ($course->is_saved == 1)

                                    <a href="{{ route('removefromsave',['id'=>$course->id]) }}" class="_215b11 avt-btn">
                                        <span><i class="uil uil-heart"></i></span>{{__('Saved')}}
                                    </a>
                                    @else

                                    <a href="{{ route('addtosave',['id'=>$course->id]) }}" class="_215b11">
                                        <span><i class="uil uil-heart"></i></span>{{__('Save')}}
                                    </a>
                                    @endif
                                    @if ($course->is_reported == 1)
                                    <a href="#" class="_215b12 avt-btn">
                                        <span><i class="uil uil-windsock"></i></span>{{__('Reported')}}
                                    </a>
                                    @else
                                    <a href="{{ route('addtoreport',['id'=>$course->id]) }}" class="_215b12">
                                        <span><i class="uil uil-windsock"></i></span>{{__('Report abuse')}}
                                    </a>
                                    @endif
                                </div>

                                
                                
                                
                                <!-- <div class="_215fgt1">
                                    {{__('30-Day Money-Back Guarantee')}}
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="_215b15">
        <div class="container">
            <div class="">
                <div class="col-lg-12">
                    <div class="user_dt5">
                        <div class="user_dt_left">
                            <div class="live_user_dt">
                                <div class="user_img5">
                                    <a href="{{ route('instructorShow', ['slug'=>  $course->instructor->slug]) }}"><img src="/{{$course->instructor->image ?? static_asset('frontend/images/hd_dp.jpg')}}" alt=""></a>
                                </div>
                                <div class="user_cntnt">
                                    <a href="{{ route('instructorShow', ['slug'=>  $course->instructor->slug]) }}" class="_df7852">{{$course->instructor->name ?? __('No Data')}}</a>
                                    @if ($course->ins_sub == 1)
                                    <button class="subscribe-btn bg-light text-dark"
                                        onclick="window.location.href = '{{ route('unsubscribe',['id'=>$course->instructor_id]) }}';">{{__('Subscribed')}}</button>
                                    @else
                                    <button class="subscribe-btn"
                                        onclick="window.location.href = '{{ route('subscribe',['id'=>$course->instructor_id]) }}';">{{__('Subscribe')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="course_tabs">
                            <nav>
                                <div class="nav nav-tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-about-tab" data-toggle="tab" href="#nav-about"
                                        role="tab" aria-selected="true">{{__('About')}}</a>
                                    <a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews"
                                        role="tab" aria-selected="false">{{__('Reviews')}}</a>
                                </div>
                            </nav>
                        </div>
                        <div class="user_dt_right">
                            <ul>
                                <li>
                                    <a class="lkcm152"><i class="uil uil-eye"></i><span>{{$course->shortNumber($course->views)}}</span></a>
                                </li>
                                <li>
                                    @if ($course->is_like == 0)

                                    <a href="{{ route('deletelikedislike',['id'=>$course->id]) }}" class="lkcm152 avt-btn">
                                        <i class="uil uil-thumbs-up"></i>
                                        <span>{{$course->shortNumber($course->likes)}}</span>
                                    </a>
                                    @else
                                    <a href="{{ route('likedislike',['id'=>$course->id,'what'=> 0]) }}" class="lkcm152">
                                        <i class="uil uil-thumbs-up"></i>
                                        <span>{{$course->shortNumber($course->likes)}}</span>
                                    </a>
                                    @endif

                                </li>
                                <li>
                                    @if ($course->is_like == 1)
                                    <a href="{{ route('deletelikedislike',['id'=>$course->id]) }}" class="lkcm152 avt-btn">
                                        <i class="uil uil-thumbs-down"></i>
                                        <span>{{$course->shortNumber($course->dislikes)}}</span>
                                    </a>
                                    @else
                                    <a href="{{ route('likedislike',['id'=>$course->id,'what'=> 1]) }}" class="lkcm152"><i
                                            class="uil uil-thumbs-down"></i>
                                        <span>{{$course->shortNumber($course->dislikes)}}</span>
                                    </a>
                                    @endif

                                </li>
                                <li>
                                    <a onclick="window.open('{{ route('courseShare', ['slug'=> $course->slug]) }}','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;"
                                        class="lkcm152"><i
                                            class="uil uil-share-alt"></i><span>{{$course->shortNumber($course->share)}}</span></a>
                                </li>
                                <li>
                                    <a href="javascript:;" type="button" onclick="Copy({{$course->id}});" class="lkcm152" id="lkcm1679"><i class="uil uil-link-alt"></i><span id="copyCnt{{$course->id}}">{{$course->shortNumber($course->copy)}}</span></a>
                                    <template id="copyText">
                                        <swal-icon type="success" color="#03827D"></swal-icon>
                                        <swal-param name="allowEscapeKey" value="false" />
                                        <swal-param name="customClass" value='{ "popup": "my-popup" }' />
                                        <swal-title>{{__('copyText')}}</swal-title>
                                    </template> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b17">
    <div class="_215872">
        <div class="">
            <div class="col-lg-12">
                <div class="course_tab_content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-about" role="tabpanel">
                            <div class="_htg451">
                                {!!clean($course->description)!!}
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="nav-courses" role="tabpanel">
                            <div class="crse_content">
                                <h3>{{__('Course content')}}</h3>
                                <div class="_112456">
                                    <ul class="accordion-expand-holder">
                                        <li><span class="accordion-expand-all _d1452">{{__('Expand all')}}</span></li>
                                        <li><span class="_fgr123"> {{$course->lectures_count}} {{__('lectures')}}</span>
                                        </li>
                                        <li><span class="_fgr123">{{$course->lectures_length}}</span></li>
                                    </ul>
                                </div>
                                <div id="accordion" class="ui-accordion ui-widget ui-helper-reset">
                                    @foreach ($course->content as $content)


                                    <a href="javascript:void(0)"
                                        class="accordion-header ui-accordion-header ui-helper-reset ui-state-default ui-accordion-icons ui-corner-all">
                                        <div class="section-header-left">
                                            <span class="section-title-wrapper">
                                                <i class='uil uil-presentation-play crse_icon'></i>
                                                <span class="section-title-text">{{$content->title}}</span>
                                            </span>
                                        </div>
                                        <div class="section-header-right">
                                            <span class="num-items-in-section">{{count($content->lectures)}}
                                                {{__('lectures')}}</span>
                                            <span
                                                class="section-header-length">{{$content->lecturesLength($content->id)}}</span>
                                        </div>
                                    </a>
                                    <div
                                        class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom">
                                        @foreach ($content->lectures as $lecture)

                                        <div class="lecture-container">
                                            <div class="left-content">
                                                @if ($lecture->file_type == 0)

                                                <i class='uil uil-file-download-alt icon_142'></i>
                                                @elseif($lecture->file_type == 1)
                                                <i class='uil uil-play-circle icon_142'></i>
                                                @else
                                                <i class='uil uil-file icon_142'></i>
                                                @endif
                                                <div class="top">
                                                    <div class="title">{{$lecture->title}}</div>
                                                </div>
                                            </div>
                                            <div class="details">
                                                @if ($course->is_buy >= 1)
                                                @if ($lecture->file_type == 1)
                                                @php
                                                $dis = $lecture->description;
                                                $lecture->description= "";
                                                @endphp
                                                <a href="#" class="preview-text"
                                                    onclick="openletModel('{{$lecture}}',`{{$dis}}`)"
                                                    data-toggle="modal" data-target="#let-modal">{{__('View')}}</a>
                                                @else
                                                <a href="{{ file_asset($lecture->file) }}" target="_blank"
                                                    class="preview-text">{{__('Download')}}</a>
                                                @endif
                                                @endif
                                                <span class="content-summary">
                                                    {{$lecture->hoursandmins($lecture->duration)}}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <a class="btn1458" href="#">{{count($course->content)}} {{__('Sections')}}</a>
                            </div>
                        </div> -->
                        <div class="tab-pane fade" id="nav-reviews" role="tabpanel">
                            <div class="student_reviews">
                                <div class="flexy">
                                    <div class="">
                                    <!-- ($course->is_buy >= 1) -->
                                    
                                        @if (Auth::guard('customer')->check())

                                        <div class="reviews_left">
                                            <h3>{{__('Your Feedback')}}</h3>
                                            <div class="total_rating">

                                                <div class="_rate001">{{__('Course Rating')}}</div>
                                                <div class='rating-stars text-center'>
                                                    <ul id='stars'>
                                                        @php
                                                        $os =$course['own_rating']['star'] ?? 0;
                                                        @endphp
                                                        <li class='star {{$os >= 1 ? 'hover selected' : ''}}'
                                                             data-value='1'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 2 ? 'hover selected' : ''}}'
                                                             data-value='2'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 3 ? 'hover selected' : ''}}'
                                                             data-value='3'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 4 ? 'hover selected' : ''}}'
                                                             data-value='4'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star {{$os >= 5 ? 'hover selected' : ''}}'
                                                             data-value='5'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <form action="{{ url('ratting') }}" method="post">
                                                @csrf
                                                <div class="basic_form">

                                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                                    <input type="hidden" name="star"
                                                        value="{{$course['own_rating']['star'] ?? 0 }}" id="rateinput">
                                                    <div class="ui search focus mt-3">
                                                        <div class="ui left icon input swdh11 swdh19">

                                                            <textarea id="review-msg" name="msg"
                                                                class="prompt srch_explore" cols="30" rows="10"
                                                                 required
                                                                minlength="10">{{$course['own_rating']['msg'] ?? ''}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn_adcart mt-3 float-right" type="submit">{{__('Give Review')}}</button>
                                            </form>
                                        </div>
                                        @endif
                                        <div class="reviews_left mt-2">
                                            <h3>{{__('Student Feedback')}}</h3>
                                            <div class="total_rating">
                                                <div class="_rate001">{{$course->avg_rating}}</div>
                                                <div class="rating-box">

                                                    @for ($i = 0; $i < 5;$i++) <span
                                                        class="rating-star {{$course->avg_rating > $i ? 'full-star' : 'empty-star'}}">
                                                        </span>
                                                        @endfor
                                                </div>
                                                <div class="_rate002">{{__('Course Ratings')}}</div>
                                            </div>
                                            <div class="_rate003">
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['5_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['5_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['5_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['4_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['4_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['4_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['3_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['3_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['3_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar " role="progressbar"
                                                            aria-valuenow="{{$course['2_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['2_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['2_star']}}%</div>
                                                </div>
                                                <div class="_rate004">
                                                    <div class="progress progress1">
                                                        <div class="progress-bar" role="progressbar"
                                                            aria-valuenow="{{$course['1_star']}}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:{{$course['1_star']}}%">
                                                        </div>
                                                    </div>
                                                    <div class="rating-box">
                                                        <span class="rating-star full-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                        <span class="rating-star empty-star"></span>
                                                    </div>
                                                    <div class="_rate002">{{$course['1_star']}}%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="review_right">
                                            <div class="review_right_heading">
                                                <h3>{{__('Reviews')}}</h3>
                                                <!-- <div class="review_search">
                                                    <input class="rv_srch" type="text"
                                                        placeholder="{{__('Search reviews...')}}">
                                                    <button class="rvsrch_btn"><i class='uil uil-search'></i></button>
                                                </div> -->
                                                
                                            </div>
                                        </div>
                                       
                                        <div class="review_all120">
                                        @if (count($course->reviews) > 0)
                                            @foreach ($course->reviews as $review)
                                            <div class="review_item">
                                                <div class="review_usr_dt">
                                                    <img src="{{ file_asset($review->student->image ?? 'default.svg') }}"
                                                        alt="">
                                                    <div class="rv1458">
                                                        <h4 class="tutor_name1">{{$review->student->name ?? __('No Data')}}</h4>
                                                        <span
                                                            class="time_145">{{$review->updated_at->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                                <div class="rating-box mt-20">
                                                    @for ($i = 0; $i < 5;$i++) <span
                                                        class="rating-star {{$review->star > $i ? 'full-star' : 'empty-star'}}">
                                                        </span>
                                                    @endfor
                                                </div>
                                                <p class="rvds10">{{$review->msg}}</p>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else 
                                            <h4 class="tutor_name1">{{__('No reviews')}}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@if (count($courses) > 1)
<div class="container mt-40">
    <div class="row">
        <div class="related-title d-flex justify-content-center w-100 mb-30">{{ __('Related courses')}}</div>
        <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($courses as $course)
                    @if ($course->id != $newId)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endif
                    @endforeach
                </div>
            </div>
    </div>
</div>
@endif

@endsection
@push("scripts")
<!-- <script src="{{ static_asset('frontend/js/video.min.js')}}"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.8/sweetalert2.min.css">
<script>
//     "use strict";
//     function openletModel(data,dis){

//         data = JSON.parse(data,)
//         var  file = data.file


//         $("#let-header").html(data.title);
//         $("#let-detail").html(dis);
//         var extension = file.substr((file.lastIndexOf('.') +1) );

//         var url = '{{file_asset("/")}}/'+data.file;
//      var video = $('#let-modal video source');
//     video.src = url;
//     video.type = 'video/'+extension;

//     video.load();
// setTimeout(() => {

// }, 500);
//     }
$(function () {
    $('#stars li').on('mouseover', function () {
    var onStar = parseInt($(this).data('value'), 10);

    $(this).parent().children('li.star').each(function (e) {
    if (e < onStar) { $(this).addClass('hover'); } else { $(this).removeClass('hover'); } }); }).on('mouseout', function ()
        { $(this).parent().children('li.star').each(function (e) { $(this).removeClass('hover'); }); });
         $('#stars li').on('click', function () { var onStar=parseInt($(this).data('value'), 10);
          var stars=$(this).parent().children('li.star'); 
          for (var i=0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected'); } for (i=0; i < onStar; i++) { $(stars[i]).addClass('selected'); }
         var ratingValue=parseInt($('#stars li.selected').last().data('value'), 10); var msg="" ; if
        (ratingValue> 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
        } else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
    $('#rateinput').val(ratingValue);
        });
    });
</script>
@endpush
