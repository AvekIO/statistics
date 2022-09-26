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
            $table->mediumInteger(column: 'sent', unsigned: true)->default(0);
            $table->mediumInteger(column: 'received', unsigned: true)->default(0);
            $table->mediumInteger(column: 'triggered', unsigned: true)->default(0);
            $table->mediumInteger(column: 'subscribed', unsigned: true)->default(0);
            $table->mediumInteger(column: 'unsubscribed', unsigned: true)->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->primary(['bot_token', 'created_at'], 'primary');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bot_statistics');
    }
};
