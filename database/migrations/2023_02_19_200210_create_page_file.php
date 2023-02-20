<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

final class CreatePageFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('page_has_files', function (Blueprint $table) {
            $table->id();
            $table->integer('page_id');
            $table->integer('file_id');

            $table->foreign('file_id')
                ->references('id')
                ->cascadeOnDelete()
                ->on('files')
            ;

            $table->foreign('page_id')
                ->references('id')
                ->cascadeOnDelete()
                ->on('page_files')
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
        Schema::dropIfExists('page_file');
    }
}
