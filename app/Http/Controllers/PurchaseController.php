<?php

namespace App\Http\Controllers;

use App\Constants\VendingMachineStateConstants;
use App\Facades\PurchaseFacade;
use App\Http\Requests\PurchaseStoreRequest;
use App\Jobs\PurchaseProductJob;
use Illuminate\Support\Facades\Redis;


class PurchaseController extends Controller
{
    public function index()
    {
        switch (Redis::get('state')) {
            case VendingMachineStateConstants::IDLE:
                return response(
                    [
                        'message' => VendingMachineStateConstants::IDLE,
                    ], 200
                );
            case VendingMachineStateConstants::PRODUCT_SELECTION:
                return response(
                    [
                        'message' => VendingMachineStateConstants::PRODUCT_SELECTION,
                        'inventory' => PurchaseFacade::inventory(),
                    ], 200
                );
            default:
                return response('please setup', 200);
        }
    }

    public function store(PurchaseStoreRequest $request)
    {
        $response = dispatch_now(new PurchaseProductJob($request->product));
        return response($response, $response['success'] ? 200 : 400);
    }
}
