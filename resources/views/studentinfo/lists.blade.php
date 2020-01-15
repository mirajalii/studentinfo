@extends('studentinfo.layout')

@section('content')

<div class="container">
    {{-- tabel --}}
    <div class="header-elements">
        <div class="search-box">    
            <form action="{{route('lists')}}" method="post" role="search">
                {{ csrf_field() }}
                <input type="text" name="q" value="miraj" placeholder="Search student records">
                <i class="fa fa-search" aria-hidden="true"></i>
            </form>
        </div>
        <div class="add">
            <a href="{{URL::to('/add-student/create')}}" class="btn btn-success">Add New Records</a>
        </div>
    </div>
    <div class="wrapper">
  
        <div class="table">
            <div class="row header">
                <div class="cell">
                    
                    Image
                </div>
                <div class="cell">
                    Name
                </div>
                <div class="cell">
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
            @foreach($students as $student)
                <div class="row">
                    <div class="cell"> 
                        @if($student->image)
                        <img src="{{URL::asset('assets/images/')}}/{{ $student->image}}" alt=""/>
                        @else
                            <img src="{{URL::asset('assets/images/')}} /profile404.jpg" alt=""/>
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
                            <a href="{{route('delete', $student->id)}}" class="btn btn-danger">Delete</a>
                        </span> 
                    </div>
                </div>
            @endforeach
        </div>
        {{ $students->links() }}
        {{-- <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="{{$student->currentPage()}}" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> --}}
    </div>
    {{-- end table --}}

@endSection
