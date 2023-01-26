<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        $subscription = $request->user()->subscription();
        $subscription->load('billable');
        $subscription->cancel();

        $subscription->refresh();
        $endsAt = $subscription->ends_at;

        $request->session()->flash('flash.banner', "Your subscription ends at {$endsAt}");
        $request->session()->flash('flash.bannerStyle', 'success');

        return back();
    }
}
