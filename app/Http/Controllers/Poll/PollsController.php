<?php

namespace App\Http\Controllers\Poll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Rules\MinChoice;
use App\Models\User;
use App\Models\Organization;
use App\Models\Poll;
use App\Models\Choice;
use App\Models\Vote;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\DB;

class PollsController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Poll::class,'poll');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $org_id = auth()->user()->organization_id;
        $org = Organization::find($org_id);

       
        $polls = app(Pipeline::class)->send(Poll::query())
        ->through([
            \App\QueryFilters\Active::class,
            \App\QueryFilters\ToVote::class,
            \App\QueryFilters\Voted::class,
            \App\QueryFilters\Sort::class
        ])
        ->thenReturn()
        ->get();
    

        return view('poll.home',compact(['org','polls']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //
        $this->validate($request,[
            'title' => ['required','max:50'],
            'description' => ['required','max:100'],
            'choices'  => ['required','array',new MinChoice], 
            'deadline' => ['required','date','after:now'],     
        ]);
     
        $poll = new Poll;
        $poll->title = $request->input('title');
        $poll->description = $request->input('description');
        $poll->organization_id = auth()->user()->organization_id;
        $poll->deadline = Carbon::parse($request->input('deadline'));
        $poll->show_result = $request->input('showResult') != NULL ? 1 : 0;
        $poll->save();

        $choices = $request->input('choices');
        foreach($choices as $c)
        {
            if($c !== NULL)
            {
                $choice = new Choice;
                $choice->poll_id = $poll->id;
                $choice->choice = $c;
                $choice->save();
            }
        }

        return redirect()->route('admin.poll.index')->with('status','Poll created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(poll $poll)
    {
        //
        $user = auth()->user();
        $selectedChoice = $poll->vote()->where('user_id',$user->id)->select('choice_id')->first();
        if($poll->deadline > Carbon::now())
        {
            return view('poll.pollview',compact('poll','selectedChoice'));

        }
        else 
        {
            return redirect()->route('admin.poll.result',['id' => $poll->id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function edit(poll $poll)
    {
        //
        return view('poll.create',compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, poll $poll)
    {
        //
        dd('update success');
        
        
    }

    public function result(Request $request, $id)
    {
        $totalVote = 0;
        $totalMember = User::where('organization_id',auth()->user()->organization_id)->count();
        $poll = Poll::where('id',$id)->with('choice')->get();
        $poll = $poll[0];
        $poll->totalVote = Vote::where('poll_id',$id)->count();

        $choice = $poll->choice->map(function($item,$key) {
            $item->voteCount = Vote::where('choice_id',$item->id)->count();
            return $item;
        });
        $maxIndex = -1;
        $maxVal = 0;
        foreach ($choice as $key => $value) {
            # code...
            if($value->voteCount > $maxVal)
            {
                $maxVal = $value->voteCount;
                $maxIndex = $key;
            }

        }
    
        if($maxIndex != -1)
        {
            $poll->maxVoteIndex = $maxIndex;
        }
        
        return view('poll.result',compact('totalMember','poll','choice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(poll $poll)
    {
        //
        $poll->delete();
        return redirect()->route('admin.poll.index')->with(['status'=>'Poll successfully deleted']);
    }
}
