        <h1>dfdf</h1>
        @foreach($students as $student)
            <div class="row">
                <div class="cell"> <img src="{{ $student->image }}" alt=""/></div>
                <div class="cell">{{$student->name}}</div>
                <div class="cell">{{$student->roll_no}}</div>
                <div class="cell">{{$student->class}}</div>
                <div class="cell">{{$student->age}}</div>
                <div class="cell">{{$student->gender}}</div>
                <div class="cell">{{$student->hobies}}</div>
                <div class="cell">
                    <span>
                        <a href="{{route('edit', $student->id)}}" class="btn btn-success">Edit</a>
                        <a href="{{route('delete', $student->id)}}" class="btn btn-danger">Delete</a>
                    </span> 
                </div>
            </div>
        @endforeach
    {{-- end table --}}
