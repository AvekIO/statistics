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
            $table->unsignedSmallInteger('flow_id');
            $table->unsignedBigInteger('telegram_user_id');
            $table->unsignedSmallInteger('sent')->default(0);
            $table->unsignedSmallInteger('received')->default(0);
            $table->unsignedMediumInteger('space_used')->default(0);
            $table->timestamp('subscribed_at');

            $table->primary(['flow_id', 'telegram_user_id'], 'primary');
            $table->index(['flow_id', 'sent'], 'flow_id_sent');
            $table->index(['flow_id', 'received'], 'flow_id_received');
            $table->index(['flow_id', 'space_used'], 'flow_id_space_used');
            $table->index(['flow_id', 'subscribed_at'], 'flow_id_subscribed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_telegram_users_statistics');
    }
};
