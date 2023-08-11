<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class IncreaseProductInventoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:increase {product} {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increase product inventory';

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
        $product = $this->argument('product');
        $count = (int)$this->argument('count');
        $products = explode(',', config('product.products'));
        if (!in_array($product, $products)) {
            $this->line('The selected product is not valid.');
            return 0;
        }
        $out = Redis::incrby($product, $count);
        $this->line("The {{$product}} inventory is {{$out}}.");
        return 1;
    }
}
