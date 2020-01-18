@extends('layout')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h1 class="text-center title">Student Resigdtration form</h1>
            
            @include ('errors')
            {!! Form::open(['route' => 'addRecord', 'method' => 'post', 'files' => 'true']) !!}

            <div class="input-feilds">
                    <div class="input-col-4">
                        <input type="text" name="roll_no" placeholder="Roll no" class="{{$errors->has('roll_no') ? 'is-danger' : '' }}" value="{{ old('roll_no') }}">
                    </div>
                    <div class="input-col-4">
                        <input type="text" name="name" placeholder="Name" class="{{$errors->has('name') ? 'is-danger' : '' }}" value="{{ old('name') }}">
                    </div>
                    <div class="input-col-4">
                        {{ Form::select('class', config('student.class_names'))}}
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-6">
                        <input type="text" name="age" placeholder="D.O.B" class="{{$errors->has('age') ? 'is-danger' : '' }}" autocomplete="off" value="{{ old('age')}}">
                    </div>
                    <div class="input-col-6">
                        <div class="checkboxes">
                            <label for="" class="{{old('gender') == 'male' ? 'checked' : ''}}">Male
                                <input type="radio" name="gender" value="male">
                            </label>
                            <label for="" class="{{old('gender') == 'female' ? 'checked' : ''}}">female
                                <input type="radio" name="gender" value="female">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input-feilds">
                    <div class="input-col-12">
                        <input type="text" name="hobies" placeholder="Add your hobies" class="{{$errors->has('hobies') ? 'is-danger' : '' }}">
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
                              <img src="" alt="">
                            </div>
                        </div>
                        {{--  --}}
                    </div>
                </div>
                <button type="submit" class="btn custom-btn">Add Student record</button>
            <a  href="{{route('lists')}}" type="button" class="btn custom-btn">Back to All students list</a>
            {!! Form::close() !!}
        </div><!--form wrapper-->
    </div>
@endsection