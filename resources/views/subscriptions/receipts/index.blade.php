<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Receipts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Order id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Paid id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Download
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receipts as $receipt)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$receipt->order_id}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$receipt->amount()}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$receipt->paid_at->toFormattedDateString()}}
                                </td>
                                <td class="px-6 py-4">
                                    <a class="text-blue-600" href="{{ $receipt->receipt_url }}" target="_blank"
                                       download="{{$receipt->order_id . '.pdf'}}">Download</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-2">
                    {{$receipts->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
