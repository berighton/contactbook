<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table( 'contacts', function ( Blueprint $table ) {
		    $table->string( 'ac_id' )->nullable();
	    } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table( 'contacts', function ( Blueprint $table ) {
		    $table->dropColumn( [ 'ac_id' ] );
	    } );
    }
}
