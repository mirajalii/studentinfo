
@extends('layout')

@section('title', 'Records')

@section('content')

<div class="container">
    @include ('alert-message')
    <div class="wrapper">
        <div class="table roles-table">
            <div class="row header">
                <div class="cell">
                    Name
                </div>
                <div class="cell">
                    Email
                </div>
                <div class="cell">
                    role
                </div>
                <div class="cell">
                    Action
                </div>
            </div>
            <div class="body-table">
                @foreach($users as $user)
                    
                
                <div class="row">
                    <div class="cell"> 
                        {{$user->name}}
                    </div>
                    <div class="cell"> 
                        {{$user->email}}
                    </div>
                    <div class="cell"> 
                        
                        @if($user->roles == 1)
                            admin
                        @else
                            Guest
                        @endif
                        {!! Form::open(['route' => ['editRole', $user->id], 'method' => 'post', 'files' => 'true', 'class' => 'roleChnages']) !!}

                            <select name="roles" id="">
                                <option value="">Change role</option>
                                <option value="0">Guest</option>
                                <option value="1">Admin</option>
                            </select>
                        {!! Form::close() !!}

                    </div>
     
                    <div class="cell">
                        <span>
                            <a href="#" class="btn btn-success">Edit</a>
                            <a onclick="return confirm('Are you sure?')" href="#" class="btn btn-danger">Delete</a>
                        </span> 
                    </div>
                </div>
                @endforeach<!--row-->
            </div>
        </div>
    </div>
    {{-- end table --}}

@endSection
