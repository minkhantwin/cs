@extends('layouts.admin')

@section('content')
<div class="row w-100 mx-0 justify-content-center">
  <div class="col-md-8">

    <div class="card border-0 shadow mx-3 px-3 px-md-5 rounded">
        <form method="POST" class="px-sm-5" action="{{ route('admin.poll.store') }}">
            @csrf
           
            <h1 class="text-center mt-4">Create Poll</h1>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" 
                    class="form-control" 
                    @if (isset($poll))
                        value="{{$poll->title}}"
                    @else
                      value="{{ old('title') }}" 
                    
                    @endif
                    id="title" 
                    name="title" 
                    autocomplete="name" 
                    placeholder="Enter poll title">
              
              @error('title')
                  <span style="color:red">
                        {{  $message }}
                  </span>
              @enderror
  
            </div>
            
  
  
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" 
                        class="form-control"
                         id="description" 
                         @if (isset($poll))
                          value="{{$poll->description}}"
                         @else
                          value="{{ old('title') }}" 
                         @endif
                         name="description" 
                         autocomplete="description" 
                         placeholder="Enter poll decription">

                @error('description')
                  <span style="color:red">
                    {{  $message }}
                  </span>
                @enderror

            </div>
            
            <div class="form-group" id="choice-container">
                <label for="">Poll Choices</label><br>
                @error('choices')
                  <span style="color:red">
                        {{  $message }}
                  </span>
                @enderror

                @for ($i = 0; $i < 4 || (isset($poll) && $i < count($poll->choice) )  ; $i++)
                  <input type="text" 
                          name="choices[]" 
                          @if (isset($poll) && isset($poll->choice[$i]) )
                            value="{{$poll->choice[$i]->choice}}"
                          @endif
                          class="form-control mb-3" 
                          placeholder="Type a choice">
               
                @endfor

               
              </div>

            <button id="addChoice" class="btn btn-dark mb-3" type="button" data-cnt="5" onclick="(function addChoice(e) {
                var elem = $('#addChoice');
                var cnt = parseInt(elem.data('cnt'));
                if(cnt <= 10)
                {
                  var choice = '<input type=&quot;text&quot; name=&quot;choices[]&quot; value=&quot;&quot; class=&quot;form-control mb-3&quot; placeholder=&quot;Type a choice&quot;>';
                  $('#choice-container').append(choice);
                  elem.data('cnt',cnt+1);
                }
                else {
                  toastr.options.positionClass = 'toast-top-center';
                  toastr.warning('You have reached max choice count!');
                }

              })()"
            
            >Add a choice</button>
            
            <div class="form-group">
              <label for="deadline">Deadline</label>
  
              <input name="deadline" class="form-control"/>
              
                @error('deadline')
                <span style="color:red">
                      {{  $message }}
                </span>
                @enderror
            </div>
  
            <div class="form-group">
              <input id="showResult" type="checkbox" name="showResult" 
              @if (isset($poll) && $poll->show_result == 1 || !isset($poll))
                  checked
              @endif >
              <label for="showResult"> Show result</label>
            </div>
  
            <div class="form-group my-4 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-75">Create Poll</button>
            </div>
          </form>
          
    </div>
    
  </div>
</div>

<script type="text/javascript">
  instance = new dtsel.DTS('input[name="deadline"]',  {
  showTime: true
  });
</script>

    
@endsection