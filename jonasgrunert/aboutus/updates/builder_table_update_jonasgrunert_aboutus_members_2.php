<?php namespace JonasGrunert\Aboutus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJonasgrunertAboutusMembers2 extends Migration
{
    public function up()
    {
        Schema::table('jonasgrunert_aboutus_members', function($table)
        {
            $table->string('photo')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('jonasgrunert_aboutus_members', function($table)
        {
            $table->dropColumn('photo');
        });
    }
}
