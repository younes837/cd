<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'libelle' => 'Admin',
            'description' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'libelle' => 'User',
            'description' => 'User',
        ]);
        DB::table('etat')->insert([
            'libelle' => 'Pending',
            'description' => 'ee',
        ]);
        DB::table('etat')->insert([
            'libelle' => 'Confirmed',
            'description' => 'ee',
        ]);
        DB::table('etat')->insert([
            'libelle' => 'Rejected',
            'description' => 'ee',
        ]);


        DB::table('categorie')->insert([
            'name' => 'Appliances',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Audio',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Cameras & Camcorders',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Car Electronics & GPS',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Video Games',
        ]);
        DB::table('categorie')->insert([
            'name' => 'TV & Home Theater',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Video Games',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Cell Phones',
        ]);
        DB::table('categorie')->insert([
            'name' => 'Computers & Tablets',
        ]);
        // \App\Models\Brand::factory(10)->create();

        $cities = [
            'Agadir',
            'Al Hoceima',
            'Azrou',
            'Beni Mellal',
            'Boujdour',
            'Casablanca',
            'Chefchaouen',
            'Dakhla',
            'El Jadida',
            'Errachidia',
            'Essaouira',
            'Fes',
            'Guelmim',
            'Ifrane',
            'Kenitra',
            'Khemisset',
            'Khenifra',
            'Khouribga',
            'Laayoune',
            'Larache',
            'Marrakech',
            'Martil',
            'Meknes',
            'Mohammedia',
            'Nador',
            'Ouarzazate',
            'Oujda',
            'Rabat',
            'Safi',
            'Sale',
            'Sefrou',
            'Settat',
            'Sidi Ifni',
            'Tangier',
            'Tan-Tan',
            'Taroudant',
            'Taza',
            'Tetouan',
            'Tiznit',
         
        ];
        

        foreach ($cities as $cityName) {
            \App\Models\Ville::create([
                'name' => $cityName,
            ]);
        }


        \App\Models\Ville::factory(30)->create();
        \App\Models\Propriete::factory(3)->create();
        // \App\Models\Produit::factory(40)->create();
        // \App\Models\User::factory(40)->create();
        // \App\Models\Commande::factory(40)->create();
        // \App\Models\ligneCommande::factory(100)->create();
    }
}
