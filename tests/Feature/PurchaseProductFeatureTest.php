<?php

namespace Tests\Feature;

use App\Facades\PurchaseFacade;
use App\Jobs\PurchaseProductJob;
use Mockery;
use Tests\TestCase;
use App\Constants\VendingMachineStateConstants;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PurchaseProductFeatureTest extends TestCase
{
    use WithoutMiddleware; // This is used to disable middleware during testing

    public function testIndexWhenIdleState()
    {
        Redis::shouldReceive('get')->with('state')->andReturn(VendingMachineStateConstants::IDLE);

        $response = $this->get('/api/purchase');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => VendingMachineStateConstants::IDLE,
        ]);
    }

    public function testIndexWhenProductSelectionState()
    {
        Redis::shouldReceive('get')->with('state')->andReturn(VendingMachineStateConstants::PRODUCT_SELECTION);
        PurchaseFacade::shouldReceive('inventory')->andReturn([
            'all_inventory_count' => 10,
            'inventory' => ['coca' => 5, 'coffee' => 5],
            'coin_inventory' => 50,
        ])->once();

        $response = $this->get('/api/purchase');
        $response->assertStatus(200);
        $response->assertJson([
            'message' => VendingMachineStateConstants::PRODUCT_SELECTION,
            'inventory' => [
                'all_inventory_count' => 10,
                'inventory' => ['coca' => 5, 'coffee' => 5],
                'coin_inventory' => 50,
            ],
        ]);
    }

    public function testStoreSuccess()
    {
        PurchaseFacade::shouldReceive('coinInventory')->andReturn(10);
        PurchaseFacade::shouldReceive('hasInventory')->andReturn(true);
        PurchaseFacade::shouldReceive('purchaseProduct')->andReturn([
            'message' => 'The purchase was made successfully.',
            'product' => 'coca',
            'success' => true,
            'coin_inventory' => 10
        ]);

        $response = $this->post('/api/purchase', ['product' => 'coca']);

        $response->assertStatus(200);
    }

    public function testStoreFailure()
    {
        PurchaseFacade::shouldReceive('coinInventory')->andReturn(10);
        PurchaseFacade::shouldReceive('hasInventory')->andReturn(true);
        PurchaseFacade::shouldReceive('purchaseProduct')->andReturn([
            'message' => 'You dont have enough coins.',
            'product' => 'coca',
            'success' => false,
            'coin_inventory' => 10
        ]);

        $response = $this->post('/api/purchase', ['product' => 'coca']);
        $response->assertStatus(400);
    }

}
