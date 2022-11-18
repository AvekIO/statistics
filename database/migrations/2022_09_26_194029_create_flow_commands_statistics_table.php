<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flow_commands_statistics', function (Blueprint $table): void {
            $table->id();
            $table->unsignedSmallInteger('flow_id');
            $table->unsignedMediumInteger('command_id');
            $table->unsignedBigInteger('bot_chat_telegram_user_id');
            $table->timestamp('triggered_at');

            $table->index(['flow_id', 'command_id', 'triggered_at'], 'flow_id_command_id_triggered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_commands_statistics');
    }
};
