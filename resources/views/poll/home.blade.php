
@extends(Auth::user()->is_admin === '1' ? 'layouts.admin' : 'layouts.member')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card border-0 rounded shadow pb-3">

              <div class="card-header border-0 pt-2 bg-info">
                <p class="text-white text-center info-text-responsive">Poll Dashboard</p>

              </div>

                <div class="card-body rounded-top bg-white px-md-3" style="margin-top: -20px;z-index:9;">
                    @if (Session::has('status'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                   
                    <h1 class="header-responsive">{{ $org->name  }}</h1>
                   
                    <div class="row my-1 text-responsive">
                      <div class="col">
                        <select id="pollSelection" class="custom-select mb-3" style="width: 100px !important">
                          <option value="all" >All</option>
                          <option value="active"  @if (request('active') !== NULL) selected @endif>
                            Active
                          </option>
                          <option value="to_vote"  @if (request('tovote') !== NULL) selected @endif>
                            To vote
                          </option>
                          <option value="voted"   @if (request('voted') !== NULL) selected @endif>
                            Voted
                          </option>
                        </select>
                      </div>
                      <div class="col">
                        Member : {{ $org->user()->count() }}
                      </div>
                      
                      <div class="col d-none d-sm-block">
                        {{date('d-m-Y')}}
                      </div>
                    </div>
                      
                    <table class="table poll-table text-responsive" style="cursor: default">
                      <thead>
                        <tr>
                          <th scope="col">Title</th>
                          <th scope="col">Deadline</th>
                          <th scope="col">Time</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($polls as $poll)
                          <tr id="{{ $poll->id }}">
                            <td class="poll-title" data-poll-id="{{ $poll->id }}">{{  $poll->title  }}</td>
                            <td>{{ date('H:i d-m-Y', strtotime($poll->deadline)) }}</td>
                            <td>{{ $poll->created_at->diffForHumans() }} </td>
                            
                            @if (Auth::user()->is_admin === '1')

                            <td>
                              <div class="dropdown dropleft">
                                <i class="fa fa-caret-down dropdown-toggle" style="cursor:pointer; font-size:18px;" id="pollOptionDropdown" data-toggle="dropdown"></i>  
                                @include('poll.components.option')
                              </div>
                              
                            </td>
                            

                            @endif
                              
                          </tr>
                            
                        @endforeach
                        
                      </tbody>
                    </table>
        
                </div>
            </div>


        </div>
    </div>
</div>

<script>
  function deletePoll()
  {
    console.log('delete poll');
    console.log(this);

  }

</script>

@endsection
