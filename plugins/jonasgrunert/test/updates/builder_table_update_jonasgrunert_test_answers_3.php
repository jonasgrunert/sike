<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestAnswers3 extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_answers', function($table)
        {
            $table->integer('question_id')->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_answers', function($table)
        {
            $table->string('question_id', 255)->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
