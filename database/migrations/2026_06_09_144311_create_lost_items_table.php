<?php

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
    Schema::create('lost_items', function (Blueprint $table) {
        $table->id();

        $table->string('item_name');
        $table->text('description');
        $table->string('location');
        $table->string('contact_number');
        $table->string('status')->default('Lost'); 
        $table->date('date');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
