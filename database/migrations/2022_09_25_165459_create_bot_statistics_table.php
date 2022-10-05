<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bot_statistics', function (Blueprint $table): void {
            $table->string('bot_token', 50);
            $table->unsignedMediumInteger('sent')->default(0);
            $table->unsignedMediumInteger('received')->default(0);
            $table->unsignedMediumInteger('triggered')->default(0);
            $table->unsignedMediumInteger('subscribed')->default(0);
            $table->unsignedMediumInteger('unsubscribed')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['bot_token', 'created_at'], 'primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bot_statistics');
    }
};
