<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Choice;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $org_id = auth()->user()->organization_id;
        $polls = Poll::where('organization_id',$org_id)->orderBy('created_at','desc')->take(10)->get();

        $vote_count = Choice::where('poll_id',$polls);

        return view('admin.dashboard')->with('polls',$polls->toArray());
        

    }


}
