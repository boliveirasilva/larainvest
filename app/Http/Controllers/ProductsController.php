<?php

namespace App\Http\Controllers;

use App\Entities\Institution;
use App\Entities\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var ProductService
     */
    protected $service;

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $repository
     * @param ProductService $service
     */
    public function __construct(ProductRepository $repository, ProductService $service)
    {
        $this->repository = $repository;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($institution_id)
    {
        // $products = $this->repository->all();
        $institution = Institution::findOrFail($institution_id);

        return view('institutions.products.index', compact('institution'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProductCreateRequest $request, $institution_id)
    {
        $data = array_merge($request->all(), compact('institution_id'));
        $request = $this->service->store($data);
        // $user = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('institution.product.index', $institution_id);
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
        dd(__METHOD__, 'Desenvolvimento pendente!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param         $institution_id
     * @param Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($institution_id, Product $product)
    {
        return view('institutions.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param integer              $institution_id
     * @param integer              $product_id
     *
     * @return Response
     */
    public function update(ProductUpdateRequest $request, $institution_id, $product_id)
    {
        $request = $this->service->update($request->all(), $product_id);
        // $user = ($request['success'] ? $request['data'] : null);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('institution.product.index', $institution_id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($institution_id, $product_id)
    {
        $request = $this->service->delete($product_id);

        $flash_message = (empty($request['flash_message']) ? $request['messages'] : $request['flash_message']);
        session()->flash('flash_message', $flash_message);

        return redirect()->route('institution.product.index', $institution_id);
    }
}
