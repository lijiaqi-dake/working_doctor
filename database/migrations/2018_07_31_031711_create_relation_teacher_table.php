<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //老师与管理的年纪班级科目对应表
        Schema::create('relation_teacher', function (Blueprint $table) {
            $table->increments('id');
            // 外键约束，级联删除
            $table->Integer('teacher_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('grade');
            $table->string('class');

            $table->Integer('subject_id')->unsigned()->index();
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
        Schema::dropIfExists('relation_teacher');
    }
}
