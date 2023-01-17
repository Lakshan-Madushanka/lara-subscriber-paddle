<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use Laravel\Paddle\Cashier;

class IndexController extends Controller
{
    public function __invoke()
    {
        $plans = Cashier::productPrices(SubscriptionService::PLANS_IDS);

        return view('plans.index', ['plans' => $plans]);

    }
}
