<?php

namespace App\Console\Commands;

use App\Constants\VendingMachineStateConstants;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SetupRedisValuesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setup redis default values';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Redis::set('state', VendingMachineStateConstants::IDLE);
        Redis::set('coin_inventory', 0);
        $products = explode(',', config('product.products'));
        foreach ($products as $product) {
            Redis::set($product, 0);
        }
        $this->line('setup redis default values done');

        return 1;
    }
}
