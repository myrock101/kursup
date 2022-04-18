@extends('frontend.layouts.ins-master')
@php
$categoryList = \App\Models\Category::whereStatus(1)->limit(-1)->get();

@endphp
@section('content')
<style>
    .panel-body {
        background: transparent;
        border: none;
    }
</style>

<div class="breadcrumbs">
	<div class="container">
    	<div class="row">
			<!-- текущяя категория -->
			<div>
				<a href="{{url('/')}}">{{__('Home')}}</a> /  
				<a href="{{url('/categories')}}">{{__('Categories')}}</a> /  
			@if(str_replace('_', '-', app()->getLocale()) == 'Ua') 
				@if($subcat!==null)
					<a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name_ua}}</a> / 
					<b>{{$subcat->name}}</b>
				@else 
					<b>{{$cat->name_ua}}</b> 
				@endif
			@else
				@if($subcat!==null)
					<a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}">{{$cat->name}}</a> / 
					<b>{{$subcat->name}}</b>
				@else 
					<b>{{$cat->name}}</b> 
				@endif
			@endif
			</div>
			<!-- END текущяя категория -->
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
	<!-- <div class="col-xl-12 col-lg-8">
            <div class="section3125">
                <div class="explore_search">
                    <div class="ui search focus">
                        <form action="{{ route('categoriesCourses',['slug'=> str_replace(' ', '-', strtolower($cat->name)),'id' => $cat->id]) }}" method="post">
                            @csrf
                            <div class="ui left icon input swdh11">
                                <input class="prompt srch_explore" type="text" placeholder="{{__('Search Courses...')}}" name="q"
                                    value="{{$params['q']}}">
                                <i class="uil uil-search-alt icon icon2"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

    <div class="cat-container">    
	<div class="col-cat-filter">
		<div class="flex-filter">
			<form id="filterForm">
				@csrf
				<input type="hidden" name="sort" value="{{ $params['sort'] }}" id="sort" />
				<input type="hidden" name="category" value="{{ $cat->id }}" />
				<input type="hidden" name="subCategory" value="{{ $subcat['id'] }}">

				<div class="panel-group accordion" id="accordionfilter">
					<div class="panel panel-default m-0">
						<div class="panel-heading" id="headingfour">
							<div class="panel-title10">
								<a class="collapsed" data-toggle="collapse" data-target="#collapsefour" href="#" aria-expanded="false" aria-controls="collapsefour">
									{{__('Price')}}
								</a>
							</div>
						</div>
						<div id="collapsefour" class="panel-collapse collapse" aria-labelledby="headingfour" data-parent="#accordionfilter">
							<div class="panel-body">
								<div class="ui form">
									<div class="grouped fields">
										<div class="ui form checkbox_sign">
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="price" value="1" tabindex="0" class="hidden" {{$params['price'] == 1 ? 'checked' : ''}}>
													<label>{{__('Paid filter')}}</label>
												</div>
											</div>
										</div>
										<div class="ui form checkbox_sign">
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="price" value="0" tabindex="0" class="hidden" {{$params['price'] == 0 ? 'checked' : ''}}>
													<label>{{__('Free filter')}}</label>
												</div>
											</div>
										</div>
										<div class="ui form checkbox_sign">
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="discount" value="1" tabindex="0" class="hidden" id="discount">
													<label>По акции</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-default m-0">
						<div class="panel-heading" id="headingsix">
							<div class="panel-title10">
								<a class="collapsed" data-toggle="collapse" data-target="#collapsesix" href="#" aria-expanded="false" aria-controls="collapsesix">
									Стоимость
								</a>
							</div>
						</div>
						<div id="collapsesix" class="panel-collapse collapse" aria-labelledby="headingsix" data-parent="#accordionfilter">
							<div class="panel-body">
								<div class="ui form">
									<div class="grouped fields">
										<div class="row">
											<div class="col-md-6">
												<input type="number" class="form-control" placeholder="От" value="0" name="price_form" id="price_form">
											</div>
											<div class="col-md-6">
												<input type="number" class="form-control" placeholder="До" value="50000" name="price_to" id="price_to">
											</div>
										</div>

										<input type="text" class="js-range-slider" value=""/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-default m-0">
						<div class="panel-heading" id="headingsix">
							<div class="panel-title10">
								<a class="collapsed" data-toggle="collapse" data-target="#collapsesix"
									href="#" aria-expanded="false" aria-controls="collapsesix">
									{{__('Rating')}}
								</a>
							</div>
						</div>
						<div id="collapsesix" class="panel-collapse collapse" aria-labelledby="headingsix" data-parent="#accordionfilter">
							<div class="panel-body">
								<div class="ui form">
									<div class="grouped fields">
										<div class="ui form checkbox_sign">
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="rating" value="5" tabindex="0"
														class="hidden"
														{{$params['rating'] == 5 ? 'checked' : ''}}>
													<label class="rating_filter">
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														5.0

													</label>
												</div>
											</div>
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="rating" value="4" tabindex="0"
														class="hidden"
														{{$params['rating'] == 4 ? 'checked' : ''}}>
													<label class="rating_filter">
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														4.0

													</label>
												</div>
											</div>
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="rating" value="3" tabindex="0"
														class="hidden"
														{{$params['rating'] == 3 ? 'checked' : ''}}>
													<label class="rating_filter">
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														3.0

													</label>
												</div>
											</div>
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="rating" value="2" tabindex="0"
														class="hidden"
														{{$params['rating'] == 2 ? 'checked' : ''}}>
													<label class="rating_filter">
														<i class="uil uil-star"></i>
														<i class="uil uil-star"></i>
														2.0

													</label>
												</div>
											</div>
											<div class="inline field">
												<div class="ui checkbox mncheck">
													<input type="checkbox" name="rating" value="1" tabindex="0"
														class="hidden"
														{{$params['rating'] == 1 ? 'checked' : ''}}>
													<label class="rating_filter">
														<i class="uil uil-star"></i>
														1.0

													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="panel panel-default m-0">
                        <div class="panel-heading" id="headingThree">
                            <div class="panel-title10">
                                <a class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                    href="#" aria-expanded="false" aria-controls="collapseThree">
                                    {{__('Languagess')}}
                                </a>
                            </div>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse"
                            aria-labelledby="headingThree" data-parent="#accordionfilter">
                            <div class="panel-body">
                                <div class="ui form">
                                    <div class="grouped fields">
										@foreach($languages as $language)
                                        <div class="ui form checkbox_sign">
                                            <div class="inline field">
                                                <div class="ui checkbox mncheck">
                                                    <input type="checkbox" class="languageCheckbox" name="language[]" tabindex="0" class="hidden" value="{{ $language['id'] }}" {{--$params['language'] == 2 ? 'checked' : ''--}}>
                                                    <label>{{ $language['name'] }}</label>
                                                </div>
                                            </div>
										</div>
										@endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="panel panel-default m-0">
                            <div class="panel-heading" id="headingOne">
                                <div class="panel-title10">
                                    <a class="collapsed" data-toggle="collapse" data-target="#collapseOne"
                                        href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        {{__('Topics')}}
                                    </a>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" aria-labelledby="headingOne"
                                data-parent="#accordionfilter">
                                <div class="panel-body">
                                    <div class="ui form">
                                        <div class="grouped fields">
                                            <div class="ui form checkbox_sign">
                                                <div class="inline field">
                                                    <div class="ui checkbox mncheck">
														<div class="filter-cat-list">
															@foreach($categoryList as $cat)
															<a href="{{ route('categoriesCourses',['slug'=> $cat->slug]) }}"
																class="item channel_item">{{$cat->name}}</a>
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
				
				<button class="upload_btn clearfilt">{{__('Reset filter')}}</button>
			</form>
		</div>
	</div>
		<div class="col-cat-content">
				 <div class="filter_selector">
						<div class="ui inline dropdown flt145">
							<div class="text">{{__('Sort')}}</div>
							<i class="dropdown icon"></i>
							<div class="menu">
								<div class="item" onclick="sortChange(1)">{{__('Newest')}}</div>
								<div class="item" onclick="sortChange(2)">{{__('Lowest Price')}}</div>
								<div class="item" onclick="sortChange(3)">{{__('Highest Price')}}</div>
							</div>
						</div>
					</div>
					<div class="cat-course-flex mt-30 filtereddata">
						@forelse ($courses as $course)
						<div class="cat-course-item">
							<x-horizontal-courses :course="$course"></x-horizontal-courses>
						</div>
						@empty
						<div class="col-md-12 text-center">
							<x-nodata></x-nodata>
						</div>
						@endforelse

						
					</div>
					<div class="col-md-12 text-center">
							<div class="main-loader mt-50">
								{{$courses->appends($params)->links("vendor.pagination.semantic-ui") }}
							</div>
						</div>
				</div>
		</div>
    </div>
</div>
<script>
    "use strict";
    function sortChange(sort){
        document.getElementById("sort").value = sort;
		 ajaxupd()
    }
</script>
@endsection

@push('scripts')
<script>
	$(document).ready(() => {
		ajaxupd()
	})



	$(".js-range-slider").ionRangeSlider({
		type: "double",
		min: 0,
		max: 50000,
		onFinish: function (data) {
			$('#price_form').val(data.from);
			$('#price_to').val(data.to);

			ajaxupd()
		}
	});


	$(document).on('click','.clearfilt',function(e){
		e.preventDefault();
		$(this).closest('form')[0].reset();
		ajaxupd();
	})
	$(document).on('change','input[name="rating"]',function(){
		ajaxupd()
	})
	$(document).on('change','input[name="price"]',function(){
		ajaxupd()
	})
    $(document).on('change','input[name="discount"]',function(){
        ajaxupd()
    })
	$(document).on('change', '.languageCheckbox',function(){
		ajaxupd()
	})
	function ajaxupd()
	{
		console.log($('#filterForm').serialize())

		$.ajax({
			url:'/ajax/filters',
			method:'post',
			data: $('#filterForm').serialize(),
			success:function(d)
			{
				$('.filtereddata').html(d);
			},
			error:function()
			{
				alert('something wrong')
			}
		})
	}
</script>
@endpush