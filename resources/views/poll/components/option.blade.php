
    <div class="dropdown-menu" aria-labelledby="pollOptionDropdown">
      <a class="dropdown-item p-2" href="#">
       <i class="far fa-clock"></i> Set Deadline
      </a>
      <a class="dropdown-item p-2" href="{{ route('admin.poll.edit',['poll'=>$poll->id]) }}">
        <i class="far fa-clone"></i> Duplicate Poll
      </a>
      <a class="dropdown-item p-2" href="{{ route('admin.poll.close',['poll'=>$poll->id]) }}">
         <i class="far fa-times-circle"></i> Close Poll Now
      </a>
      
      <form method="post" action="{{ route('admin.poll.destroy',$poll)}}">
        @method('delete')
        @csrf
        <button type="submit" class="dropdown-item p-2" style="outline: none !important">
          <i class="far fa-trash-alt"></i> Delete Poll
        </button>
        
      </form>

    </div>