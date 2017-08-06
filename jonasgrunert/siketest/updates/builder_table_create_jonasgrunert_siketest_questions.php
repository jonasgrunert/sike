<?php namespace JonasGrunert\Siketest\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJonasgrunertSiketestQuestions extends Migration
{
    public function up()
    {
        Schema::create('jonasgrunert_siketest_questions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('question');
            $table->text('description')->nullable();
            $table->integer('test_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jonasgrunert_siketest_questions');
    }
}
