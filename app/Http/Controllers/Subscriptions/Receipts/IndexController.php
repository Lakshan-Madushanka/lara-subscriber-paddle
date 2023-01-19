<?php

namespace App\Http\Controllers\Subscriptions\Receipts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $receipts = $request->user()->receipts()->paginate();

        return view('subscriptions.receipts.index', ['receipts' => $receipts]);
    }
}
