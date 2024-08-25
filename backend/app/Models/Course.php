<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    //course mempunyai category
    public function category(){
        return $this ->belongsTo(Category::class, 'category_id');
    }

    //course mempunyai banyak questions
    public function question(){
        return $this ->hasMany(CourseQuestion::class, 'course_id', 'id');
    }
    public function students(){
        return $this ->belongsToMany(User::class,'course_students', 'course_id', 'user_id');
    }
}
