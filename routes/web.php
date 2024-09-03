<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\JobListing;
use Illuminate\Support\Facades\Route;



Route::get('/test', function(){

        $jobs=JobListing::first();

        TranslateJob::dispatch($jobs)->delay(2);    //this will call jobclass and run that logic under that and delay it with 2 secs

    return 'done';

});

// index
Route::get('/',[JobListingController::class,'index'])->name('jobs.index');
// Create
Route::get('/jobs/create',[JobListingController::class,'create'])->name('jobs.create')->middleware('auth')->can('job-create');
//show
Route::get('/listing/{findJob}',[JobListingController::class,'show'])->name('listing');
// Store
Route::post('/jobs',[JobListingController::class,'store'])->name('jobs.store');
// Edit
Route::get('/jobs/{job}/edit',[JobListingController::class,'edit'])->name('jobs.edit')->middleware('auth')->can('update','job');
// Update
Route::post('/jobs/{job}',[JobListingController::class,'update'])->name('jobs.update');
// // Destroy
Route::delete('/jobs/{job}',[JobListingController::class,'destroy']);


Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});



// Auth
Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout',[SessionController::class,'destroy']);


//route model binding with jobs in route 

// Route::get('/listing/{findJob}',function( JobListing $findJob){   //route model binding    

//     //it will fill that id from jobListing table automaticaly


//     // $findJob=JobListing::find($id);


//     return view('jobs.show',compact('findJob'));
// })->name('listing');
