
@extends('layout')

@section('title', 'Records')

@section('content')

<div class="container">
    @include('userSign')
    {{-- tabel --}}
    <div class="header-elements">
        <div class="search-box">    
            <form action="{{route('lists')}}" method="get" role="search" id="ajax-search">
                {{ csrf_field() }}
                <input type="text" name="q" id="search" placeholder="Search student by name">
                {{ Form::select('class', config('student.class_names'))}}
                <input type="text" name="age" autocomplete="off" placeholder="D.O.B">
                <button id="submit-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    
            </form>
        </div>
        <div class="add">
            <a href="{{URL::to('/')}}" class="btn btn-success">Home</a>
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
                @include('ajax')
            </div>
        </div>
        {{ $students->links() }}
    </div>
    {{-- end table --}}

@endSection
