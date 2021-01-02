@extends('layouts.admin')

@section('admin-content')
    <div class="container w-75 bg-white shadow p-5 rounded">
        <form method="POST" action="{{ route('admin.poll.store')}}">
            @csrf
            
            <h1 class="text-center">Create Poll</h1>
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title" autocomplete="name" placeholder="Enter poll title">
              
              @error('title')
                  <span style="color:red">
                        {{  $message }}
                  </span>
              @enderror

            </div>
            


            <div class="form-group">
                <label for="description">Description(optional)</label>
                <input type="text" class="form-control" id="description" name="description" autocomplete="description" placeholder="Enter poll decription">
            </div>

            
            <div class="form-group">
                <label for="">Poll Choices</label><br>
                @error('choices')
                  <span style="color:red">
                        {{  $message }}
                  </span>
                @enderror
                
                <input type="text" name="choices[]" value="{{old('choices') !== NULL ? old('choices')[0] : ''}}" class="form-control mb-3" id="" placeholder="Type a choice">
                <input type="text" name="choices[]" value="{{old('choices') !== NULL ? old('choices')[1] : ''}}" class="form-control mb-3" id="" placeholder="Type a choice">
                <input type="text" name="choices[]" value="{{old('choices') !== NULL ? old('choices')[2] : ''}}" class="form-control mb-3" id="" placeholder="Type a choice">
                <input type="text" name="choices[]" value="{{old('choices') !== NULL ? old('choices')[3] : ''}}" class="form-control mb-3" id="" placeholder="Type a choice">
            </div>
            

            <div class="form-group mt-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-75">Create Poll</button>
            </div>
          </form>

    </div>
    
@endsection