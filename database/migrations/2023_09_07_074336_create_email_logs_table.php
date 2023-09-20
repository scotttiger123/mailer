<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('email_logs', function (Blueprint $table) {
        $table->id();
        $table->string('recipient_email')->nullable();
        $table->text('message_content')->nullable();
        $table->timestamp('opened_at')->nullable();
        $table->unsignedBigInteger('email_id')->nullable();
        $table->unsignedBigInteger('user_id')->nullable();
        $table->unsignedBigInteger('campaign_id')->nullable(); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
