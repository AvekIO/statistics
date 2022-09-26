<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flow_telegram_users_statistics', function (Blueprint $table): void {
            $table->smallInteger(column: 'flow_id', unsigned: true);
            $table->bigInteger(column: 'bot_chat_telegram_user_id', unsigned: true);
            $table->smallInteger(column: 'sent', unsigned: true)->default(0);
            $table->smallInteger(column: 'received', unsigned: true)->default(0);
            $table->mediumInteger(column: 'space_used', unsigned: true)->default(0);
            $table->timestamp('subscribed_at');

            $table->primary(['flow_id', 'bot_chat_telegram_user_id'], 'primary');
            $table->index(['flow_id', 'sent'], 'flow_id_sent');
            $table->index(['flow_id', 'space_used'], 'flow_id_space_used');
            $table->index(['flow_id', 'subscribed_at'], 'flow_id_subscribed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_telegram_users_statistics');
    }
};
