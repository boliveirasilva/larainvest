<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        // dd(Auth::check() ? 'Usuário Logado!' : 'Acesso de Visitante...', Auth::user());
        return view('user.dashboard');
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
                $user = $this->repository->findWhere(['email' => $data['email']])->first();
                if (!$user) throw new Exception('O e-mail não foi encontrado!');

                if ($user->password !== $data['password']) throw new Exception('Senha inválida');

                Auth::login($user);
            }

        } catch (Exception $ex) {
            return $ex->getMessage();
        }

        return redirect()->route('user.dashboard');
    }
}
