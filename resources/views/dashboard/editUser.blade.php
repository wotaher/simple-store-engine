@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card p-3">
                <h3>Edit user {{$user->email}}</h3>

                <form action="{{route('editUser', ['user' => $user->id])}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"
                               required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"
                               required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input type="password" id="password" name='password'
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm new password</label>
                        <input type="password" id="password_confirmation" name='password_confirmation'
                               class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">User role</label>
                        <select type="password" id="role" name='role'
                               class="form-control @error('role') is-invalid @enderror">
                            <option value="admin" @if($user->isAdmin()) selected @endif>Admin</option>
                            <option value="mod" @if($user->isMod()) selected @endif>Mod</option>
                            <option value="user" @if($user->isNormalUser()) selected @endif>User</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>

                @if(session()->get('edit_status'))
                    @php
                        $isSuccess = session()->get('edit_status') === 'SUCCESS'
                    @endphp
                    <div class="alert {{ $isSuccess ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ $isSuccess ? 'Successfully modified the user.' : 'Something did not work as expected' }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
