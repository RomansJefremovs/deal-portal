<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deal: {{ $deal->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p><strong>HubSpot Deal ID:</strong> {{ $deal->hubspot_deal_id }}</p>
                    <p><strong>Title:</strong> {{ $deal->title }}</p>
                    <p><strong>Amount:</strong> {{ $deal->amount }}</p>
                    <p><strong>Status:</strong> {{ $deal->status }}</p>
                    <p><strong>Date:</strong> {{ $deal->created_at->format('d M Y') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('deals.index') }}" class="text-blue-500 hover:underline">← Back to deals</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
