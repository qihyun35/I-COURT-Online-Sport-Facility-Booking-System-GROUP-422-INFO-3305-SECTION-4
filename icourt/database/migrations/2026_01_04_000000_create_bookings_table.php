<?php
/* run in terminal : php artisan make:migration create_bookings_table */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('court_id')->constrained()->onDelete('cascade'); 
            
            // Fields from your "Booking Page" Screenshot
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->date('date');           // Date input
            $table->time('start_time');     // Time input
            $table->time('end_time');       // Calculated (Start + 1 hour)
            $table->string('payment_method'); // Dropdown input

            // Fields from your "Receipt" Screenshot
            $table->decimal('total_amount', 8, 2); // e.g., RM 150
            $table->string('status')->default('Pending'); // "Pending" status
            
            $table->timestamps(); // Keep this one at the bottom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
