<?php

namespace App\Service;

use App\Models\Product;

class ProductService{

    public function getProductDetails($productId)
    {
        // Fetch product details from your database based on $productId
        $product = Product::find($productId);
        return [
            'id' => $productId,
            'name' => $product->name,
            'price' => $product->price,
        ];
    }
}