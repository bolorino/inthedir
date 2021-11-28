<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('type_id')->default(1)->constrained('organization_types');
            $table->string('name', 140)->unique();
            $table->string('slug', 155)->unique();
            $table->string('address', 200);
            $table->string('address_2', 200)->nullable();
            $table->string('city', 90);
            $table->string('postal_code', 5);
            $table->string('phone', 15)->nullable();
            $table->string('website', 125)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('image', 155)->nullable();
            $table->string('logo', 155)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
