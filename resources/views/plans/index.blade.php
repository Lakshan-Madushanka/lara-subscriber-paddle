<x-app-layout>
    @push('paddle')
        @paddleJS
    @endpush
    @forelse($plans as $plan)
        <div class="flex space-x-16 justify-center items-center">
            <div class="min-h-screen flex justify-center items-center">
                <div class="flex justify-center w-full">
                    <div class="rounded-lg shadow-2xl bg-white">
                        <p class="text-6xl bg-cyan-500 shadow-lg shadow-cyan-500/50 text-white text-center p-10">
                            {{$plan->product_title}}
                        </p>
                        <div class="p-2">
                            <p class="text-gray-700 text-base mb-4 p-8 text-2xl">
                                Initial: {{ $plan->initialPrice()->gross() }} -
                                Recurring: {{ $plan->recurringPrice()->gross() }}
                            </p>

                            <div class="flex justify-between">
                                <x-paddle-button :url="$payLinks[$plan->product_id]" class="px-8 py-4">
                                    Subscribe
                                </x-paddle-button>
                                @if(str_contains( strtolower($plan->product_title), 'month') && !$hasSubscribed)
                                    <x-paddle-button :url="$payLinks['trial']" class="px-8 py-4">
                                        Activate Trial
                                    </x-paddle-button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty
                <p class="bg-yellow-300 m-8 p-8 text-4xl text-center"> No plans exists </p>
    @endforelse


</x-app-layout>
