<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // dd(Job::all());
    return view('home');
});

Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->get(); // eager loading
    $jobs = Job::with('employer')->paginate(10);
    // $jobs = Job::with('employer')->simplePaginate(10); // previous || next (pages in url)
    // $jobs = Job::with('employer')->cursorPaginate(10); // best performance for large datasets

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});


Route::get('/contact', function () {
    return view('contact');
});
