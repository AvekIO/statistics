<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flow_block_statistics', function (Blueprint $table): void {
            $table->smallInteger(column: 'flow_id', unsigned: true);
            $table->mediumInteger(column: 'block_id', unsigned: true);
            $table->bigInteger(column: 'bot_chat_telegram_user_id', unsigned: true);
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['flow_id', 'block_id', 'created_at', 'bot_chat_telegram_user_id'], 'primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_block_statistics');
    }
};
