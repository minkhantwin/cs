<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPoll;
use Exception;
use App\Models\Vote;
use App\Models\Poll;

class VotesController extends Controller
{
    //

    public function vote(Request $request,$key) 
    {
        $poll = Poll::find($request->input('pollId'));
       
        $vote = Vote::firstOrCreate(
            ['poll_id' => $request->input('pollId') , 'user_id' => auth()->user()->id ],
            ['choice_id' => $request->input('choiceId')]
        );

        
        return redirect()->back()->with('voted', $vote->wasRecentlyCreated ? 1 : 0);

    }


}
