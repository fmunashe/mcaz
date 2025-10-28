<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['id' => 1, 'name' => 'English'],
            ['id' => 2, 'name' => 'Ndebele'],
            ['id' => 3, 'name' => 'Shona']
        ];

        foreach ($languages as $language) {
            Language::query()->firstOrCreate($language);
        }
    }
}
