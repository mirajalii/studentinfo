@extends('layout')

@section('title', $students->name)

@section('content')

<div class="container">
    <div class="single-inner">
        <div class="row">
            <div class="col-md-3">
                <div class="image-pro">
                    @if($students->image)
                        <img src="{{URL::asset('assets/images/')}}/{{ $students->image }}" alt="">
                    @else
                    <img src="{{URL::asset('assets/images/')}}/profile404.jpg" alt="">

                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <ul class="details">
                    <li> <strong>Roll Number:</strong> {{ $students->roll_no }} </li>
                    <li> <strong>Name:</strong> {{ $students->name }} </li>
                    <li> <strong>Class:</strong> {{ $students->class }} </li>
                    <li> <strong>B.O.D:</strong> {{ $students->age }} </li>
                    <li> <strong>Gender:</strong> {{ $students->gender }} </li>
                    <li> <strong>hobies:</strong> {{ $students->hobies }} </li>
                </ul>
            </div>
        </div>
        <a  href="{{route('lists')}}" type="button" class="btn custom-btn">Back to All student lists</a>
    </div>
</div>


@endSection
