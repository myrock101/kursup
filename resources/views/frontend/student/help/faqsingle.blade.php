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


<div class="_215b17">
    <div class="container">
    @if(Auth::guard('author')->check())
<div class="row-author mt-0">
@else
<div class="row">
@endif
            <div class="col-lg-12">
                <div class="tpc152">
                    <div class="crse_content">
                        <h3>{{$master->question}}</h3>
                    </div>
                    <div class="section3126 mt-20">
                        <div class="">
							{{$master->ans}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection