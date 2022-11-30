<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($request)
    {
        return $this->user->create([
            'name' => $request->name,
            'password' => $this->hashPassword($request->password),
            'email' => $request->email,
            'role' => '0',
        ]);

    }

    public function checkLogin($email, $password)
    {
        $user = $this->user->where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function create($request)
    {
        return $this->user->create([
            'name' =>$request->name,
            'password' => $this->hashPassword($request->password),
            'email' => $request->email,
            'role' =>$this->role($request->role),
        ]);
    }

    public function getAll()
    {
       return $this->user->all();
    }

    public function getOne($id)
    {
        return $this->user->find($id);
    }

    public function hashPassword($password)
    {
        return hash::make($password);
    }

    public function role($role)
    {
        if ($role == 'admin') {
            return $role = '0';
        } else {
            return $role = '1';
        }
    }

    public function delete($id)
    {
        $user = $this->getOne($id);
        $user->delete();
    }


}
