<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('category')->insert([
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Technology'
            ],
            [
                'name' => 'Food'
            ],
            [
                'name' => 'Games'
            ],
            [
                'name' => 'Clothes'
            ],
            [
                'name' => 'Agliculture'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
