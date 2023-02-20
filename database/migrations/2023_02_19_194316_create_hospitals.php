<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreateHospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_adult')->default(false);
            $table->boolean('has_child')->default(false);
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('url')->nullable();
            $table->integer('region_id');
            $table->boolean('has_rlo')->default(false);
            $table->boolean('has_omc')->default(false);
            $table->boolean('has_vmp')->default(false);
            $table->boolean('has_vzn')->default(false);
            $table->boolean('has_kd')->default(false);
            $table->jsonb('diseases')->nullable();
            $table->timestamps();


            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
}
