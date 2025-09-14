<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            Checkout page
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100">
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Left Section: Product + Customer Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Order Summary -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>

                    <div class="flex items-center justify-between border-b pb-3">
                        <div>
                            <p class="text-gray-800 font-medium">{{ $product['name'] }}</p>
                            <p class="text-sm text-gray-500">Quantity: 1</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">Rs. {{ $product['price'] }}</p>
                    </div>

                    <div class="flex justify-between mt-4 font-medium text-gray-800">
                        <span>Total</span>
                        <span>Rs. {{ $product['price'] }}</span>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>

                    <!-- Payment validation error shown here -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong>Whoops!</strong> Something went wrong.
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('checkout') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $product['price'] }}">

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name', $user['name']) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email', $user['email']) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="w-full md:w-auto px-8 py-3 bg-yellow-500 text-gray-900 font-semibold rounded-lg shadow hover:bg-yellow-600 transition">
                                Pay Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Section: Price Card -->
            <div>
                <div class="bg-white shadow rounded-lg p-6 sticky top-20">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Price Details</h3>
                    <div class="flex justify-between text-gray-700 mb-2">
                        <span>Product Price</span>
                        <span>Rs. {{ $product['price'] }}</span>
                    </div>
                    <div class="flex justify-between text-gray-900 font-semibold text-lg border-t pt-3">
                        <span>Total Amount</span>
                        <span>Rs. {{ $product['price'] }}</span>
                    </div>
                    <div class="mt-5">
                        <form method="POST" action="{{ route('checkout') }}">
                            @csrf
                            <input type="hidden" name="customer_name" value="{{ $user['name'] }}">
                            <input type="hidden" name="customer_email" value="{{ $user['email'] }}">
                            <input type="hidden" name="amount" value="{{ $product['price'] }}">
                            <button type="submit"
                                class="w-full px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
                                Proceed to Pay
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
