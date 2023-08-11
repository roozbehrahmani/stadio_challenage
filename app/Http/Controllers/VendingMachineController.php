<?php

namespace App\Http\Controllers;

use App\Jobs\InsertCoinJob;


class VendingMachineController extends Controller
{
    public function store()
    {
        $response = dispatch_now(new InsertCoinJob());
        return response($response, $response['success'] ? 200 : 400);
    }
}
