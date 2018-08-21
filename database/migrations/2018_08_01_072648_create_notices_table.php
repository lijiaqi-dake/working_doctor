<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //通知表
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade');
            $table->string('class');
            $table->string('notice_content');
            // 作业通知与其他通知
            $table->string('notice_type');

            $table->string('school')->index()->nullable();
            $table->foreign('school')->references('school')->on('users')->onDelete('cascade');

            $table->Integer('subject_id')->unsigned()->index()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
