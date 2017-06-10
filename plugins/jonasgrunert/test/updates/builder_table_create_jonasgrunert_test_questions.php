<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJonasgrunertTestQuestions extends Migration
{
    public function up()
    {
        Schema::create('jonasgrunert_test_questions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('question');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jonasgrunert_test_questions');
    }
}
