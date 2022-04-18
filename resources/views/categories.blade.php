@extends('frontend.layouts.ins-master')
@php
$categorys = \App\Models\Category::whereStatus(1)->orderBy('name','asc')->limit(-1)->get();
@endphp
@section('content')
<div class="breadcrumbs">
	<div class="container">
    	<div class="row">
			<!-- текущяя категория -->
			<div>
				<a href="{{url('/')}}">{{__('Home')}}</a> /  
				<b>{{__('Categories')}}</b>
			</div>
			<!-- END текущяя категория -->
		</div>
	</div>
</div>
<div class="container mt-20">
    <div class="row">
        <!-- <div class="col-xl-12 col-lg-8">
            <div class="section3125 mb-3 catsearch">
                <div class="explore_search">
                    <div class="ui search focus">
                        <form action="" method="get">
                            @csrf
                            <div class="ui left icon input swdh11">
                                <input class="prompt srch_explore" type="text" placeholder="{{__('Search Courses...')}}" name="q" value="{{$params['q']}}" />
                                <i class="uil uil-search-alt icon icon2"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
       
				@foreach($categorys as $cat)
				@if($cat->CntCourses() > 0)
				<div class="col-md-3 my-3 cat-list">
					<a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}" class="item">
					@if(str_replace('_', '-', app()->getLocale()) == 'Ua')
						<span>{{$cat->name_ua}}</span>
					@else
						<span>{{$cat->name}}</span>
					@endif
					</a>
					
					@if(count($cat->subcats) > 0)
						 @foreach($cat->subcats as $scat)
					 @if($scat->CntCourses() > 0)
						<div class="sub-list">	
							 <a href="{{ route('subcategoriesCourses',['category'=>  $scat->slug,'slug'=> $cat->slug]) }}">
								@if(str_replace('_', '-', app()->getLocale()) == 'Ua') <span>{{$scat->subname_ua}}</span>@else <span>{{$scat->name}}</span> @endif
								<!-- ({{-- $scat->CntCourses() --}}) -->
							</a>
						</div>
						@endif
						 @endforeach
					@endif
				</div>
				@endif
				@endforeach
		
		


    </div>
</div>
<style>
    .vertical_nav .menu--item__has_sub_menu span{
        background: #03827d0d;
        color: #03827d;
    }
    .vertical_nav .menu--item__has_sub_menu .menu--link:after {
        color: #03827d;
    }
</style>

@endsection