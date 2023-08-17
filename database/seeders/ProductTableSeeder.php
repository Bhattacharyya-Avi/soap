<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>"product1",
                'details' => "this is product 1",
                'price'=> 100
            ],
            [
                'name'=>"product2",
                'details' => "this is product 2",
                'price'=> 150
            ],
            [
                'name'=>"product3",
                'details' => "this is product 3",
                'price'=> 200
            ],
        ];

        foreach ($data as $key => $value) {
            Product::create($value);
        }
    }
}
