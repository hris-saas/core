<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->unsignedInteger('sort_order')->nullable()->default(null);
            $table->string('class')->nullable();
            $table->string('name');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
}
