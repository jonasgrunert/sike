<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestQuestions extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->text('explanation')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->dropColumn('explanation');
        });
    }
}
