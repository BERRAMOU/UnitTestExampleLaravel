<?php
use \App\Product;
use \App\Order;
class OrderTest extends PHPUnit_Framework_TestCase{


    public function createOrderWithProduct(){
        $order = new  Order();

        $product  = new Product('prod 1' , 40);
        $product2 = new Product('prod 2' , 50);

        $order->add($product);
        $order->add($product2);

        return $order ;
    }
    /** @test */

    function an_order_consists_of_products(){

       $order = $this->createOrderWithProduct();
        $this->assertCount(2 , $order->products());

    }

    /** @test */

    function  an_order_can_determine_the_total_cost_of_all_its_products(){

        $order = $this->createOrderWithProduct();
        $this->assertEquals(90 , $order->total2());
    }
}