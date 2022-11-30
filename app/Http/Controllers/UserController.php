<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('admin.auth.login');
    }


    public function loginPost(Request $request)
    {
        $user = $this->userService->checkLogin($request->email, $request->password);
        if ($user) {
            auth()->login($user);
            return redirect()->route('home.index');
        } elseif ($user == false) {
            return redirect()->route('admin.auth.login')->with('error','Email or password is incorrect');
        }

    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerPost(Request $request)
    {
        $this->userService->register($request);
        return redirect()->route('home.index');
    }

    public function add()
    {
        return view('admin.home.index');
    }
    public function createPost(Request $request)
    {
        $this->userService->create($request);
        return redirect()->route('welcome');
    }

    public function store(Request $request)
    {
        $this->userService->register($request);
    }

    public function edit($id)
    {
        $user = $this->userService->getOne($id);
        return view('admin.home.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFial($id);
        $data = $request->all();
        $data['password'] = hash::make($request->password);

        User::update($data);
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return view('welcome', compact(['users']));
    }

    public function destroy($id)
    {
       $this->userService->delete($id);
       return redirect()->route('welcome');
    }

}
