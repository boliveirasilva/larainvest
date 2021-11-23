<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login()
    {
        return view('user.login');
    }

    public function auth(Request $request)
    {
        $data = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];

        try {
            if (env('PASSWORD_HASH')) {
                $user = Auth::attempt($data);
                if (!$user) throw new Exception("Credencial inválida!");

            } else {
                $user = User::where('email', $data['email'])->first();
                if (!$user) throw new Exception('O e-mail não foi encontrado!');

                if ($user->password !== $data['password']) throw new Exception('Senha inválida');

                Auth::login($user);
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return redirect()->route('group.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
