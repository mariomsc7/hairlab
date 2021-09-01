<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'Taglio',
                'price' => 18
            ],
            [
                'name' => 'Taglio + Asciugatura Bimba',
                'price' => 20
            ],
            [
                'name' => 'Shampoo + Piega Lunga',
                'price' => 18
            ],
            [
                'name' => 'Shampoo + Piega Corta',
                'price' => 15
            ],
            [
                'name' => 'Colore Radici',
                'price' => 25
            ],            [
                'name' => 'Riflessante',
                'price' => 15
            ],
            [
                'name' => 'Effetti Luce',
                'price' => 25
            ],
            [
                'name' => 'Degrade',
                'price' => 80
            ],
            [
                'name' => 'Meches',
                'price' => 50
            ],
            [
                'name' => 'Trattamento Anticrespo Lisciante',
                'price' => 100
            ],
            [
                'name' => 'Permanente',
                'price' => 45
            ],
            [
                'name' => 'Trattamento Ristrutturante',
                'price' => 10 
            ],
            [
                'name' => 'Servizio Acconciatura',
                'price' => 30
            ],
            [
                'name' => 'Servizio Trucco',
                'price' => 40
            ],

        ];

        foreach ($services as $service) {
            $new_service = new Service();

            $new_service->name = $service['name'];
            $new_service->price = $service['price'];

            $new_service->save();
        };
    }
}
