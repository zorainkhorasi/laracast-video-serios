<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use Illuminate\Http\Request;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs=JobListing::with('employer')->latest()->paginate(3);

        return view('jobs.index',compact('jobs'));
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
                     request()->validate([
                    'title' => ['required', 'min:3'],
                    'salary' => ['required']
                ]);

                $job=JobListing::create([
                    'title' => request('title'),
                    'salary' => request('salary'),
                    'employer_id' => 1
                ]);

                Mail::to($job->employer->user)->queue(
                    new JobPosted($job)
                );

                return redirect('/');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $findJob)
    {
        return view('jobs.show',compact('findJob'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $job)
    {
        //check if not login

        // if(Auth::guest())
        // {
        //     return redirect('/');     
        // }
        

        //check if user who creates job and auth user is same or not

        // if($job->employer->user->isNot(Auth::user()))
        // {
        //     abort(403);
        // }

        // Gate::authorize('user-edit', $job);

        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
    
        // authorize (On hold...)
    
        // $job = JobListing::findOrFail($id); //if fail will take you to the 403 abort page
    
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
    
        return redirect()->route('listing',$job->id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job)
    {
        $job->delete();
        return redirect('/');
    }
}
