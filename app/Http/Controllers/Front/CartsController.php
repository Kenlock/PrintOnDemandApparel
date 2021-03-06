<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CartCreateRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Repositories\CartRepository;
use App\Validators\CartValidator;
use App\Classes\Files\ImageApparelUpload;

/**
 * Class CartsController.
 *
 * @package namespace App\Http\Controllers\Front;
 */
class CartsController extends Controller
{
    /**
     * @var CartRepository
     */
    protected $repository;

    /**
     * @var CartValidator
     */
    protected $validator;

    /**
     * CartsController constructor.
     *
     * @param CartRepository $repository
     * @param CartValidator $validator
     */
    public function __construct(CartRepository $repository, CartValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $carts = $this->repository->findByField('id_user', auth()->id())->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $carts,
            ]);
        }

        return view('front.cart.index', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CartCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CartCreateRequest $request)
    {
        try {
            // update request
            $request->request->add(['id_user' => auth()->id()]);

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            
            foreach ($request->quantity as $i => $quantity) {
                if($quantity > 0){
                    $cart = $this->repository->create([
                        'id_product' => $request->id_product,
                        'size' => $request->size[$i],
                        'color' => $request->color[$i],
                        'quantity' => $request->quantity[$i],
                        'id_user' => $request->id_user
                    ]);
                }
            }

            $response = [
                'message' => 'Added to cart.',
                'data'    => '',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route('front.cart.index'))->with('success', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $cart = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cart,
            ]);
        }

        return view('carts.show', compact('cart'));
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
        $cart = $this->repository->find($id);

        return view('carts.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CartUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CartUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            //catch image
            if($request->hasFile('imagex')){
                // upload
                $cart = $this->repository->find($id);
                $image = (new ImageApparelUpload($cart))->upload($request->file()['imagex']);
                
                // update request
                $request->request->add(['image' => $image]);
            }

            $cart = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cart updated.',
                'data'    => $cart->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('success', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Cart deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('success', 'Cart deleted.');
    }
}
