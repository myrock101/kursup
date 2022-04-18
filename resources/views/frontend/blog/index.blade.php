@extends('frontend.layouts.ins-master')
@section('content')
	<div class="breadcrumbs">
		<div class="container mt-30">
			<div class="row">
				<div>
					<a href="{{url('/')}}">{{__('Home')}}</a> /
					<b>Блог</b>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-30">
		<div class="row">
			<div class="col-xl-12 col-lg-8">
				<div class="section3125">
					<div class="explore_search">
						<div class="ui search focus">
							<form action="{{ route('blog.list') }}" method="get">
								<div class="ui left icon input swdh11">
									<input class="prompt srch_explore" type="text" placeholder="Поиск по статьям" name="q" value="{{ request()->get('q') ?? '' }}">
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
								@forelse ($blogs as $article)
									<div class="cat-course-item">
										<div class="item">
											<div class="fcrse_1">
												<a href="{{ route('blog.view', $article['id']) }}" class="fcrse_img">
													<img src="{{ Storage::url($article['cover']) }}" alt="{{ $article['title'] }}">
												</a>

												<div class="fcrse_content">
													<a href="{{ route('blog.view', $article['id']) }}" class="crse14s">{{ $article['title'] }}</a>
												</div>
											</div>
										</div>
									</div>
								@empty
							</div>

							<div class="col-md-12 text-center">
								<x-nodata></x-nodata>
							</div>
							@endforelse

							<div class="col-md-12 text-center">
								<div class="main-loader mt-50">
									{{ $blogs->links("vendor.pagination.semantic-ui") }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

