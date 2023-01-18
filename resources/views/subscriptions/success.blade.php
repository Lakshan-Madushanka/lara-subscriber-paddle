<x-app-layout>
    <div class="text-center m-12">
        <p class="text-6xl bg-green-400 text-white w-full text-center p-4">
            Subscription success
        </p>
        <div class="m-8 text-xl">
            <p class="">
                <small class="font-bold">Note: </small>
                This might take couple of minutes to finish.
            </p>

            <p>
                If you are not redirecting to product page
                please try refresh page after few minutes.
            </p>

            <div class="flex justify-center m-12">
                <form method="GET" action="{{route('product')}}">
                    <x-jet-button class="bg-blue-600"> Product Page</x-jet-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
