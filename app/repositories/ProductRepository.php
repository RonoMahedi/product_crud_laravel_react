<?php

namespace App\repositories;

use App\Product;
use App\interfaces\CrudInterface;
use Illuminate\Http\Request;

class ProductRepository implements CrudInterface
{
    public function getAll()
    {
        $products=Product::all();
        return $products;
    }
    public function findById($id)
    {
        $product=Product::find($id);
        return $product;
    }
    public function create(Request $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return $product;
    }
    public function edit(Request $request, $id)
    {
        $product = $this->findById($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return $product;
    }
    public function delete($id)
    {
        $product = $this->findById($id);
        $product->delete();
        return $product;
    }
}
