<div class="item">
    <div class="fcrse_1 mb-20">
        <div class="tutor_img">
            <a
                href="{{ route('instructorShow', ['slug'=> $ins->slug]) }}"><img
                    src="{{ file_asset($ins->image) }}" alt=""></a>
        </div>
        <div class="tutor_content_dt">
            <div class="tutor150">
                <a href="{{ route('instructorShow', ['slug'=>  $ins->slug]) }}"
                    class="tutor_name">{{$ins->name}}</a>
                @if ($ins->verify_pro)
                <div class="mef78" title="Verify">
                    <i class="uil uil-check-circle"></i>
                </div>
                @endif
            </div>
            <div class="tutor_cate">{{$ins->headline}}</div>
            <div class="tut1250">
                <!-- <span class="vdt15">{{$ins->shortNumber($ins->enroll_count)}} {{__('Students')}}</span> -->
                <span class="vdt15">{{__('Courses count:')}} {{$ins->courses_count}}</span>
            </div>
            <ul class="tutor_social_links">
                @if(!empty($ins->facebook))<li><a href="http://facebook.com/{{$ins->facebook}}" class="fb"><i class="fab fa-facebook-f"></i></a></li>@endif
                @if(!empty($ins->twitter))<li><a href="http://twitter.com/{{$ins->twitter}}" class="tw"><i class="fab fa-twitter"></i></a></li>@endif
                @if(!empty($ins->linkedin))<li><a href="http://www.linkedin.com/{{$ins->linkedin}}" class="ln"><i class="fab fa-linkedin-in"></i></a></li>@endif
                @if(!empty($ins->youtube))<li><a href="http://www.youtube.com/{{$ins->youtube}}" class="yu"><i class="fab fa-youtube"></i></a></li>@endif
            </ul>
        </div>
    </div>
</div>