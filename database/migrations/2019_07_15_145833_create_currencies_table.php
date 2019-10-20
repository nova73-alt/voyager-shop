<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            Schema::create('currencies', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('name');
                $table->string('code', 3);
                $table->string('sign', 1);

                // create project_id
                $table->bigInteger('project_id')
                    ->unsigned()
                    ->nullable();
                // make project_id column a foreign key
                $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onDelete('cascade');

                // create country_id
                $table->bigInteger('country_id')
                    ->unsigned()
                    ->nullable();
                // make country_id column a foreign key
                $table->foreign('country_id')
                    ->references('id')
                    ->on('countries')
                    ->onDelete('cascade');

                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
            Schema::dropIfExists('currencies');
        });
    }
}
