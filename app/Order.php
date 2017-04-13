<?php

namespace app;


class Order
{

    protected $products = [];

    public function add(Product $product)
    {
        $this->products[] = $product ;
    }

    public function products()
    {
     return $this->products;
    }

    public function total()
    {
        $somme  = 0;

        foreach ($this->products as  $product ){
            $somme += $product->price(); 
        }
        return $somme;
    }

    public function total2()
    {
        return array_reduce($this->products , function ($carry , $product ){
            return $carry  + $product->price();
        });
        
    }
}