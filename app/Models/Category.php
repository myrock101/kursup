<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'name',
        'name_ua',
        'slug',
        'image',
        'status',
    ];
	
	public function subcats()
    {
        return $this->hasMany(SubCategory::class,'category_id');
    }
	public function CntCourses()
    {
        return $this->hasMany(Course::class,'category_id')->where('status',1)->count();
    }
}
