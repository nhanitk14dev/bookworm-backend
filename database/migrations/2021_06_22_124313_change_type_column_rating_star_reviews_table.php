<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnRatingStarReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('reviews', 'rating_star')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('rating_star');
            });
            Schema::table('reviews', function (Blueprint $table) {
                $table->tinyInteger('rating_star')->default(1);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('reviews', 'rating_star')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->dropColumn('rating_star');
            });

            Schema::table('reviews', function (Blueprint $table) {
                $table->enum('rating_star', [1, 2, 3, 4, 5]);
            });
        }
    }
}
