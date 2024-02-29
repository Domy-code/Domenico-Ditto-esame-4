<?php

namespace Database\Seeders;

use App\Models\Password;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sale = hash('sha512', trim(Str::random(200)));
        Password::create([
            'idUtente' => 1,
            'psw' =>  hash('sha512', trim('passwordAdmin')),
            'sale' => $sale
        ]);
        Password::create([
            'idUtente' => 2,
            'psw' => hash('sha512', trim('passwordUser')),
            'sale' => $sale
        ]);
    }
}
