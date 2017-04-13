<?php
namespace App;

class Product {
	
    public $name;
    public $price;

    /**
     * Product constructor.
     * @param $name
     * @param $price
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    function name(){
        return $this->name;
    }



    function price(){
        return $this->price;
    }

}

?>