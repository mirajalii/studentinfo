@extends('studentinfo.layout')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h1 class="text-center title">Student Resigdtration form</h1>
            {!! Form::open(['route' => 'addRecord', 'method' => 'post', 'files' => 'true']) !!}
            <div class="input-feilds">
                    <div class="input-col-4">
                        <input type="text" name="roll_no" placeholder="Roll no">
                    </div>
                    <div class="input-col-4">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="input-col-4">
                        {{ Form::select('class', config('student.class_names'))}}
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-6">
                        <input type="text" name="age" placeholder="D.O.B">
                    </div>
                    <div class="input-col-6">
                        <div class="checkboxes">
                            <label for="">Male
                                <input type="radio" name="gender" value="male">
                            </label>
                            <label for="">Female
                                <input type="radio" name="gender" value="female">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-12">
                        <input type="text" name="hobies" placeholder="Add your hobies">
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-12">
                        {{--  --}}
                        <div class="file-upload">
                            <div class="image-upload-wrap">
                              <input class="file-upload-input" type='file' name="image" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                        </div>
                        {{--  --}}
                    </div>
                </div>
                <button type="submit" class="btn custom-btn">Add Student record</button>
            <a  href="{{route('lists')}}" type="button" class="btn custom-btn">List</a>
            {!! Form::close() !!}
        </div><!--form wrapper-->
    </div>
@endsection