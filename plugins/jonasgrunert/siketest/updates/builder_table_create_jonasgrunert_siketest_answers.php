<?php namespace JonasGrunert\Siketest\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateJonasgrunertSiketestAnswers extends Migration
{
    public function up()
    {
        Schema::create('jonasgrunert_siketest_answers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('answer');
            $table->text('description')->nullable();
            $table->integer('question_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('result');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jonasgrunert_siketest_answers');
    }
}
