<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsExtraToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('count_reviews')->default(0);
            $table->unsignedDecimal('avg_rating_star', $precision = 5, $scale = 1)->default(0.0);
            $table->unsignedDecimal('sub_price', $precision = 5, $scale = 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'count_reviews',
                'avg_rating_star',
                'sub_price',
            ]);
        });
    }
}
