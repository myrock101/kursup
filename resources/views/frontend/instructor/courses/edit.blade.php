@extends('frontend.layouts.ins-master')

@push('styles')

@endpush
@section('content')
<style>
    .badge_num {
        padding: 5px 11px;
    }

    .badge_num2 {
        padding: 5px 11px;

    }
</style>
<div class="row-author">
    <div class="col-lg-12">
        <h2 class="st_title"><i class="uil uil-book-alt"></i>{{__('Edit Courses')}}</h2>
    </div>
    <div class="col-md-12">
        <div class="card_dash1">
            <div class="card_dash_left1">
                <i class="uil uil-book-alt"></i>
                <h1>{{__('Go Back to List')}}</h1>
            </div>
            <div class="card_dash_right1">
                <button class="create_btn_dash"
                    onclick="window.location.href = '{{ route('courses.index') }}';">{{__('Back')}}</button>
            </div>
        </div>
    </div>
</div>
<div class="row-author">
    <div class="col-md-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <div class="panel-title adcrse1250">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            {{__('Edit Course')}}
                        </a>
                    </div>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body adcrse_body">
                        <form action="{{ route('courses.fullUpdate',[$course->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="discount_form">
                                        <div class="general_info10">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 text-center">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Course Title')}} <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="text"
                                                                placeholder="{{__('Insert your course title.')}}"
                                                                name="title" data-purpose="edit-course-title"
                                                                maxlength="60" value="{{old('title',$course->title)}}"
                                                                required>
                                                            <div class="badge_num" data-purpose="form-control-counter">
                                                                60</div>
                                                        </div>

                                                    </div>
                                                    @error('title')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-6 text-center">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Course Subtitle')}} <span
                                                                class="text-danger">*</span></label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="text"
                                                                placeholder="{{__('Insert your course Subtitle.')}}"
                                                                name="subtitle" data-purpose="edit-course-title"
                                                                maxlength="120" id="sub[title]"
                                                                value="{{old('subtitle',$course->subtitle)}}">
                                                            <div class="badge_num2" data-purpose="form-control-counter">
                                                                120</div>
                                                        </div>
                                                        @error('subtitle')
                                                        <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 ">
                                                    <div class="course_des_textarea mt-30 lbel25">
                                                        <label>{{__('Course Description')}}<span
                                                                class="text-danger">*</span></label>
                                                        <div class="course_des_bg">

                                                            <div class="textarea_dt">
                                                                <div class="ui form swdh339">
                                                                    <div class="field">
                                                                        <textarea name="description"
                                                                            class="id_course_description quill-editor">{{old('description',$course->description)}}</textarea>
                                                                    </div>
                                                                </div>
                                                                @error('description')
                                                                <x-invalid-feedback> {{ $message }}
                                                                </x-invalid-feedback>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 text-center">
                                                    <div class="mt-30 lbel25">
                                                        <label>{{__('Language')}}<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                        name="language_id">
                                                        <option value="">{{__('Select Language')}}</option>
                                                        @foreach ($languages ?? [] as $item)

                                                        <option value="{{$item['id']}}"
                                                            {{ $item['id'] == old('language_id',$course->language_id) ? 'selected' : ''}}>
                                                            {{$item['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('language_id')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-4 col-md-6 text-center">
                                                    <div class="mt-30 lbel25">
                                                        <label>{{__('Course Category')}}<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                        name="category_id" id="category" >
                                                        <option value="">{{__('Select Category')}}</option>
                                                        @foreach ($category ?? [] as $item)

                                                        <option value="{{$item['id']}}"
                                                            {{old('category_id',$course->category_id) == $item['id'] ? 'selected' : ''}}>
                                                            {{$item['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-4 col-md-6 text-center">
                                                    <div class="mt-30 lbel25">
                                                        <label>{{__('Course Subcategory')}}<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <select class="ui hj145 dropdown cntry152 prompt srch_explore"
                                                        name="subcategory_id" id="subCategory" >
                                                        <option value="">{{__('Select Subcategory')}}</option>

                                                    </select>
                                                    @error('subcategory_id')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="price_course">
                                            <div class="row">
                                                <div class="col-lg-12 ">
                                                    <div class="price_title">
                                                        <h4><i class="uil uil-dollar-sign-alt"></i>{{__('Pricing')}}
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-12 text-center">
                                                    <div class="mt-30 lbel25">
                                                        <label>{{__('Is Free')}}<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <select
                                                        class="ui hj145 dropdown cntry152 prompt srch_explore is_free"
                                                        name="is_free">
                                                        <option value="0"
                                                            {{old('is_free',$course->is_free) == 0 ? 'selected' : ''}}>
                                                            {{__('No')}}
                                                        </option>
                                                        <option value="1"
                                                            {{old('is_free',$course->is_free) == 1 ? 'selected' : ''}}>
                                                            {{__('Yes')}}
                                                        </option>
                                                    </select>
                                                    @error('is_free')
                                                    <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                    @enderror

                                                </div>
                                                <div class="col-lg-5 col-md-6 col-sm-6 text-center is_free_div
                                                {{old('is_free',$course->is_free) == 1 ? 'd-none' : ''}}">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Price')}}<span class="text-danger">*</span></label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="number"
                                                                placeholder="{{__('Insert your course Price.')}}"
                                                                name="price" data-purpose="edit-course-title"
                                                                value="{{old('price',$course->price)}}" required>

                                                        </div>
                                                        @error('price')
                                                        <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-6 col-sm-6 text-center is_free_div
                                                {{old('is_free',$course->is_free) == 1 ? 'd-none' : ''}}">
                                                    <div class="ui search focus mt-30 lbel25">
                                                        <label>{{__('Discount Price')}}</label>
                                                        <div class="ui left icon input swdh19">
                                                            <input class="prompt srch_explore" type="number"
                                                                placeholder="{{__('Discount Price if have .')}}"
                                                                name="discount_price" data-purpose="edit-course-title"
                                                                value="{{old('discount_price',$course->discount_price)}}">

                                                        </div>
                                                        @error('discount_price')
                                                        <x-invalid-feedback> {{ $message }} </x-invalid-feedback>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <div class="discount_form">

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img">
                                                            <img src="{{ file_asset($course->cover_image)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>{{__('Cover Image')}}</h4>
                                                        <p>{{__('Upload your course image here. It must meet our
                                                                                            course image quality standards to be accepted.
                                                                                            Important guidelines: 750x422 pixels; .jpg,
                                                                                            .jpeg,. gif, or .png. no text on the image max file size
                                                                                            1mb.')}}</p>
                                                        <div class="upload__input">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="inputGroupFile04" name="cover_image" accept="image/*">
                                                                    <label class="custom-file-label" for="inputGroupFile04">{{__('No Choose file')}}</label>
                                                                </div>
                                                                @error('cover_image')
                                                                <x-invalid-feedback> {{ $message }}
                                                                </x-invalid-feedback>
                                                                @enderror
                                                            </div>
                                                            <div class="form-check mt-3">
                                                                <input class="form-check-input" type="checkbox" value="" name="deleteCover" id="check_del_cover">
                                                                <label class="form-check-label" for="check_del_cover">
                                                                    ?????????????? ???????????????
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="view_all_dt">
                                                    <div class="view_img_left">
                                                        <div class="view__img">
                                                            @if ($course->promotional_video)
                                                            <video src="{{ file_asset($course->promotional_video) }}"
                                                                controls >
                                                            </video>
                                                            @else

                                                            <img src="{{ static_asset('frontend/images/courses/add_video.jpg')}}"
                                                                alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="view_img_right">
                                                        <h4>{{__('Promotional Video')}}</h4>
                                                        <p>{{__('Students who watch a well-made promo video are 5X
                                                                                            more likely to enroll in your course. We`ve seen
                                                                                            that statistic go up to 10X for exceptionally
                                                                                            awesome videos. Learn how to make yours awesome!. max file
                                                                                            size 5mb')}}
                                                        </p>
                                                        <div class="upload__input">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        id="inputGroupFile05" accept="video/*"
                                                                        name="promotional_video">
                                                                    <label class="custom-file-label"
                                                                        for="inputGroupFile05">N{{__('o Choose file')}}</label>
                                                                </div>
                                                                @error('promotional_video')
                                                                <x-invalid-feedback> {{ $message }}
                                                                </x-invalid-feedback>
                                                                @enderror
                                                            </div>
                                                            <div class="form-check mt-3">
                                                                <input class="form-check-input" type="checkbox" value="" name="deleteVideo" id="check_del_video">
                                                                <label class="form-check-label" for="check_del_video">
                                                                    ?????????????? ???????????
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="ui search focus mt-30 lbel25">
                                        <label>{{__('???????????? ???? ????????*')}}<i class="uil uil-info-circle icon-tooltip" data-trigger="manual" data-toggle="tooltip" data-html="true" title='<p><span style="color: red;">{{__("????????????????! ???????? ???????????? ???? ???????????????????? ?????????? ?????????????? ?????? ???? ??????????????, ?????? ???????? ?????????? ???????? ?? ???????????????????? ?? ?????????????????? ?? ??????????????????.")}}</span></p>'></i></label>
                                        <div class="ui left icon input swdh19">
                                            <input class="prompt srch_explore" type="text"
                                                placeholder="{{__('???????????? ???? ????????')}}"
                                                name="kurslink" data-purpose="edit-course-kurslink" value="{{old('kurslink',$course->kurslink)}}" required>
                                        </div>
                                    </div>
                                    @error('kurslink')
                                    <x-invalid-feedback> {{__('ValidField1')}} </x-invalid-feedback>
                                    @enderror
                                    <p>{{__('?????????? ?????????????????????? ???????????? ???? ???????????????????? ?????????? ?????? ???????????????????????? ?????????? ??????????????. ???? ???????????? ???????????? ?????? ???????? ???? ???????????????????? ?????????????? ?????? ???????????????? ????????????.')}}<br/>{{__('????????????????:')}}</p>
                                    <a class="d-block" href="https://www.dropbox.com/" target="_blank">Dropbox</a>
                                    <a class="d-block" href="https://www.google.com/intl/ru_ALL/drive/" target="_blank">Google ????????</a>
                                    <a class="d-block" href="https://mega.nz/" target="_blank">Mega</a>
                                    <a class="d-block" href="https://onedrive.live.com/about/ru-RU/" target="_blank">OneDrive</a>
                                    <a class="d-block" href="https://www.icloud.com/" target="_blank">iCloud</a>
                                    <a class="d-block" href="https://www.box.com/" target="_blank">Box</a>
                                    <a class="d-block" href="https://fex.net/" target="_blank">Fex</a><br/>
                                    
                                </div>




                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button class="discount_btn" type="submit">{{__('Save Changes')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="panel-heading mt-2" role="tab" id="headingTwo">
                    <div class="panel-title adcrse1250">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                            {{__('Course Content')}}
                        </a>
                    </div>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body adcrse_body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="discount_form">
                                    <div class="col-lg-3 col-md-6 col-12 text-right">
                                        <form action="{{ route('course-content.store-only') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $course->id}}">
                                            <div class="ui search focus mt-30 lbel25">
                                                <label>{{__('Course Content Title*')}}</label>
                                                <div class="ui left icon input swdh19">
                                                    <input class="prompt srch_explore" type="text"
                                                        placeholder="{{__('Insert your Course Content  title.')}}"
                                                        name="title" maxlength="60" required pattern="\S+" title="This
                                                        field is required">
                                                    <div class="badge_num" data-purpose="form-control-counter">60</div>
                                                </div>

                                            </div>
                                            <button class="discount_btn" type="submit">{{__('Add new')}}</button>
                                        </form>
                                    </div>

                                    <div class="table-responsive mt-4">
                                        <table class="table ucp-table" id="content-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">{{__('Content')}}</th>
                                                    <th class="cell-ta">{{__('Title')}}</th>
                                                    <th class="text-center" scope="col">{{__('lectures')}}</th>
                                                    <th class="text-center" scope="col">{{__('Volume')}}</th>
                                                    <th class="text-center" scope="col">{{__('Duration')}}</th>
                                                    <th class="text-center" scope="col">{{__('Upload Date')}}</th>
                                                    <th class="text-center" scope="col">{{__('Controls')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($course_content as $item)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="cell-ta">{{$item->title}}</td>
                                                    <td class="text-center">{{$item->lectures_count}}</td>
                                                    <td class="text-center">{{$item->lectures()->sum('volume')}}</td>
                                                    <td class="text-center">{{$item->lectures()->sum('duration')}}</td>
                                                    <td class="text-center">{{$item->updated_at->format('d M Y')}}</td>
                                                    <td class="text-center d-flex justify-content-center">
                                                        @if (!$loop->first)

                                                        <a href="{{ route('course-content.move', ['courseContent'=>$item->id,'moved'=>"up"]) }}"
                                                            title="Edit" class="gray-s"><i
                                                                class="fas fa-angle-up"></i></a>
                                                        @endif
                                                        @if (!$loop->last)

                                                        <a href="{{ route('course-content.move', ['courseContent'=>$item->id,'moved'=>"down"]) }}"
                                                            title="Edit" class="gray-s"><i
                                                                class="fas fa-angle-down"></i></a>
                                                        @endif


                                                        <a href="{{ route('course-content.edit', $item->id) }}"
                                                            title="Edit" class="gray-s"><i
                                                                class="uil uil-edit-alt"></i></a>
                                                        <form action="{{ route('course-content.destroy', $item) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="#" type="submit"
                                                                onclick="confirm('{{ __("Are you sure you want to delete this?") }}') ? this.parentElement.submit() : ''"
                                                                title="Delete" class="gray-s"><i
                                                                    class="uil uil-trash-alt"></i></a>
                                                        </form>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ static_asset('frontend/js/course.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    "use strict";
    var subid = "{{$course->subcategory_id}}";

   $(function () {
        var id = $('#category').val();
        categoryChange(id);


        $('.quill-editor').each(function(i, el) {
            var el = $(this), id = 'quilleditor-' + i, val = el.val(), editor_height = 200;
            var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
            el.addClass('d-none');
            el.parent().append(div);

            var quill = new Quill('#' + id, {
                theme: 'snow',
                modules: {
                    'syntax': true,
                    'toolbar': [
                    [{ 'font': [] }, { 'size': [] }],
                    [ 'bold', 'italic', 'underline', 'strike' ],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
                    [{ 'script': 'super' }, { 'script': 'sub' }],
                    [{ 'align': [] }],
                    [ 'link' ],
                    ]
                }
            });
            quill.on('text-change', function() {
                // el.val(quill.getContents());
                el.val(quill.root.innerHTML);
            });
        });





        //summernote
        // $('.id_course_description').summernote({
        //     height: 330,
        //     lang: 'ru-RU',
        //     focus: true,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
        //         ['fontname', ['fontname']],
        //         ['fontsize', ['fontsize']],
        //         ['color', ['forecolor', 'backcolor']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['height', ['height']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'hr']],
        //         ['view', ['fullscreen', 'codeview']],
        //         ['misc', ['undo', 'redo']],
        //     ]
        // });
       
        //summernote end

        
        $('#category').change(function () {
            var id = $(this).val();
            categoryChange(id)
			$('#category option[value='+id+']').prop('selected',true);
        });
        $('#subCategory').change(function () {
            var id = $(this).val();
			$('#subCategory option[value='+id+']').prop('selected',true);
        });
    });

    function categoryChange(id) {
        $('#subCategory').html('');
        $.ajax({
            url: "{{ url('category/') }}" + '/' + id,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var len = 0;
                if (response.data != null) {
                    len = response.data.length;
                }

                if (len > 0) {
                    $("#subCategory").append('<option value="0">???????????????? ????????????????????????</option>');
                    for (var i = 0; i < len; i++) {
                        var id = response.data[i].id;
                        var selected = subid == id ? 'selected' : ''
                        var name = response.data[i].name;
                        var option = "<option " + selected + " value='" + id + "'>" + name + "</option>";

                        
                        $("#subCategory").append(option);
                    }
                    
                    subid = "";
                }
            }
        })
    }
</script>
@endpush