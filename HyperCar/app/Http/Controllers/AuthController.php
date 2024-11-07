<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostra o formulário de login
    public function showLoginForm()
    {
        return view('auth.login'); // Verifiquei que a view login existe em resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|string|in:user,admin,company'
        ]);

        $credentials = $request->only('email', 'password');

        // Tentativa de login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role === $request->role){
                $token = $user->createToken('access_token')->plainTextToken;
            } else {
                return $this->response(403, 'Permission denied');
            }

            return $this->response(200, 'Authorized', ['token' => $token, 'role' => $user->role]);
        } else {
            return $this->response(400, 'Not Authorized');
        }
        }

    // Mostra o formulário de registro
    public function showRegistrationForm(){
        return view('auth.register'); // A view deve existir em resources/views/auth/register.blade.php
    }

    // Realiza o registro do usuário
    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:120',
            'email' => 'required|string|email|max:100|unique:users',
            'cpf' => 'required|string|size:11|unique:users',
            'endereco' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cria um novo usuário com os campos do banco atualizados
        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'endereco' => $request->endereco,
            'password' => bcrypt($request->password), // Altere "senha" para "password"
        ]);

        return redirect()->route('login')->with('success', 'Registro realizado com sucesso!'); // Redireciona após registro bem-sucedido
    }
}