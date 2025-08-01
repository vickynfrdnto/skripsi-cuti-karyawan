<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
        $table->integer('cuti_melahirkan')->default(90);
        $table->integer('cuti_menikah')->default(3);
        $table->integer('cuti_berduka')->default(3);
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['cuti_melahirkan', 'cuti_menikah', 'cuti_berduka']);
        });
    }
};
