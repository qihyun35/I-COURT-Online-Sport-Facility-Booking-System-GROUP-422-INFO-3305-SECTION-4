@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 min-h-screen">
    
    <div class="bg-teal-800 text-white text-center py-4 text-2xl font-bold rounded-t-lg">
        Booking Page
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-md">
        <h2 class="text-xl font-bold text-teal-900 mb-6 flex items-center">
            <span class="text-lime-400 text-3xl mr-2">●</span> 
            {{ $court->name }}
        </h2>

        <form action="{{ route('bookings.store', $court->id) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" 
                       class="w-full p-3 bg-teal-600 text-white rounded focus:outline-none placeholder-gray-200" placeholder="Your Name">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" 
                           class="w-full p-3 bg-teal-600 text-white rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                    <input type="text" name="phone_number" 
                           class="w-full p-3 bg-teal-600 text-white rounded">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Date</label>
                    <input type="date" name="date" 
                           class="w-full p-3 bg-teal-600 text-white rounded cursor-pointer">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Time</label>
                    <input type="time" name="time" 
                           class="w-full p-3 bg-teal-600 text-white rounded cursor-pointer">
                </div>
            </div>

            <div class="mb-8 w-1/2">
                <label class="block text-gray-700 font-bold mb-2">Payment Method</label>
                <select name="payment_method" class="w-full p-3 bg-teal-600 text-white rounded">
                    <option value="Online Banking">Online Banking</option>
                    <option value="Credit Card">Credit Card</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-teal-400 hover:bg-teal-500 text-white font-bold py-3 px-8 rounded shadow-lg">
                    BOOK NOW
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
