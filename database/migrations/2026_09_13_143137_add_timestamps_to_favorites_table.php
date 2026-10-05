<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('favorites', function (Blueprint $table) {
            if (!Schema::hasColumn('favorites', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        //
    }
};