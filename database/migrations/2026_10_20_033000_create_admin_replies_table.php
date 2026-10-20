<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_replies', function (Blueprint $table) {
            $table->id();
            $table->morphs('replyable');
            $table->string('recipient');
            $table->string('subject');
            $table->text('body');
            $table->timestamp('sent_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_replies');
    }
};
