<?php

use Illuminate\Database\Seeder;

class rubrosEITableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = App\Rubroingreso::create(['nombre' => 'diezmo']);
        $rol2 = App\Detalleingreso::create(['nombre' => 'diezmo bruto']);
        $rol1 = App\Rubroegreso::create(['nombre' => 'diezmo']);
        $rol2 = App\Detallegreso::create(['nombre' => 'diezmo neto']);
      
    }
}
