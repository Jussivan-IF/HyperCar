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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $user->ultimo_login = now();
            $user->save();

            return redirect()->intended('/register'); // Redireciona após login bem-sucedido
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }

    // Mostra o formulário de registro
    public function showRegistrationForm()
    {
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