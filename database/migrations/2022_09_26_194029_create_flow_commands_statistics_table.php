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
            $table->unsignedSmallInteger('flow_id');
            $table->unsignedMediumInteger('command_id');
            $table->unsignedBigInteger('telegram_user_id');
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['flow_id', 'command_id', 'created_at', 'telegram_user_id'], 'primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_commands_statistics');
    }
};
