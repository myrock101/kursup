@extends('frontend.layouts.ins-master')
@section('content')
<div class="container mt-40">
    <div class="row">
        <div class="w-100">
            <div class="_14d25 mb-20 saved-list">
                <div class="title126"><h4 class="mhs_title">{{__('Saved Courses')}}</h4></div>
                @forelse ($courses as $course)
                <x-vertical-coures :course="$course"></x-vertical-coures>
                @empty
                <x-nodata></x-nodata>
                @endforelse
            </div>
            <a href="{{ route('saved-course-delete') }}" class="rmv-btn"><i class='uil uil-trash-alt'></i>{{__('Remove Saved Courses')}}</a>
        </div>
    </div>
</div>
@endsection