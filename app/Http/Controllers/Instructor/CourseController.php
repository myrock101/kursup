<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\CourseRating;
use App\Models\Language;
use App\Models\Lecture;
use App\Models\Order;
use App\Models\SpecialDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copyajax($id)
	{
		$course = Course::findorfail($id);
		$course->copy = $course->copy +1;
		$course->save();
		return $course->copy;
	}
    public function index()
    {
        //
        $data = Course::withCount(['content', 'enroll'])->with('category:id,name')->where('instructor_id', Auth::id())->get();
        $draft = $data->where('status', 0)->all();
        $upcoming = $data->where('status', 2)->all();
        $active = $data->where('status', 1)->all();

        $reqData['instructor_id'] = Auth::id();
        $discount = SpecialDiscount::with('course:title,id')->latest()->where('instructor_id', Auth::id())->get();
        
		return view('frontend.instructor.courses.index', compact('upcoming', 'data', 'draft', 'active', 'discount'));
    }

    public function allReview()
    {
        $ids = Course::where('instructor_id', Auth::id())->get(['id'])->pluck('id');
        $reviews = CourseRating::with(['course:id,title', 'student:id,name,image'])->whereIn('course_id', $ids)->get();
        $totr = count($reviews);
        $state['avg_rating'] = 0;
        $state['5_star'] = 0;
        $state['4_star'] = 0;
        $state['3_star'] = 0;
        $state['2_star'] = 0;
        $state['1_star'] = 0;
        if ($totr > 0) {
            $state['avg_rating'] = $reviews->sum('star') / $totr;
            if ($totr > 0) {
                for ($i = 1; $i <= 5; $i++) {
                    # code...
                    $index = $i . '_star';
                    $state[$index] = round(($reviews->where('star', $i)->count() * 100) / $totr);
                }
            }
        }
        return view('frontend.instructor.courses.review', compact('reviews', 'state'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // какая то хуйня с сессиями
		if(isset($request->currantstep)) session(['currantstep' => $request->currantstep]);
		if(isset($request->courseid)) session(['courseid' => $request->courseid]);
		
        //$currantstep = session()->has('currantstep') ? session('currantstep') : 0;
        //if ($currantstep == 0) {
		//	session()->forget('courseid');
		//	session(['currantstep' => 0]);
        //}
		$currantstep = session('currantstep');

        $languages = Language::whereStatus(1)->get();
        $category = Category::whereStatus(1)->get();
        $course_content = CourseContent::withCount('lectures')->where('course_id',  session()->get('courseid'))->get();

        return view('frontend.instructor.courses.create', compact('currantstep', 'category', 'languages', 'course_content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'bail|required|min:4|max:60',
            'subtitle' => 'bail|required|min:4|max:120',
            'description' => 'bail|required|min:4',
            'price' => "bail|required_if:is_free, ==, 0",
            'discount_price' => 'bail|required',
            'category_id' => "bail|required",
            // 'subcategory_id' => "bail",
            'language_id' => "bail|required",
            // 'kurslink' => 'required',
        ]);

        $reqData = $request->all();
		
        $reqData['instructor_id'] = Auth::id();
       if(!isset($reqData['subcategory_id'])||empty($reqData['subcategory_id'])) $reqData['subcategory_id'] = 0;
        $reqData['slug'] = \Str::slug($reqData['title']);


        $data = Course::create($reqData);

        $data->update([
            'slug' => "$reqData[slug]-$data[id]",
        ]);

        $currantstep = 1;
		session(['currantstep' => 1]);
		session(['courseid' => $data['id']]);
		$url = back()->getTargetUrl() . '?currantstep=' . 1 . '&courseid=' . $data['id'];
        return redirect($url)->withStatus(__('Course created, please fill step 2.'));
    }

    public function updateStatus($id, $status)
    {
        $course = Course::where([['instructor_id', Auth::id()], ['id', $id]])->firstOrFail();
        $course->status = $status;
        $course->save();
        return back()->withStatus(__('Updated successfully'));
    }

    public function updateMedia(Request $request)
    {
        if (!$request->courseid) {
            Session::forget('courseid');
            Session::put('currantstep', 0);
            return back()->withStatus(__('Something went wrong.'));
        }
        $course = Course::where([['instructor_id', Auth::id()], ['id', $request->courseid]])->firstOrFail();



        if ($request->has('cover_image'))
        {
            $course->cover_image = (new HelperController)->uploadfile($request->cover_image, 'upload/image');
        } else {
            $course->cover_image = 'default.png';
        }

        if ($request->hasFile('promotional_video')) {
            $course->promotional_video = (new HelperController)->uploadfile($request->promotional_video, 'upload/video');
        }
        $course->update();
        Session::put('currantstep', 2);
		
		$url = substr(url()->previous(),0,strpos(url()->previous(),'?')) . '?currantstep=' . 2 . '&courseid=' . $request->courseid;
        return redirect($url)->withStatus(__('Media uploaded, please fill step 3.'));

    }

    public function updateSession(Request $request)
    {
        $cid = Session::get('courseid');

        $c = Lecture::where('course_id', $cid)->count();
        if ($c <= 0) {
            return back()->withStatus(__('Please add at least one lecture.'));
        }
        Session::put('currantstep', $request->currantstep);
		$url = substr(url()->previous(),0,strpos(url()->previous(),'?')) . '?currantstep=' . $request->currantstep . '&courseid=' . $cid;
        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $languages = Language::whereStatus(1)->get();
        $category = Category::whereStatus(1)->get();
        $course_content = CourseContent::withCount('lectures')->where('course_id', $course->id)->get();

        return view('frontend.instructor.courses.edit', compact('languages', 'category', 'course', 'course_content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'kurslink' => 'required',
        ]);
      
        Session::forget('courseid');
		Session::forget('currantstep');
        $slug = \Str::slug($course['title']);

		$course->update($request->all() + [
            'slug' => "$slug-$course[id]"
        ]);
		return redirect()->route('courses.index')->withStatus(__('Courses successfully added.'));
    }

    public function fullUpdate(Request $request, Course $course)
    {

        $request->validate([
            'cover_image' => 'bail|sometimes|file|image|max:1024',
            'promotional_video' => 'bail|sometimes|file|max:5120',
            'title' => 'bail|sometimes|min:10|max:60',
            'subtitle' => 'bail|sometimes|min:10|max:120',
            'kurslink' => 'bail|sometimes|max:1000',
            'description' => 'bail|sometimes|min:10',
            'category_id' => "bail|sometimes",
			'subcategory_id' => "bail|sometimes",
			'language_id' => "bail|sometimes",
        ]);

        $reqData = $request->all();
        if ($request->has('cover_image') && $request->cover_image) {
            if ($course['cover_image'] != 'default.png')
            {
                (new HelperController)->deleteImage($course->cover_image);
            }

            $reqData['cover_image'] = (new HelperController)->uploadfile($request->cover_image, 'upload/image');
        } else {
            $reqData['cover_image'] = "default.png";
        }

        if ($request->input('deleteCover') == 'on')
        {
            if ($course['cover_image'] != 'default.png')
            {
                (new HelperController)->deleteImage($course->cover_image);
            }

            $reqData['cover_image'] = "default.png";
        }

		if(!isset($reqData['subcategory_id'])) {
            $reqData['subcategory_id'] = 0;
        }

        if ($request->has('promotional_video') && $request->promotional_video) {
            (new HelperController)->deleteImage($course->promotional_video);
            $reqData['promotional_video'] = (new HelperController)->uploadfile($request->promotional_video, 'upload/video');
        }

        if ($request->input('deleteVideo') == 'on')
        {
            (new HelperController)->deleteImage($course->promotional_video);
            $reqData['promotional_video'] = null;
        }

		$slug = \Str::slug($reqData['title']);

        $reqData['slug'] = "$slug-$course[id]";

        $course->update($reqData);
        return back()->withStatus(__('Courses  updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $c = Order::where('course_id', $course->id)->count();
        if ($c > 0) {
            return back()->withStatus(__('Course cant be deleted you can change status.'));
        }

        CourseContent::where('course_id', $course->id)->delete();
        $lecture =  Lecture::where('course_id', $course->id)->get();
		
		if(count($lecture)>0)
        foreach ($lecture->lectures as  $value) {
            $delete =  (new HelperController)->deleteImage($value->file);
            $value->delete();
        }
        $delete =  (new HelperController)->deleteImage($course->cover_image);
        $delete =  (new HelperController)->deleteImage($course->promotional_video);
        $course->delete();

        return back()->withStatus(__('Courses deleted successfully.'));
    }
}
