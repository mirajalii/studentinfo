@extends('layout')

@section('title', 'Edit')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h1 class="text-center title">Student Resigdtration form</h1>
            {!! Form::open(['route' => ['update', $id], 'method' => 'post', 'files' => 'true']) !!}
            <div class="input-feilds">
                    <div class="input-col-4">
                    <input type="text" name="roll_no" value="{{$student->roll_no}}" placeholder="Roll no">
                    </div>
                    <div class="input-col-4">
                        <input type="text" name="name" value="{{$student->name}}" placeholder="Name">
                    </div>
                    <div class="input-col-4">
                        {{ Form::select('class', config('student.class_names'), $student->class)}}
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-6">
                        <input type="text" name="age" value="{{$student->age}}" placeholder="D.O.B" autocomplete="off">
                    </div>
                    <div class="input-col-6">
                        <div class="checkboxes">
                            @if($student->gender == 'male')
                                <label for="" class="checked">Male
                                        <input type="radio" name="gender" value="male" checked="checked">
                                </label>
                                <label for="">Female
                                    <input type="radio" name="gender" value="Female">
                                </label>
                            @else
                                <label for="">Male
                                    <input type="radio" name="gender" value="male">
                                </label>
                                <label for="" class="checked">Female
                                    <input type="radio" name="gender" value="Female" checked="checked">
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-12">
                        <input type="text" name="hobies" value="{{$student->hobies}}" placeholder="Add your hobies">
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-12">
                        {{--  --}}
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' value="{{$student->image}}" name="image" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            
                            @if($student->image)
                                <img src="{{URL::asset('assets/images/')}}/{{ $student->image}}" alt="">
                                <a href="{{ route('imageDelete',$student->id) }} "><i class="fa fa-trash" aria-hidden="true"></i></a>                                
                            @else
                                <img src="{{URL::asset('assets/images/')}}/upload.png" alt="">
                            @endif
                        </div>
                        {{--  --}}
                    </div>
                </div>
                <button type="submit" class="btn custom-btn">Update Student record</button>
            <a  href="{{route('lists')}}" type="button" class="btn custom-btn">List</a>
            {!! Form::close() !!}


        </div><!--form wrapper-->
    </div>
@endsection