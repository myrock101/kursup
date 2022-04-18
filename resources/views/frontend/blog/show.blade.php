@extends('frontend.layouts.ins-master')

@section('content')
    <div class="breadcrumbs">
        <div class="container mt-30">
            <div class="row">
                <div>
                    <a href="{{url('/')}}">{{__('Home')}}</a> /
                    <a href="{{ route('blog.list') }}">Блог</a> /
                    <b>{{ $blog['title'] }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-30">
        <div class="row">
            <div class="col-md-12">
                <div class="_14d25">
                    <div class="container">
                        <img src="{{ Storage::url($blog['cover']) }}" alt="{{ $blog['title'] }}">
                        <h2>{{ $blog['title'] }}</h2>
                        <div class="mt-30 ql-editor" id="demo-container">
                            {!! $blog['description'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script>
        $(function () {
            $('head').append('<meta name="description" content="{{ $blog['meta_description'] ?? 'No description' }}">');
            $('head').append('<meta name="keywords" content="{{ $blog['meta_keywords'] ?? 'No description' }}">');
        })
    </script>
@endsection