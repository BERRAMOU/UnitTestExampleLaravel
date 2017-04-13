<?php
/**
 * Created by PhpStorm.
 * User: beramos
 * Date: 4/12/17
 * Time: 2:33 PM
 */

namespace tests\Unit;

use App\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->product = new Product('prod1', 145);

    }

    /** @test */
    function a_product_has_name()
    {
        $this->assertEquals('prod1', $this->product->name());
    }

    /** @test */
    function a_product_has_price()
    {
        $this->assertEquals(145, $this->product->price());
    }
}