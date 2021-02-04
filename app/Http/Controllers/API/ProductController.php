<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * index() Get all project List
     *
     * @return response
     */
    public function index()
    {
        $products = $this->productRepository->getAll();

        return response()->json([
            'success' => true,
            'message' => 'product List',
            'data'    => $products
        ]);
    }

    /**
     * show() Find Project By ID
     *
     * @param integer $id
     * @return response
     */
    public function show($id)
    {
        $product = $this->productRepository->findById($id);
        if (is_null($product)) {
            return response()->json([
                'success' => false,
                'message' => 'product Details',
                'data'    => null
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'product Details',
            'data'    => $product
        ]);
    }

    /**
     * store() Create New Project
     *
     * @param Request $request
     * @return response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $validator = \Validator::make($formData, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Please give product name',
            'description.required' => 'Please give product description',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            ]);
        }

        $product = $this->productRepository->create($request);
        return response()->json([
            'success' => true,
            'message' => 'product Stored',
            'data'    => $product
        ]);
    }

    /**
     * update() Update project by id
     *
     * @param Request $request
     * @param integer $id
     * @return response
     */
    public function update(Request $request, $id)
    {
        $product = $this->productRepository->findById($id);
        if (is_null($product)) {
            return response()->json([
                'success' => false,
                'message' => 'product Not found',
                'data' => null,
            ]);
        }

        $formData = $request->all();
        $validator = \Validator::make($formData, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ], [
            'name.required' => 'Please give product name',
            'description.required' => 'Please give product description',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessageBag()->first(),
                'errors' => $validator->getMessageBag(),
            ]);
        }

        $product = $this->productRepository->edit($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'product Updated',
            'data'    => $product
        ]);
    }

    /**
     * destry() Delete a Project
     *
     * @param integer $id
     * @return response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findById($id);
        if (is_null($product)) {
            return response()->json([
                'success' => false,
                'message' => 'product Not found',
                'data' => null,
            ]);
        }

        $product = $this->productRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'product Deleted',
            'data'    => $product
        ]);
    }
}
