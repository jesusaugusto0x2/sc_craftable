<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('camps_payments')) {
            Schema::create('camps_payments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('reference')->nullable();
                $table->string('photo')->nullable();
                $table->timestamp('date')->nullable();
                $table->boolean('validated')->nullable()->default(null);

                $table->unsignedBigInteger('method_id');
                $table->foreign('method_id')->references('id')->on('methods')->onDelete('cascade');

                $table->unsignedBigInteger('camp_id');
                $table->foreign('camp_id')->references('id')->on('camps')->onDelete('cascade');

                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                $table->unsignedBigInteger('bank_id');
                $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camps_payments');
    }
}
