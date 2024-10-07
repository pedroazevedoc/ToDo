<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function index(Request $request) {
        return view('login');
    }

    public function register(Request $request) {
        return view('register');
    }
    
    public function register_action(Request $request) {
        /*
        **********************
        Regras para registro

        X O usuário tem que ter um nome
        X O Email tem que ser unico na tabela users
        X Password tem que ter no mínimo 6 caracteres
        X Todos os campos são REQUIRED
        **********************
        */
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = $request->only(['name', 'email', 'password']);
        $userCreated = User::create($data);
        dd($userCreated);
    }
}
