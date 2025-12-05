<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('fuel_entries', function (Blueprint $table) {
        // Make sure these columns are unsignedBigInteger and nullable
        $table->unsignedBigInteger('department_id')->nullable()->after('driver_id');
        $table->unsignedBigInteger('gas_station_id')->nullable()->after('department_id');

        // Add foreign keys
        $table->foreign('department_id')
              ->references('id')
              ->on('departments')
              ->onDelete('set null');

        $table->foreign('gas_station_id')
              ->references('id')
              ->on('gas_stations') // <-- make sure your table name is plural 'gas_stations'
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('fuel_entries', function (Blueprint $table) {
        $table->dropForeign(['department_id']);
        $table->dropForeign(['gas_station_id']);

        $table->dropColumn(['department_id', 'gas_station_id']);
    });
}

};
