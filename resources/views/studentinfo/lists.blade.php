@extends('studentinfo.layout')

@section('content')

<div class="container">
    {{-- tabel --}}
    <div class="header-elements">
        <div class="search-box">    
            <form action="{{route('lists')}}" method="post" role="search">
                {{ csrf_field() }}
                <input type="text" name="q" id="search" placeholder="Search student by name">
                {{ Form::select('class', config('student.class_names'))}}
                    <i class="fa fa-search" aria-hidden="true"></i>
            </form>
        </div>
        <div class="add">
            <a href="{{URL::to('/add-student/create')}}" class="btn btn-success">Add New Records</a>
        </div>
    </div>
    @include ('alert-message')
    <div class="wrapper">
  
        <div class="table">
            <div class="row header">
                <div class="cell">

                    Image
                </div>
                <div class="cell">
                    @sortablelink('name')
                    Name
                </div>
                <div class="cell">
                    @sortablelink('roll_no')
                    Roll Num
                </div>
                <div class="cell">
                    Class
                </div>
                <div class="cell">
                    Age
                </div>
                <div class="cell">
                    Gender
                </div>
                <div class="cell">
                    Hobies
                </div>
                <div class="cell">
                    Action
                </div>
            </div>
            <div class="body-table">
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
                </div>
            @endforeach
        </div>
        </div>
        {{ $students->links() }}
    </div>
    {{-- end table --}}

@endSection
