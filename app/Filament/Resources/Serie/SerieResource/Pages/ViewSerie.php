<?php

namespace App\Filament\Resources\Serie\SerieResource\Pages;

use App\Filament\Resources\Serie\SerieResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Http;

class ViewSerie extends ViewRecord
{
    protected static string $resource = SerieResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('Load New Seasons')->action('loadNewSeasons'),
        ];
    }

    public function loadNewSeasons()
    {
        $serie_id = $this->record->id;
        $data = Http::tmdb("/tv/$serie_id")['seasons'];
        $data = collect($data);
        $ids = $data->pluck('id');
        $existed_ids = $this->record->seasons()->whereIn('id', $ids)->get(['id'])->pluck(['id']);
        $data = $data->whereNotIn('id', $existed_ids);
        $seasons = $data->where("season_number", "!=", 0)->map(function ($season) {
            return [
                'id' => $season['id'],
                'name' => $season['name'],
                'overview' => $season['overview'],
                'poster_path' => str_replace("/", "", $season['poster_path']),
                'number' => $season['season_number'],
                'air_date' => $season['air_date'],
            ];
        });
        if ($seasons->isNotEmpty()) {
            $this->record->seasons()->createMany($seasons);
            Notification::make("Seasons loaded successfully")
                ->title(count($seasons) . " Seasons loaded successfully")
                ->success()
                ->send();
        } else {
            Notification::make("No new seasons found")
                ->title("No new seasons found")
                ->warning()
                ->send();
        }
    }
}
