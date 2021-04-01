@extends(Auth::user()->is_admin === '1' ? 'layouts.admin' : 'layouts.member')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::get('voted') === 1)
                <p class="d-none" id="noti" data-vote='success'></p>
            @elseif (Session::get('voted') === 0)
                <p class="d-none" id="noti" data-vote='fail'></p>
            @endif
            
            
            <div class="card border-0 shadow">
                <div class="card-body px-5">
                    
                    <div class="dropdown show">
                        <div class="setting" id="pollOptionDropdown" data-toggle="dropdown"> <img src="{{ asset('logos/gear.png') }}"/> </div>
                        
                        @include('poll.components.option')
                    </div>



                    <h5 class="header-responsive text-center">{{ $poll->title }}</h5>
                    <p class="text-responsive text-center">{{ $poll->created_at->diffForHumans() }}</p>
                    
                    <p class="text-responsive mb-0">Description :</p>
                    <p class="info-text-responsive">{{ $poll->description  }}</p>
                    
                    <p class="text-responsive label mb-0">Choose your opinion : </p>

                    <div class="row row-cols-1 row-cols-sm-2 info-text-responsive">
                        @foreach ($poll->choice as $choice)
                        <div class="col p-2">
                            <div class="choice @if($selectedChoice != NULL && $selectedChoice['choice_id'] == $choice->id) choice-selected @endif}} py-2 px-3 rounded bg-gradient" data-choice-id="{{$choice->id}}">
                                {{$choice->choice}}
                                @if($selectedChoice != NULL && $selectedChoice['choice_id'] == $choice->id)<small> ( voted ) </small> @endif
                            </div>
                        </div>
                        
                        @endforeach    
                        
                    </div>
                    <div class="row mt-5 text-responsive">
                        <div class="col">
                            <form action="../choice/vote" method="POST">
                                {{ method_field('PUT') }}
                                @csrf
                                <input type="hidden" name="pollId" value="{{ $poll->id }}">
                                <input type="hidden" id="choiceId" name="choiceId" value="">
                                <button class="btn btn-success px-md-5" id="vote" type="submit">Vote</button>
                            </form>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <form action="{{ route('admin.poll.result',['id' => $poll->id ]) }}" method="GET">

                                @csrf
                                <button class="btn btn-dark px-3" type="submit">See result</button>
                            </form>
                        </div>
                    </div>



                   

                
                </div>
            </div>
        

        </div>
    </div>
    
</div>

@endsection
