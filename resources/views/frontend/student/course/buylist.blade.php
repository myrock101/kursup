@extends('frontend.layouts.ins-master')
@section('content')
<div class="container mt-40">
    <div class="row">
        <div class="col-md-12">
            <div class="_14d25 mb-20 buylist-box">
                <h4 class="mhs_title">{{__('Bought Courses')}}</h4>
                @forelse ($orders as $order)
                <div class="fcrse_1 mb-30">
                    <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($order->course->title)),'id' => $order->course->id]) }}"
                        class="hf_img p-0">
                        <img src="{{ file_asset($order->course->cover_image) }}" alt="">
                    </a>
                    <div class="hs_content">
                        <div class="eps_dots eps_dots10 more_dropdown">
                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                            <div class="dropdown-content">
                                <a href="{{ route('order.invoice', ['id'=>$order->id]) }}" target="_blank"><span><i
                                            class='uil uil-print'></i>{{__('Invoice')}}</span></a>
                            </div>
                        </div>
                        <a href="{{ route('courseShow', ['slug'=> str_replace(' ', '-', strtolower($order->course->title)),'id' => $order->course->id]) }}" class="crse14s title900">{{Str::limit($order->course->title, 50)}}</a>
                        <div class="rating-box auth1lnkprce">
                            @for ($i = 0; $i < 5;$i++) 
                            <span class="rating-star {{$order->course->avg_rating > $i ? 'full-star' : 'empty-star'}}"></span>
                            @endfor
                        </div>

                        <p class="crse-cate auth1lnkprce mb-0">{{$order->course->category->name ?? __('No Data')}} | {{$order->course->subCategory->name ?? __('No Data')}}</p>

                        <div class="auth1lnkprce d-flex flex-column">
                            <p class="cr1fot2">{{__('buy at')}} <b>{{$order->created_at->format('d-m-Y') }}</b></p>
                            <p class="cr1fot2 mt-0">{{__('ByAuthor')}} <a href="{{ route('instructorShow', ['slug'=>  $order->course->instructor->slug]) }}">{{$order->course->instructor->name ?? __('No Data')}}</a></p>
                            <p class="cr1fot2 mt-0">{{__('Download kurslink')}}<a href="{{ $order->course->kurslink }}" class="kurs-link" target="_blank">{{Str::limit($order->course->kurslink, 50)}}</a></p>
                            <div class="buylist-price">
                            @if ($order->course->is_free == 0)
                            
                                <!-- Акция -->
                                @if($order->course->special) 
                                    <div class="prce142">{{$order->course->special}}{{$admin_setting[7]['value']}}</div>
                                    <div class="prce142 pr-2 text-danger"><s style="font-size: 15px;">{{$order->course->real_price}}{{$admin_setting[7]['value']}}</s></div>
                                @else
                                    <!-- Со скидкой -->
                                    @if ($order->course->discount_price == 0)
                                        <!-- Обычная цена -->
                                        <div class="prce142">{{$order->course->real_price}}{{$admin_setting[7]['value']}}</div>   
                                    @else
                                        @if ($order->course->discount_price < $order->course->price)
                                            <div class="prce142">{{$order->course->real_price}}{{$admin_setting[7]['value']}}</div>
                                            <div class="prce142 pr-2 text-danger"><s style="font-size: 15px;">{{$order->course->price}}{{$admin_setting[7]['value']}}</s></div>
                                        @else
                                        <!-- Обычная цена -->
                                        <div class="prce142">{{$order->course->real_price}}{{$admin_setting[7]['value']}}</div>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <!-- Бесплатная цена -->
                                <div class="prce142">{{__('Free course')}}</div>
                            
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <x-nodata></x-nodata>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection