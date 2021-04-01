@extends(Auth::user()->is_admin === '1' ? 'layouts.admin' : 'layouts.member')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow">
                <div class="card-body px-5">

                    <div class="dropdown show">
                        <div class="setting" id="pollOptionDropdown" data-toggle="dropdown"> <img src="{{ asset('logos/gear.png') }}"/> </div>
                        @include('poll.components.option')
                    </div>



                    <h5 class="card-title dashboard-org-name text-center">{{ $poll->title }}</h5>
                    <p class="card-text text-center">{{ $poll->created_at->diffForHumans() }}</p>
                    
                    <p class="text-responsive">{{ $poll->description  }}</p>

                    
                    <div class="bg-info rounded p-2 mb-3">
                        <p class="text-center m-0" style="color: white">Total Vote : {{$poll->totalVote}} out of {{$totalMember}}</p>

                    </div>
                    
                    <div class="container-fluid mb-4">
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        
                    </div>

                    <h3 style="color: rgb(240, 102, 84)">Statistic</h3>
                    @foreach ($choice as $key => $val)

                    <div class="container p-0 mb-3 text-responsive">
                        <p class="card-text d-inline mb-0">{{$val->choice}} 
                        </p>
                        <div class="d-inline" style="color: rgb(255, 196, 0)"> {{$key === $poll->maxVoteIndex ? '( Most vote count )' : ''}} </div>
                        <p class="mb-1">{{$val->voteCount}} vote</p>
                        <div class="progress" style="height: 5px">
                            <div class="progress-bar bg-success" 
                            role="progressbar" 
                            style="width:{{ $poll->totalVote != 0 ? $val->voteCount * 100 / $poll->totalVote : 0 }}%"
                            aria-valuenow="{{$val->voteCount}}" 
                            aria-valuemin="0" 
                            aria-valuemax="{{$poll->totalVote}}"
                            ></div>
                        </div>

                    </div>
                    
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    $(function() {

        var r = 60,fs = 12;
        const choice = @json($choice);

        const data = new Array(); 

        choice.forEach(item => {
            data.push({
                y: item.voteCount,
                label: item.choice,
                legendText: item.choice,
            });
        });

      
        if($(window).width() > 768)
        {
            r = 100;
            fs = 14
        }

        var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title:{
            text: "Vote Chart",
            horizontalAlign: "center"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            showInLegend: true,
            legendMarkerType: "square",
            radius: r,
            indexLabelFontSize: fs,
            indexLabel: "#percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: data
        }]
    });
    chart.render();


    })

</script>



@endsection