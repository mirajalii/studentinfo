@foreach($students as $student)
    <div class="row">
        <div class="cell"> 
            @if($student->image)
            <img src="{{URL::asset('assets/images/')}}/{{ $student->image}}" alt=""/>
            @else
                <img src="{{URL::asset('assets/images/')}}/profile404.jpg" alt=""/>
            @endif
        </div>
        <div class="cell">{{$student->name}}</div>
        <div class="cell">{{$student->roll_no}}</div>
        <div class="cell">{{$student->class}}</div>
        <div class="cell">{{$student->age}}</div>
        <div class="cell">{{$student->gender}}</div>
        <div class="cell">{{$student->hobies}}</div>
        <div class="cell">
            <span>
                <a href="{{route('edit', $student->id)}}" class="btn btn-success">Edit</a>
                <a onclick="return confirm('Are you sure?')" href="{{route('delete', $student->id)}}" class="btn btn-danger">Delete</a>
                <a href="{{route('single', $student->id)}}" class="btn btn-success">show</a>
            </span> 
        </div>
    </div><!--row-->
@endforeach