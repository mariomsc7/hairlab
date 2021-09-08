<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++) {
            $new_client = new Client();

            $new_client->name = 'Cliente' . ($i + 1);
            $new_client->last_name = 'Cliente' . ($i + 1);
            $new_client->phone_number = 3334445556;
            $new_client->email = 'cliente' . ($i + 1) . '@gmail.com';

            $new_client->save();
        }
    }
}
