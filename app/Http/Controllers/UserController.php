<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUsers()
    {
        return view('dashboard.users', ['users' => User::all()]);
    }

    public function delete(User $user)
    {
        try {
            $user->deleteOrFail();
            $status = 'SUCCESS';
        } catch (\Throwable $e) {
            $status = 'FAIL';
        }

        return redirect(route('listUsers'))->with(['delete_email' => $user->email, 'delete_status' => $status]);
    }

    public function edit(User $user)
    {
        return view('dashboard.editUser', ['user' => $user]);
    }

    public function update(User $user, EditUserRequest $request)
    {
        try {
            $data = $request->validated();

            $user->updateOrFail(array_filter(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'] ? Hash::make($data['password']) : null,
                    'role' => $data['role']
                ]
            )); // remove empty fields

            $status = 'SUCCESS';
        } catch (\Throwable $e) {
            $status = 'FAIL';
        }


        return redirect(route('editUserForm', ['user' => $user->id]))->with(['edit_status' => $status]);
    }
}
