<?php

namespace App\Services;

use App\Constants\VendingMachineStateConstants;
use App\Facades\PurchaseFacade;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;


class PurchaseService
{
    public static function inventory(): array
    {
        $allInventoryCount = 0;
        $inventory = new Collection();
        $products = explode(',', config('product.products'));
        foreach ($products as $product) {
            $productInventoryCount = Redis::get($product);
            $allInventoryCount += $productInventoryCount;
            $inventory->put($product, $productInventoryCount);
        }
        return [
            'all_inventory_count' => $allInventoryCount,
            'inventory' => $inventory,
            'coin_inventory' => Redis::get('coin_inventory')
        ];
    }

    public static function hasInventory(string $product): bool
    {
        return Redis::get($product) >= 1;
    }

    public static function coinInventory()
    {
        return Redis::get('coin_inventory');
    }

    public static function purchaseProduct(string $product): array
    {
        if (PurchaseFacade::coinInventory() < 1) {
            return [
                'message' => 'You dont have enough coins.',
                'product' => $product,
                'success' => false
            ];
        }
        if (!PurchaseFacade::hasInventory($product)) {
            return [
                'message' => 'The selected product does not have enough inventory.',
                'product' => $product,
                'success' => false
            ];
        }
        Redis::decr('coin_inventory');
        Redis::decr($product);
        if (PurchaseFacade::coinInventory() < 1) {
            Redis::set('state', VendingMachineStateConstants::IDLE);
        }
        return [
            'message' => 'The purchase was made successfully.',
            'product' => $product,
            'success' => true,
            'coin_inventory' => Redis::get('coin_inventory')
        ];
    }
}
