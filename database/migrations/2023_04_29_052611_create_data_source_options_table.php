<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSourceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_source_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_source_type_id')->index()->constrained()->cascadeOnDelete();
            $table->string('option_type');
            $table->string('option_name');
            $table->string('option_value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_source_options');
    }
}
