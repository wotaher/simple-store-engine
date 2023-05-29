@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                @if(session()->get('delete_email'))
                    @php
                        $email = session()->get('delete_email');
                        $isSuccess = session()->get('delete_status') === 'SUCCESS'
                    @endphp
                    <div class="alert {{ $isSuccess ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ $isSuccess ? 'User with email address "' .$email.  '" got deleted.' : 'Failed to delete user with email address "' . $email . '".' }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <th>{{$user->name}}</th>
                        <td>{{$user->email}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('editUserForm', ['user' => $user->id])}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('deleteUser', ['user' => $user->id])}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
