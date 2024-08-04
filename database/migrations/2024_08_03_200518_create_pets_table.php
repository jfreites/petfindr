<?php

use App\Models\User;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->enum('species', ['cat', 'dog', 'other']);
            $table->string('breed')->nullable();
            $table->string('status')->default('missing');
            $table->string('last_location');
            $table->boolean('is_protected')->default(0);
            $table->foreignIdFor(User::class, 'reported_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
