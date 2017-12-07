<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeOndeleteToEffectiveAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('effective_areas', function (Blueprint $table) {
            $table->dropForeign('effective_areas_student_id_foreign');
            $table->dropForeign('effective_areas_term_id_foreign');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('effective_areas', function (Blueprint $table) {
            //
        });
    }
}
