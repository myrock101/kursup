<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'instructor_id', 'category_id', 'subcategory_id', 'language_id', 'title', 'subtitle', 'kurslink', 'description', 'price', 'discount_price', 'is_free', 'cover_image', 'promotional_video', 'status', 'copy', 'likes', 'dislikes', 'share', 'views', 'report_abues', 'is_featured', 'is_bestseller','slug'
    ];

    protected $appends = ['real_price', 'duration', 'avg_rating', 'isbuy','issave','isreport','special'];

    public function Content()
    {
        return $this->hasMany(CourseContent::class, 'course_id', 'id');
    }
    public function Reviews()
    {
        return $this->hasMany(CourseRating::class);
    }
    public function Language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function Instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
    public function Enroll()
    {
        return $this->hasMany(Order::class);
    }
    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function getSpecialAttribute()
	{
		$sd = SpecialDiscount::where('course_id',  $this->attributes['id'])->orderBy('percentage', 'desc')->get()->filter(function ($item) {
                    if (Carbon::now()->between($item->start_time, $item->end_time)) {
                        return $item;
                    }
                })->first();
		if(!$sd)
			return null;
		else
			return $sd->percentage;
	}

    public function getCostAttribute()
    {
        if (isset($this->attributes['price']) && isset($this->attributes['is_free']) && isset($this->attributes['discount_price'])) {
            if ($this->attributes['is_free'] == 1) {
                return 0;
            }
            if ($this->attributes['discount_price'] > 0) {

                if ($this->attributes['discount_price'] < $this->attributes['price']) {
                    return $this->attributes['discount_price'];
                }
            }
            return $this->attributes['price'];
        }

        return 0;
    }
    public function getRealPriceAttribute()
    {
        if (isset($this->attributes['price']) && isset($this->attributes['is_free']) && isset($this->attributes['discount_price'])) {
            if ($this->attributes['is_free'] == 1) {
                return __('Free');
            }
            if ($this->attributes['discount_price'] > 0) {

                if ($this->attributes['discount_price'] < $this->attributes['price']) {
                    return number_format($this->attributes['discount_price'], 0,'','');
                }
            }
            return number_format($this->attributes['price'], 0,'','');
        }

        return null;
    }
    public function getAvgRatingAttribute()
    {
        # code...
        $revData = CourseRating::where('course_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');

        if ($star > 1) {
            $t = $star / count($revData);
            return number_format($t, 1, '.', '');
        }
        return 0;
    }
    public function getDurationAttribute()
    {
        # code...
        $l = Lecture::where('course_id', $this->attributes['id'])->get();

        return $l->sum('duration');
    }
    public function getIsbuyAttribute()
    {
        # code...
        if ($id = auth('customer')->id()) {
            return Order::where([['course_id', $this->attributes['id']], ['student_id', $id]])->count();
        }
        return 0;
    }
    public function getIsreportAttribute()
    {
        # code...
        if ($id = auth('customer')->id()) {
            return ReportAbuse::where([['course_id', $this->attributes['id']], ['student_id', $id]])->count();
        }
        return 0;
    }
    public function getIssaveAttribute()
    {
        # code...
        if ($id = auth('customer')->id()) {
            return SavedCourses::where([['course_id', $this->attributes['id']], ['student_id', $id]])->count();
        }
        return 0;
    }
    public function status($status)
    {
        if ($status == 0) {
            return __('Draft');
        } elseif ($status == 1) {
            return __('Active');
        } elseif ($status == 2) {
            return __('Waiting for approved');
        } elseif ($status == 3) {
            return __('Block');
        } elseif ($status == 1) {
            return __('De-active');
        } else {
            return __('No Data');
        }

    }
    public function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {
            $num /= 1000;
        }
        return round($num, 1) . $units[$i];
    }
}
