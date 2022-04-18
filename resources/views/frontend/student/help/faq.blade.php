@extends('frontend.layouts.ins-master')

@section('content')

<div class="_215v122">
    <div class="container">
    @if(Auth::guard('author')->check())
<div class="row-author mt-0">
@else
<div class="row">
@endif
            <div class="col-lg-12">
                <div class="section3125">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="help_stitle">
                                <h2>{{__("Didn't find an answer? Ask us a question")}}</h2>
                                @if(Auth::guard('author')->check())
                                <a class="feedback-link d-flex justify-content-center align-items-center mx-auto px-4 py-3" href="/author/feedback">{{__('Text us')}}</a>
                                @else
                                <a class="feedback-link d-flex justify-content-center align-items-center mx-auto px-4 py-3" href="/feedback">{{__('Text us')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="_215b15">
    <div class="container">
    @if(Auth::guard('author')->check())
<div class="row-author mt-0">
@else
<div class="row">
@endif
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="course_tabs">
                    <nav>
                        <div class="nav nav-tabs help_tabs tab_crse justify-content-center" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link mx-3 active" id="nav-instructor-tab" data-toggle="tab" href="#nav-instructor" role="tab" aria-selected="true">{{__('Instructor')}}</a>
                            <a class="nav-item nav-link mx-3" id="nav-student-tab" data-toggle="tab" href="#nav-student" role="tab" aria-selected="false">{{__('Student')}}</a>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="crse_content d-flex justify-content-center mt-5 mb-0">
                <h3>{{__('Select a topic to search for help')}}</h3>
            </div>
        </div>
    </div>
</div>
@php
$dop='';
@endphp
@if(Auth::guard('author')->check())
@php $dop='/author'; 
@endphp 
@endif
<div class="_215b17">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="course_tab_content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-instructor" role="tabpanel">
                            <div class="tpc152">
                                <div class="section3126">
                                    <div class="row">
                                        @foreach ($master['ins'] as $item)
                                        <div class="col-md-4">
                                            <div class="faq-item">
                                                <a href="{{$dop}}/help/{{$item->id}}" class="value_props50 d-flex">
                                                    <div class="value_content mt-0">
                                                        <h4 class="text-left">{{$item->question}}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-student" role="tabpanel">
                            <div class="tpc152">
                                <div class="section3126">
                                    <div class="row">
                                        @foreach ($master['stu'] as $item)

                                        <div class="col-md-4">
                                            <div class="faq-item">
                                                <a href="{{$dop}}/help/{{$item->id}}" class="value_props50 d-flex">
                                                    <div class="value_content mt-0">
                                                        <h4 class="text-left">{{$item->question}}</h4>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
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
@endsection