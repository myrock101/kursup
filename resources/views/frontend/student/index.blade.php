@extends('frontend.layouts.ins-master')
@section('content')
@php
use App\Models\SpecialDiscount;
use App\Models\Course;

$mytime = Carbon\Carbon::now()->toDateString();
$free = Course::where('is_free', '=', 1)->where('status', '=', 1)->get('id')->pluck('id')->unique()->toArray();
$special = SpecialDiscount::whereDate('end_time', '>=', $mytime)->get('course_id')->pluck('course_id')->unique()->toArray();
$specialCourse = Course::whereIn('id', $special)->where('status', '=', 1)->get();
$freeCourse = Course::whereIn('id', $free)->get();

$categorys = \App\Models\Category::whereStatus(1)->inRandomOrder()->limit(10)->get();
$caty[] = $categorys = \App\Models\Category::whereStatus(1)->inRandomOrder()->limit(10)->get();
$courses27 = Course::with(['instructor:id,name,slug', 'category:id,name,slug,name_ua', 'SubCategory:id,name,subname_ua,slug'])->where('category_id', 27)->where('status', '=', 1)->latest()->limit(10)->get();
$courses1 = Course::with(['instructor:id,name,slug', 'category:id,name,slug,name_ua', 'SubCategory:id,name,subname_ua,slug'])->where('category_id', 1)->where('status', '=', 1)->latest()->limit(10)->get();
@endphp


<div class="main-banner d-flex flex-column justify-content-center align-items-center">
    <div class="glass">
        <h1>Лучшие курсы по доступным ценам!</h1>
        <div class="search121 mt-1">
            <div class="ui search">
                <form action="{{ route('explore') }}" method="post">
                    @csrf
                    <div class="ui left icon input swdh10">
                        <input class="prompt srch10" type="text"
                            placeholder="{{__('Search for Tuts Videos, Tutors, Tests and more..')}}" name="q">
                        <i class='uil uil-search-alt icon icon1'></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Новые курсы -->
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('Newest Courses')}}</h4>
            <a href="{{ route('coursesAll', ['type'=>'latest']) }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($courses as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Популярные курсы -->
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('rek courses')}}</h4>
            <a href="{{ route('coursesAll', ['type'=>'top']) }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">                  
                    @foreach ($coursesfeatured as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section9458 mt-50 pb-5">
    <div class="container">
        <div class="row">
            <!-- Категории -->
            <div class="section3125 mt-40">
                <h4 class="item_title text-light">{{__('Categories')}}</h4>
                <a href="https://kursup.com/categories" class="see150 text-light">{{__('See all')}}</a>
                <div class="la5lo1">
                    <div class="main-cat-list d-flex flex-wrap">
                        @foreach($categorys as $caty)
                        @if ($caty)
                            <a href="{{ route('categoriesCourses',['slug'=> $caty->slug]) }}" class="item" style="background-image:url({{$caty->image}}); background-size:cover;">
                                @if(str_replace('_', '-', app()->getLocale()) == 'Ua') <span>{{$caty->name_ua}}</span>@else <span>{{$caty->name}}</span> @endif 
                            </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Курсы по акции -->
        @if (!$specialCourse->isEmpty()) 
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('akc-courses')}} 🔥</h4>
            <a href="{{ route('coursesAll') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($specialCourse as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Бесплатные курсы -->
        @if (!$freeCourse->isEmpty()) 
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('free-courses')}}</h4>
            <a href="{{ route('coursesAll') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($freeCourse as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Курсы по категориям: пк и по -->
        @if (!$courses27->isEmpty())
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('pop-courses')}} {{__('pc-courses')}}</h4>
            <a href="https://kursup.com/categories/computer" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($courses27 as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- Курсы по категориям: фото -->
        @if (!$courses1->isEmpty())
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('pop-courses')}} {{__('photo-courses')}}</h4>
            <a href="https://kursup.com/categories/photo" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel featured_courses owl-theme">
                    @foreach ($courses1 as $course)
                    <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- Топ авторы -->
        @if (!$instructors->isEmpty())
        <div class="section3125 mt-40">
            <h4 class="item_title">{{__('Popular Instructors')}}</h4>
            <a href="{{ route('instructorAll') }}" class="see150">{{__('See all')}}</a>
            <div class="la5lo1">
                <div class="owl-carousel top_instrutors owl-theme">
                    @foreach ($instructors as $item)
                    <x-sqaure-instructors :ins="$item"></x-sqaure-instructors>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection