<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Deals
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($deals->isEmpty())
                        <p class="text-gray-500">No deals yet.</p>
                    @else
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 pr-4">Title</th>
                                    <th class="py-2 pr-4">Amount</th>
                                    <th class="py-2 pr-4">Status</th>
                                    <th class="py-2 pr-4">Date</th>
                                    <th class="py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deals as $deal)
                                <tr class="border-b">
                                    <td class="py-2 pr-4">{{ $deal->title }}</td>
                                    <td class="py-2 pr-4">{{ $deal->amount }}</td>
                                    <td class="py-2 pr-4">{{ $deal->status }}</td>
                                    <td class="py-2 pr-4">{{ $deal->created_at->format('d M Y') }}</td>
                                    <td class="py-2">
                                        <a href="{{ route('deals.show', $deal->id) }}" class="text-blue-500 hover:underline">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
