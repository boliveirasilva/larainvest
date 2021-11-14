<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Entities\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Entities\Movement;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovementCreateRequest;
use App\Http\Requests\MovementUpdateRequest;
use App\Repositories\MovementRepository;
use App\Validators\MovementValidator;

/**
 * Class MovementsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovementsController extends Controller
{
    /**
     * @var MovementRepository
     */
    protected $repository;

    /**
     * @var MovementValidator
     */
    protected $validator;

    /**
     * MovementsController constructor.
     *
     * @param MovementRepository $repository
     * @param MovementValidator  $validator
     */
    public function __construct(MovementRepository $repository, MovementValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        $product_list = Product::all();
        return view('movement.index', compact('product_list'));
    }

    public function statement()
    {
        $movement_list = Auth::user()->movements;
        return view('movement.statement', compact('movement_list'));
    }

    public function deposit()
    {
        $user = Auth::user();
        $groups = $user->groups;
        $products = [];

        $group_list = $groups->pluck('name', 'id');
        $product_list = Product::all()->pluck('name', 'id');

        return view('movement.deposit', compact('group_list', 'product_list'));
    }

    public function depositStore(MovementCreateRequest $request)
    {
        $this->storeApplication($request->all(), 1);

        return redirect()->route('movement.deposit');
    }

    public function withdraw()
    {
        $user = Auth::user();
        $groups = $user->groups;
        $products = [];

        $group_list = $groups->pluck('name', 'id');
        $product_list = Product::all()->pluck('name', 'id');

        return view('movement.withdraw', compact('group_list', 'product_list'));
    }

    public function withdrawStore(MovementCreateRequest $request)
    {
        $this->storeApplication($request->all(), 2);

        return redirect()->route('movement.withdraw');
    }

    private function storeApplication(array $data, $movement_type)
    {
        $user_id = Auth::user()->id;

        $movement = Movement::create([
            'user_id' => $user_id,
            'group_id' => $data['group_id'],
            'product_id' => $data['product_id'],
            'value' => $data['value'],
            'type' => $movement_type,
        ]);

        session()->flash('flash_message', [
            'success' => true,
            'messages' => sprintf(
                'Seu %s de %01.2f no produto %s foi realizado com sucesso!',
                $movement_type == 1 ? 'investimento' : 'resgate',
                $movement->value,
                $movement->product->name
            ),
            'data' => null
        ]);
    }
}
