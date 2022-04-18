<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'name',
        'subname_ua',
        'slug',
        'status',
        'category_id'
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function CntCourses()
    {
        return $this->hasMany(Course::class,'subcategory_id')->where('status',1)->count();
    }
}
