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
        DB::table('tiposdeusers')->insert( ['descricao' => 'aluno'] );
        DB::table('tiposdeusers')->insert( ['descricao' => 'administrador'] );

        DB::table('campuses')->insert( ['nome' => 'Natal-Central'] );

        DB::table('eixos')->insert( ['nome' => 'Individual'] );
        DB::table('eixos')->insert( ['nome' => 'Familiar'] );
        DB::table('eixos')->insert( ['nome' => 'Intraescolar'] );
        DB::table('eixos')->insert( ['nome' => 'Carreira Profissional'] );
        DB::table('eixos')->insert( ['nome' => 'Área de Formação'] );
        DB::table('eixos')->insert( ['nome' => 'Institucional'] );

        DB::table('questionarios')->insert( ['titulo' => 'Individual', 'disponivel' => 1, 'eixo_id' => 1] );
        DB::table('questionarios')->insert( ['titulo' => 'Familiar', 'disponivel' => 1, 'eixo_id' => 2] );
        DB::table('questionarios')->insert( ['titulo' => 'Intraescolar', 'disponivel' => 1, 'eixo_id' => 3] );
        DB::table('questionarios')->insert( ['titulo' => 'Carreira Profissional', 'disponivel' => 1, 'eixo_id' => 4] );
        DB::table('questionarios')->insert( ['titulo' => 'Área de Formação', 'disponivel' => 1, 'eixo_id' => 5] );
        DB::table('questionarios')->insert( ['titulo' => 'Institucional', 'disponivel' => 1, 'eixo_id' => 6] );

        DB::table('users')->insert([
            'name' => 'David Allysson Pereira Moreira',
            'email' => 'davidmoreirainformatica@gmail.com',
            'password' => bcrypt('123'),
            'tipo_id' => 2
        ]);

    }
}
