@extends('frontend.layouts.ins-master')
@section('content')
    
    <div class="_new89">
        <div class="_215b15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title125">
                            <div class="titleleft">
                                <div class="ttl121">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb p-0 breadcrumb-custom">
                                            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                        <div class="title126">
                            <h2>{{$title}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq1256">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="fcrse5463">
                            <ul class="ttrm15">
                                <li><a href="{{ url('legal/'.'contacts') }}" class="tt_item">{{__('Контакты')}}</a></li>
                                <li><a href="{{ url('legal/'.'become-author') }}" class="tt_item">{{__('Become an authorr')}}</a></li>
                                <li><a href="{{ url('legal/'.'rules') }}" class="tt_item">{{__('Условия пользования сайтом')}}</a></li>
                                <li><a href="{{ url('legal/'.'policy') }}" class="tt_item">{{__('Политика конфиденциальности')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="inner8326">
                            {!! $data !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection