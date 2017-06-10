<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestQuestions3 extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->string('test')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->dropColumn('test');
        });
    }
}
