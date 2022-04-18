<div class="fcrse_1 mb-30">
    <a href="{{ route('courseShow', ['slug'=> $course->slug]) }}"
        class="hf_img">
        <img src="{{ file_asset($course->cover_image) }}" alt="">
        <!-- <div class="course-overlay">
            @if ($course->is_bestseller == 1)
            <div class="badge_seller">{{__('Bestseller')}}</div>
            @endif
            @if ($course->avg_rating > 0)
            <div class="crse_reviews">
                <i class="uil uil-star"></i>{{$course->avg_rating}}
            </div>
            @endif
        </div> -->
    </a>
    <div class="hs_content">
        <div class="eps_dots eps_dots10 more_dropdown">
            <a href="{{route('removefromsave',['id'=>$course->id])}}"><i class='uil uil-times'></i></a>
        </div>
        <a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="crse14s title900">{{Str::limit($course->title, 50)}}</a>
        <div class="rating-box auth1lnkprce">
            @for ($i = 0; $i < 5;$i++) 
            <span class="rating-star {{$course->avg_rating > $i ? 'full-star' : 'empty-star'}}"></span>
            @endfor
        </div>
        <p class="crse-cate auth1lnkprce mb-0">{{$course->category->name ?? __('No Data')}} | {{$course->subCategory->name ?? __('No Data')}}</p>
        <div class="auth1lnkprce">
            <p class="cr1fot">{{__('ByAuthor')}} <a href="#">{{$course->instructor->name ?? __('No Data')}}</a></p>
            <div class="buylist-price">
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
            
            <ul class="_215b31">

                @if ($course->is_buy >= 1)
                <li><a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="btn_buy d-flex justify-content-center align-items-center" title="{{__('you have already bought this course')}}">{{__('Watch Now')}}</a> </li>
                @else
            
                <li><a href="{{ route('courseShow', ['slug'=> $course->slug]) }}" class="btn_buy d-flex justify-content-center align-items-center" title="">{{__('Watch Now')}}</a> </li>
                @endif


            </ul>


           
        </div>
    </div>
</div>