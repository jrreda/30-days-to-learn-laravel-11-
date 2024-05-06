<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $jobs = Job::with('employer')->get(); // eager loading
        $jobs = Job::with('employer')->latest()->paginate(5);
        // $jobs = Job::with('employer')->simplePaginate(10); // previous || next (pages in url)
        // $jobs = Job::with('employer')->cursorPaginate(10); // best performance for large datasets

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|min:3',
            'salary' => 'required',
        ]);
    
        $job = Job::create([
            'title'       => request('title'),
            'salary'      => request('salary'),
            'employer_id' => 1,
        ]);

        // Notice we pass an instance of User rather than 
        // an email address to the Mail::to method.
        // Laravel is smart enough to figure out the email 
        // for the given user.
        Mail::to($job->employer->user)->send(new JobPosted($job));
    
        return redirect('/jobs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        // authentication #1 & #2
        // if (Auth::guest()) {
        //     return redirect('/login');
        // }

        // authentication #1
        // if ($job->employer->user->isNot(Auth::user())) {
        //     abort(403);
        // }
        
        // authentication #2
        // Gate::authorize('jobs.edit', $job);
        
        // authentication #4
        // if (Auth::user()->cannot('jobs.edit', $job)) {
        //         abort(403);
        // }

        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        request()->validate([
            'title'  => 'required|min:3',
            'salary' => 'required',
        ]);
    
        $job->update([
            'title'       => request('title'),
            'salary'      => request('salary'),
            'employer_id' => 1,
        ]);
    
        return redirect('/jobs/' . $job->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs');
    }
}
