<?php

use App\Models\Post;
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
        Schema::create('reacts', function (Blueprint $table) {
            $table->id();
            $table->integer('reactable_id')->unsigned();
            $table->string('reactable_type'); 
            $table->enum('react' , ['love','lough' , 'sad' , 'anger' , 'wow']);
           
            // $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reacts');
    }
};
