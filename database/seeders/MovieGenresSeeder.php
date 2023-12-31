<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie\MovieGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieGenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_in_ar = Http::tmdb("genre/movie/list")['genres'];
        $data_in_en = Http::tmdb("genre/movie/list", ["language" => "en"])['genres'];
        $data_in_en = collect($data_in_en);
        collect($data_in_ar)->each(function ($el) use ($data_in_en) {
            $data['ar'] = $el['name'];
            $name_en = $data_in_en->where('id', $el['id'])->first()['name'];
            if (!is_null($name_en)) {
                $data['en'] = $name_en;
            }
            Genre::firstOrCreate(['id' => $el['id']], [
                "id" => $el["id"],
                "name" => $data,
                "type" => "movie",
            ]);
        });
    }
}
