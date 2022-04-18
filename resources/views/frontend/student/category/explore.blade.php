@extends('frontend.layouts.ins-master')
@section('content')
<div class="breadcrumbs">
	<div class="container mt-30">
    	<div class="row">
			<!-- текущяя категория -->
			<div>
				<a href="{{url('/')}}">{{__('Home')}}</a> /  
				<b>{{__('Search')}}</b>
			</div>
			<!-- END текущяя категория -->
		</div>
	</div>
</div>
<div class="container mt-30">
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="section3125">
            <div class="explore_search">
                <div class="ui search focus">
                    <form action="{{ route('explore') }}" method="post">
                        @csrf
                        <div class="ui left icon input swdh11">
                            <input class="prompt srch_explore" type="text" placeholder="{{__('Search Courses...')}}"
                                name="q" value="{{$params['q']}}">
                            <i class="uil uil-search-alt icon icon2"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="_14d25">
        <div class="container">
            <div class="row mt-30">
                <div class="course-grid">
                    @forelse ($courses as $course)
                    <div class="cat-course-item">
                        <x-horizontal-courses :course="$course"></x-horizontal-courses>
                    </div>
                
                    @empty
                    </div>
                    <div class="col-md-12 text-center">
                        <x-nodata></x-nodata>
                    </div>
                    @endforelse

                    <div class="col-md-12 text-center">
                        <div class="main-loader mt-50">
                            {{$courses->appends($params)->links("vendor.pagination.semantic-ui") }}
                        </div>
                    </div>
                    
            </div>
        </div>
        </div>
    </div>
</div>
</div>
@endsection