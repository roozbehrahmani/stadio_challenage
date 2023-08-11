<?php

namespace App\Jobs;

use App\Constants\VendingMachineStateConstants;
use App\Facades\PurchaseFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class InsertCoinJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        $allInventoryCount = PurchaseFacade::inventory()['all_inventory_count'];
        if ($allInventoryCount <= Redis::get('coin_inventory')) {
            return [
                'success' => false,
                'message' => 'The total inventory of products is less than the number of your coins'
            ];
        }
        Redis::incr('coin_inventory');
        Redis::set('state', VendingMachineStateConstants::PRODUCT_SELECTION);
        return [
            'success' => true,
            'message' => 'Your coins balance increased',
            'coin_inventory' => Redis::get('coin_inventory')
        ];
    }
}
