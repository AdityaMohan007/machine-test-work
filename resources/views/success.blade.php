<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Payment Success
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-white shadow rounded-lg p-8 text-center">

                <!-- Success Icon -->
                <div class="flex justify-center mb-6">
                    <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>

                <!-- Heading -->
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Payment Successful 🎉</h1>
                <p class="text-gray-600 mb-6">Thank you for your purchase! Your payment has been processed successfully.</p>

                <!-- Transaction Details -->
                <div class="bg-gray-50 rounded-lg p-6 text-left space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">Transaction ID:</span>
                        <span class="text-gray-900">{{ $transactionId }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">Amount Paid:</span>
                        <span class="text-gray-900">@if ($amount) Rs. @endif {{ $amount }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">Customer Name:</span>
                        <span class="text-gray-900">{{ $customer['name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700 font-medium">Customer Email:</span>
                        <span class="text-gray-900">{{ $customer['email'] }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
