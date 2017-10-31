<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 \DB::table('users')->delete();
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.net',
                'password' => bcrypt('secret'),
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'joe',
                'email' => 'joe@example.com',
                'password' => bcrypt('secret'),
            )
            
        ));

         \DB::table('notes')->delete();
		\DB::table('notes')->insert(array (
			0 =>
            array (
			    'title' => 'Titulo de la nota',
			    'content' => 'Contenido de la nueva nota'
			)
		));

        \DB::table('categorias')->delete();
        \DB::table('categorias')->insert(array (
            0 =>
            array (
                'id' => 1,
                'nombre' => 'Neumática'
                
            ),
            1 =>
            array (
                'id' => 2,
                'nombre' => 'Hidraulica'
            ),
            2 =>
            array (
                'id' => 3,
                'nombre' => 'Otras intervenciones'
            ),
            3 =>
            array (
                'id' => 4,
                'nombre' => 'Sin asignar'
            )
        ));
// Asignación del rol

    }
}
