<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestQuestions5 extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->integer('test_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->dropColumn('test_id');
        });
    }
}
