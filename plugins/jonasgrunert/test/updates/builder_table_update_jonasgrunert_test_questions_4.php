<?php namespace JonasGrunert\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertTestQuestions4 extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->integer('test_id')->nullable();
            $table->dropColumn('test');
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_test_questions', function($table)
        {
            $table->dropColumn('test_id');
            $table->string('test')->nullable();
        });
    }
}
