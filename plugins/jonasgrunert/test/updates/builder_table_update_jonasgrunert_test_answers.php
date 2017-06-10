<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestAnswers extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_answers', function($table)
        {
            $table->string('question')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_answers', function($table)
        {
            $table->dropColumn('question');
        });
    }
}
