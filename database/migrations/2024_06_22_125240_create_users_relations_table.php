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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('follower');
            // $table->bigInteger('user');
            // $table->foreign('follower')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Schema::create('following', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('followed');
        //     $table->bigInteger('user');
        //     $table->foreign('followed')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_relations');
    }
};
