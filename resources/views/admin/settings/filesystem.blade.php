@extends('layouts.admin-master')

@section('title')
{{ __('Settings') }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ __('Settings') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">{{ __('Home') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('Settings') }}</a></div>
            <div class="breadcrumb-item"><a href="#">{{ __('File System Login') }}</a></div>
        </div>
    </div>

    <div class="section-body">
        <x-alert-msg></x-alert-msg>
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12 ">
                <form action="{{ route('setting.update') }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>{{__('File System Setting')}}</h4>

                        </div>
                        <div class="card-body ">
                            <form method="post">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="form-group mb-0">
                                            <label>{{ __('File System') }}</label>
                                            <select name="FILE_SYSTEM" class="form-control select2-dd" required>
                                                <option value="local" {{ env("FILE_SYSTEM") == "local" ? 'selected' : '' }}>
                                                        {{__('Local')}}</option>
                                                <option value="s3" {{ env("FILE_SYSTEM") == "s3" ? 'selected' : '' }}>
                                                    {{__('AWS S3')}}</option>
                                                <option value="wasabi"
                                                    {{ env("FILE_SYSTEM") == "wasabi" ? 'selected' : '' }}>
                                                    {{__('Wasabi')}}</option>
                                            

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('AWS ACCESS KEY ID') }}</label>
                                            <input type="text" class="form-control" name="AWS_ACCESS_KEY_ID"
                                                value="{{env("AWS_ACCESS_KEY_ID")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('AWS SECRET ACCESS KEY') }}</label>
                                            <input type="text" class="form-control" name="AWS_SECRET_ACCESS_KEY"
                                                value="{{env("AWS_SECRET_ACCESS_KEY")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('AWS DEFAULT REGION') }}</label>
                                            <input type="text" class="form-control" name="AWS_DEFAULT_REGION"
                                                value="{{env("AWS_DEFAULT_REGION")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('AWS BUCKET') }}</label>
                                            <input type="text" class="form-control" name="AWS_BUCKET"
                                                value="{{env("AWS_BUCKET")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('WAS ACCESS KEY ID') }}</label>
                                            <input type="text" class="form-control" name="WAS_ACCESS_KEY_ID"
                                                value="{{env("WAS_ACCESS_KEY_ID")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('WAS SECRET ACCESS KEY') }}</label>
                                            <input type="text" class="form-control" name="WAS_SECRET_ACCESS_KEY"
                                                value="{{env("WAS_SECRET_ACCESS_KEY")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('WAS DEFAULT REGION') }}</label>
                                            <input type="text" class="form-control" name="WAS_DEFAULT_REGION"
                                                value="{{env("WAS_DEFAULT_REGION")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('WAS BUCKET') }}</label>
                                            <input type="text" class="form-control" name="WAS_BUCKET"
                                                value="{{env("WAS_BUCKET")}}">
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group mb-0">
                                            <label>{{ __('CDN Partner') }}</label>
                                            <select name="CONTENT_PROVIDER" class="form-control select2-dd" required>
                                                <option value="local" {{ env("CONTENT_PROVIDER") == "local" ? 'selected' : '' }}>
                                                            {{__('Local')}}</option>
                                                <option value="bunny"
                                                    {{ env("CONTENT_PROVIDER") == "bunny" ? 'selected' : '' }}>
                                                    {{__('bunny CDN')}}</option>
                                     

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="form-group">
                                            <label>{{ __('BUNNY CDN URL') }}</label>
                                            <input type="text" class="form-control" name="BUNNY_URL"
                                                value="{{env("BUNNY_URL")}}">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{__('Submit')}}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</section>

@endsection