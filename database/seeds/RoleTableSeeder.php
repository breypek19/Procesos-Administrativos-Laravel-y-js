<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = App\Role::create(['nombre' => 'admin']);
        $rol2 = App\Role::create(['nombre' => 'secre']);
        $rol3 = App\Role::create(['nombre' => 'tesor']);
    }
}
