<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use App\Services\PurchaseService;

class PurchaseServiceTest extends TestCase
{

    public function testInventory()
    {
        // Set up mock Redis data
        Redis::shouldReceive('get')->andReturn(5, 10)->twice();
        Redis::shouldReceive('get')->with('coin_inventory')->andReturn(50)->once();

        // Call the method
        $result = PurchaseService::inventory();
        // Assert the result
        $this->assertEquals(15, $result['all_inventory_count']);
        $this->assertEquals(['coca' => 5, 'coffee' => 10], $result['inventory']->all());
        $this->assertEquals(50, $result['coin_inventory']);
    }

    public function testHasInventory()
    {
        // Set up mock Redis data
        Redis::shouldReceive('get')->andReturn(2)->once();

        // Call the method
        $hasInventory = PurchaseService::hasInventory('coca');

        // Assert the result
        $this->assertTrue($hasInventory);
    }

    public function testCoinInventory()
    {
        // Set up mock Redis data
        Redis::shouldReceive('get')->with('coin_inventory')->andReturn(100)->once();

        // Call the method
        $coinInventory = PurchaseService::coinInventory();

        // Assert the result
        $this->assertEquals(100, $coinInventory);
    }

    public function testPurchaseProduct()
    {
        // Set up mock Redis data
        Redis::shouldReceive('get')->with('coin_inventory')->andReturn(100);
        Redis::shouldReceive('get')->with('coca')->andReturn(100);
        Redis::shouldReceive('decr')->with('coin_inventory')->andReturn(100);
        Redis::shouldReceive('decr')->with('coca')->andReturn(100);

        // Call the method
        $coinInventory = PurchaseService::purchaseProduct('coca');

        // Assert the result
        $this->assertEquals([
            'message' => 'The purchase was made successfully.',
            'product' => 'coca',
            'success' => true,
            'coin_inventory' => Redis::get('coin_inventory')
        ], $coinInventory);
    }
}
