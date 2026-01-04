@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 min-h-screen">
    
    <div class="bg-teal-900 text-white text-center py-4 text-2xl font-bold rounded-t-lg">
        Booking Confirmation
    </div>

    <div class="bg-white p-8 rounded-b-lg shadow-md">
        <h2 class="text-2xl font-bold text-teal-900 mb-2">
            RECEIPT #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}
        </h2>
        <p class="text-gray-600 mb-4 font-bold">Booking Details</p>

        <div class="grid grid-cols-3 text-center text-white mb-6">
            <div class="bg-teal-600 p-3 border-r border-white font-bold">Venue</div>
            <div class="bg-teal-600 p-3 border-r border-white font-bold">Date/Time</div>
            <div class="bg-teal-600 p-3 font-bold">Status</div>

            <div class="bg-teal-500 p-4 border-r border-white border-t">
                {{ $booking->court->name }}
            </div>
            <div class="bg-teal-500 p-4 border-r border-white border-t">
                {{ \Carbon\Carbon::parse($booking->date)->format('d F Y') }} <br> 
                @ {{ \Carbon\Carbon::parse($booking->start_time)->format('h A') }}
            </div>
            <div class="bg-teal-500 p-4 border-t">
                {{ $booking->status }}
            </div>
        </div>

        <p class="text-gray-600 mb-4 font-bold">Payment Details</p>

        <div class="grid grid-cols-2 text-center text-white mb-8">
            <div class="bg-teal-600 p-3 border-r border-white font-bold">Description</div>
            <div class="bg-teal-600 p-3 font-bold">Amount</div>

            <div class="bg-teal-500 p-4 border-r border-white border-t">
                {{ $booking->court->name }} Rental
            </div>
            <div class="bg-teal-500 p-4 border-t">
                RM {{ number_format($booking->total_amount, 0) }}
            </div>
        </div>

        <div class="flex justify-center">
            <button class="bg-teal-400 hover:bg-teal-500 text-white text-xl font-bold py-3 px-10 rounded shadow-lg">
                PAY NOW
            </button>
        </div>
    </div>
</div>
@endsection
