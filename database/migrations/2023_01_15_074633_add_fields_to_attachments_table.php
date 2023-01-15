<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('name',255)->nullable()->default(null);
            $table->string('entity_type',255)->nullable()->default(null);
            $table->bigInteger('entity_id')->nullable()->default(null);
            $table->bigInteger('fileId')->nullable()->default(null);
            $table->string('type',255)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('entityType');
            $table->dropColumn('entityId');
            $table->dropColumn('fileId');
            $table->dropColumn('type');
        });
    }
}
