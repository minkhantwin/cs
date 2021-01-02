<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MinChoice;
use App\Models\Poll;
use App\Models\Choice;

class PollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('polls/create');
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
            'title' => 'required',
            'choices'  => ['required','array',new MinChoice]           
        ]);

        $poll = new Poll;
        $poll->title = $request->input('title');
        $poll->description = $request->input('description');
        $poll->organization_id = auth()->user()->organization_id;
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

        return redirect('/admin')->with('success','Poll created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
