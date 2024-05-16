<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $genders = [
                "unknown",
                "male",
                "female",
                "transgender man",
                "transgender woman",
                "non-binary",
                "genderqueer",
                "genderfluid",
                "agender",
                "bigender",
                "demiboy",
                "demigirl",
                "two-spirit",
                "intersex",
                "neutrois",
                "androgynous",
                "pangender",
                "trigender",
                "gender nonconforming",
                "maverique",
                "polygender",
                "third gender",
                "aliagender"
            ];

            $table->boolean('is_admin')->default(false);
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('gender',$genders)->default('unknown');
            $table->date('dob')->nullable();
            $table->integer('points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
        });
    }
};
