@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-column align-items-center">

      <div class="container shadow p-5 mb-5 bg-white rounded">
        <div class="row">
          <div class="col-md-5 d-flex flex-column justify-content-center">
            <h2 class="header-responsive">What is {{ config('app.name', 'Collective Survey')}}?</h2>
            <p class="awesome-font info-text-responsive">
              Collective survey is a survey website for bussiness group, organization, camp,etc. It offers online voting
              and survey system within community.
            </p>
            
          </div>
          <div class="col-md-7 ">
            <img class="w-100" src="{{asset('images/bg_home.jpg')}}"/>

          </div>

        </div>
        
      
      </div>
  

      <div id="carouselExampleCaptions" class="carousel slide w-75 shadow bg-white rounded" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('images/bg_poll.jpg') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Create Poll Now</h5>
                <p>Voting for things of your organization,group,squad,etc..</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('images/bg_survey.jpg') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('images/bg_meeting.jpg') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>

        </div>
    
      
    
    </div>

</div>
@endsection
