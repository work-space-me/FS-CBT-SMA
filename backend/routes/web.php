<?php

use App\Http\Controllers\CourseAnswerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseQuestionController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\learningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAnswerController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        // domain.com/dashboard/courses
        // -------------
        // TEACHER
        // -------------
        Route::resource('courses',CourseController::class)
        ->middleware('role:teacher');
         //Create
        Route::get('/course/questions/create/{course}',[CourseQuestionController::class, 'create'])
        ->middleware('role:teacher')
        ->name('course.question.create');
        //save
        Route::post('/course/questions/save/{course}',[CourseQuestionController::class, 'store'])
        ->middleware('role:teacher')
        ->name('course.question.store');  
        // --------------
        // Teacher to student
        // --------------
        //show
        Route::get('/course/student/show/{course}',[CourseStudentController::class, 'index'])
        ->middleware('role:teacher')
        ->name('course.course_student.index');
        //create
        Route::get('/course/student/create/{course}',[CourseStudentController::class, 'create'])
        ->middleware('role:teacher')
        ->name('course.course_student.create');
        //save
        Route::post('/course/student/save/{course}',[CourseStudentController::class, 'store'])
        ->middleware('role:teacher')
        ->name('course.course_student.store');
        // --------------
        // STUDENT
        // --------------
        route::get('/learning',[learningController::class, 'index'])
        ->middleware('role:student')
        ->name('learning.index');
        
        route::get('/learning/{course}/{question}',[learningController::class, 'learning'])
        ->middleware('role:student')
        ->name('course.learning');
        
        Route::post('/learning/{course}/{question}',[StudentAnswerController::class, 'store'])
        ->middleware('role:student')
        ->name('course.learning.student_answer.store');
        
        Route::get('/learning/finished/{course}',[learningController::class, 'learning_finished'])
        ->middleware('role:student')
        ->name('course.learning.learning_finished');
        
        Route::get('/learning/report/{course}',[learningController::class, 'learning_report'])
        ->middleware('role:student')
        ->name('course.learning.learning_report');

    });

});

require __DIR__.'/auth.php';
