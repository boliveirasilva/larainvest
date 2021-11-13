<?php

namespace App\Http\Controllers;

use App\Repositories\InstitutionRepository;
use App\Repositories\UserRepository;
use App\Services\GroupService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /** @var GroupRepository */
    protected $repository;

    /** @var GroupService */
    private $service;
    /**
     * @var UserRepository
     */
    private $user_repository;
    /**
     * @var InstitutionRepository
     */
    private $institution_repository;

    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupService $service
     */
    public function __construct(
        GroupRepository $repository,
        GroupService $service,
        UserRepository $user_repository,
        InstitutionRepository $institution_repository
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->user_repository = $user_repository;
        $this->institution_repository = $institution_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->repository->all();
        $users_list = $this->user_repository->selectBox();
        $institutions_list = $this->institution_repository->selectBox();

        return view('groups.index', compact('groups', 'users_list', 'institutions_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        // $group = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id)
    {
        $request = $this->service->userStore($group_id, $request->all());

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('group.show', $group_id);
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
        $group = $this->repository->find($id);
        $users_list = $this->user_repository->selectBox();

        return view('groups.show', compact('group', 'users_list'));
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
        $group = $this->repository->find($id);
        $users_list = $this->user_repository->selectBox();
        $institutions_list = $this->institution_repository->selectBox();

        return view('groups.edit', compact('group', 'users_list', 'institutions_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GroupUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
        // $group = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('group.index');
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

        return redirect()->route('group.index');
    }
}
