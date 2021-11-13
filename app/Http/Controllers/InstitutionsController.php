<?php

namespace App\Http\Controllers;

use App\Services\InstitutionService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionCreateRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Repositories\InstitutionRepository;


/**
 * Class InstitutionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionsController extends Controller
{
    /** @var InstitutionRepository */
    protected $repository;

    /** @var InstitutionService */
    private $service;


    /**
     * InstitutionsController constructor.
     *
     * @param InstitutionRepository    $repository
     * @param InstitutionService $service
     */
    public function __construct(InstitutionRepository $repository, InstitutionService $service)
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
        $institutions = $this->repository->all();

        return view('institutions.index', compact('institutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        // $user = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('institution.index');
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
        $institution = $this->repository->find($id);

        return view('institutions.show', compact('institution'));
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
        $institution = $this->repository->find($id);

        return view('institutions.edit', compact('institution'));
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

        return redirect()->route('institution.index');
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

        return redirect()->route('institution.index');
    }
}
