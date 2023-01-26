<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center pt-20 py-8 w-full">
                    <ul class="bg-white rounded-lg border border-gray-200 text-gray-900 w-1/2">
                        <li class="text-center font-extrabold text-2xl p-8 border-b border-gray-200 w-full rounded-t-lg bg-blue-600 text-white">
                            {{$plan->product_title}}
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Status</p>
                            <p class="bg-green-400 rounded p-1">{{ucfirst($subscription->paddle_status)}}</p>
                        </li>
                        @if($subscription->paddle_status === \Laravel\Paddle\Subscription::STATUS_TRIALING)
                            <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                                <p>Trial ends at</p>
                                <p>{{ucfirst($subscription->trial_ends_at)}}</p>
                            </li>

                        @endif
                        <li class="px-6 py-4 border-b border-gray-200 w-full text-center font-bold">
                            Plan details
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Price</p>
                            <p>{{ucfirst($plan->price()->gross())}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Interval</p>
                            <p>{{$plan->subscription['interval']}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Frequency</p>
                            <p>{{$plan->subscription['frequency']}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full text-center font-bold">
                            Card details
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Email</p>
                            <p>{{$subscription->paddleEmail()}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Payment method</p>
                            <p>{{$subscription->paymentMethod()}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Card brand</p>
                            <p>{{$subscription->cardBrand()}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Card last four digits</p>
                            <p>{{$subscription->cardLastFour()}}</p>
                        </li>
                        <li class="px-6 py-4 border-b border-gray-200 w-full flex justify-between items-center">
                            <p>Card expiration date</p>
                            <p>{{$subscription->cardExpirationDate()}}</p>
                        </li>
                    </ul>
                </div>
                <div class="flex justify-center w-full mb-8 items-center">
                    <div class="flex justify-between w-1/2 items-center">
                        @if($subscription->paddle_status !== \Laravel\Paddle\Subscription::STATUS_DELETED)
                            <form action="{{route('subscriptions.destroy')}}" method="POST">
                                @csrf
                                @method('delete')
                                <x-jet-button class="bg-blue-600">Unsubscribe</x-jet-button>
                            </form>
                        @endif
                        <x-jet-button class="bg-blue-600">Change plan</x-jet-button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
