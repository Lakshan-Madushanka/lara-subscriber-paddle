<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Laravel\Paddle\Cashier;

class IndexController extends Controller
{
    public function __invoke(Request $request, SubscriptionService $subscriptionService): Factory|View|Application
    {
        $plans = Cashier::productPrices(SubscriptionService::PLANS_IDS);

        $payLinks = $subscriptionService->getPayLinks($request, $plans);

        $hasSubscribed = $request->user()->subscription();

        return view('plans.index', [
            'plans' => $plans,
            'payLinks' => $payLinks,
            'hasSubscribed' => ! is_null($hasSubscribed),
        ]);
    }
}
