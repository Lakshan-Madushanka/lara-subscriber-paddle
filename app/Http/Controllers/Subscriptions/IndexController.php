<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Laravel\Paddle\Cashier;

class IndexController extends Controller
{
    public function __invoke(Request $request): Factory|View|Application
    {
        $subscription = $request->user()->subscription();
        $subscription->load('billable');

        $plan = Cashier::productPrices($subscription->paddle_plan);

        return view('subscriptions.index', [
            'subscription' => $subscription,
            'plan' => $plan[0],
        ]);
    }
}
