<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Laravel\Paddle\ProductPrice;

class SubscriptionService
{
    public const PLANS_IDS = [38932, 38933];

    /**
     * @param Request $request
     * @param Collection<int, ProductPrice> $plans
     * @return array<int|string, string>
     */
    public function getPayLinks(Request $request, Collection $plans): array
    {
        $links = [];

        $redirectLink = URL::temporarySignedRoute(
            'subscriptions.success',
            now()->addMinutes(5),
        );

        $plans->each(function (ProductPrice $price) use (&$links, $request, $redirectLink) {
            $payLink = $request->user()->newSubscription('default', $price->product_id)
                ->returnTo($redirectLink)
                ->create();

            if (str_contains(strtolower($price->product_title), 'month')) {
                $links['trial'] = $request->user()->newSubscription('default', $price->product_id)
                    ->trialDays(30)
                    ->returnTo($redirectLink)
                    ->create();
            }

            $links[$price->product_id] = $payLink;
        });

        return $links;
    }
}
