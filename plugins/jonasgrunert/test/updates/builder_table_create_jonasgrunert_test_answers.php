<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJonasgrunertTestAnswers extends Migration
{
    public function up()
    {
        Schema::create('jonasgrunert_test_answers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('answer');
            $table->boolean('result');
            $table->text('comment')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jonasgrunert_test_answers');
    }
}
