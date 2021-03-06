<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;


/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /** @var UserRepository */
    protected $repository;

    /** @var UserService */
    protected $service;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserService $service
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->all();
        return view('user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        // $user = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
        // $user = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('user.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->delete($id);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('user.index');
    }
}
