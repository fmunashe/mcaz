<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['id' => Str::uuid(), 'name' => 'English'],
            ['id' => Str::uuid(), 'name' => 'Ndebele'],
            ['id' => Str::uuid(), 'name' => 'Shona']
        ];

        foreach ($languages as $language) {
            Language::query()->firstOrCreate($language);
        }
    }
}
