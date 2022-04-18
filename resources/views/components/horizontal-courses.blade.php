<div class="item">
    <div class="fcrse_1">
        <a href="{{ route('courseShow', ['slug'=>  $course->slug]) }}" class="fcrse_img">
            @if ($course->is_bestseller == 1)
            <div class="badge_seller">{{__('Bestseller')}}</div>
            @endif
            <div class="course-img" style="background: url({{ file_asset($course->cover_image) }}) no-repeat center/cover"></div>
        </a>
        <div class="fcrse_content">
            
            
            <a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="crse14s">{{ Str::limit($course->title, 45) }}</a>
            <div class="rating-box">
                @for ($i = 0; $i < 5;$i++) 
                <span class="rating-star {{$course->avg_rating > $i ? 'full-star' : 'empty-star'}}"></span>
                @endfor
            </div>

            <div class="vdtodt with-wrap">
                @if(str_replace('_', '-', app()->getLocale()) == 'Ua')
                <a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="crse-cate">{{$course->category->name_ua ?? __('No Data')}} @if($course->subcategory_id>0) | {{$course->subCategory->subname_ua ?? __('No Data')}} @endif</a>
                @else 
                <a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="crse-cate">{{$course->category->name ?? __('No Data')}} @if($course->subcategory_id>0)  | {{$course->subCategory->name ?? __('No Data')}} @endif</a>
                @endif
            </div>
            
            
            <div class="vdtodt">
                <!-- <span class="vdt14">{{$course->shortNumber($course->views)}} {{__('views')}}</span>
                <span class="vdt14">{{$course->created_at->diffForHumans()}}</span> -->
            </div>
            <div class="auth1lnkprce auth1lnkprce1">
                <!-- <p class="cr1fot"><a href="{{ route('instructorShow', ['slug'=>  $course->instructor->slug]) }}">{{$course->instructor->name ?? "No Data"}}</a></p> -->
                <div class="prce142">
                <!-- Цена есть -->
                @if ($course->is_free == 0)
                    <!-- Акция -->
					@if($course->special) 
						<div class="prce142">{{$course->special}}{{$admin_setting[7]['value']}}</div>
                        <div class="prce142 pr-2 text-danger"><s style="font-size: 15px;">{{$course->real_price}}{{$admin_setting[7]['value']}}</s></div>
					@else
                        <!-- Со скидкой -->
                        @if ($course->discount_price == 0)
                            <!-- Обычная цена -->
                            <div class="prce142">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>   
                        @else
                            @if ($course->discount_price < $course->price)
                                <div class="prce142">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>
                                <div class="prce142 pr-2 text-danger"><s style="font-size: 15px;">{{$course->price}}{{$admin_setting[7]['value']}}</s></div>
                            @else
                            <!-- Обычная цена -->
                            <div class="prce142">{{$course->real_price}}{{$admin_setting[7]['value']}}</div>
                            @endif
                        @endif
                    @endif
                @else
                    <!-- Бесплатная цена -->
                    <div class="prce142">{{__('Free course')}}</div>
                @endif
                </div>
            
                @if ($course->isbuy == 0)
                <button onclick="window.location.href = '{{ route('addtocart',['id'=>$course->id,'from'=>'normal']) }}';" class="shrt-cart-btn" title="{{__('cartadd1')}}"><i class="uil uil-shopping-cart-alt"></i></button>
                @else
                <button class="shrt-cart-btn text-success" title="{{__('cartadd2')}}"><i class="uil uil-bag"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>