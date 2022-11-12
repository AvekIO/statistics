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
            $table->id();
            $table->unsignedSmallInteger('flow_id');
            $table->unsignedMediumInteger('block_id');
            $table->unsignedBigInteger('message_id');
            $table->timestamp('created_at');

            $table->index(['flow_id', 'block_id', 'created_at'], 'flow_id_block_id_created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flow_block_statistics');
    }
};
