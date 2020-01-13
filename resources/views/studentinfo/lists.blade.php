@extends('studentinfo.layout')

@section('content')

<div class="container">
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Roll Num</th>
            <th>Class</th>
            <th>Age</th>
            <th>Image</th>
            <th>Hobies</th>
            <th>Action</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->roll_no}}</td>
            <td>{{$student->age}}</td>
            <td>{{$student->hobies}}</td>
            <td>
            <a href="{{route('edit', $student->id)}}">Edit</a>
            <a href="{{route('delete', $student->id)}}">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endSection
