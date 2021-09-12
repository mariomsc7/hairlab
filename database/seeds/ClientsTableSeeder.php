<?php

use Illuminate\Database\Seeder;
use App\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 50; $i++) {
            $new_client = new Client();

            $new_client->name = 'Cliente-Name' . ($i + 1);
            $new_client->last_name = 'Cliente-Lastname' . ($i + 1);
            $new_client->phone_number = (int) 333 . rand(1111111, 9999999);
            $new_client->email = 'cliente' . ($i + 1) . '@gmail.com';

            $new_client->save();
        }
    }
}
