<?php

namespace Statikbe\FilamentTranslationManager\Http\Livewire;

use Filament\Notifications\Notification;
use Livewire\Component;
use Statikbe\LaravelChainedTranslator\ChainedTranslationManager;

class TranslationEditForm extends Component
{
    public string $group;

    public string $translationKey; //"key" is reserved for wire:key

    public array $translations;

    public array $initialTranslations;

    public array $locales;

    const EVENT_TRANSLATIONS_SAVED = 'translationsSaved';

    public function mount()
    {
        $this->initialTranslations = $this->translations;
    }

    public function save(string $locale): void
    {
        $chainedTranslationManager = app(ChainedTranslationManager::class);

        if (($this->translations[$locale] ?? null) === ($this->initialTranslations[$locale] ?? null)) {
            return;
        }

        $chainedTranslationManager->save(
            $locale,
            $this->group,
            $this->translationKey,
            $this->translations[$locale]
        );

        $this->emit(self::EVENT_TRANSLATIONS_SAVED, $this->group, $this->translationKey, $this->translations, $this->initialTranslations);

        $this->initialTranslations = $this->translations;

        Notification::make()
            ->success()
            ->title('Translation saved')
            ->send();
    }

    public function cancel(): void
    {
        $this->translations = $this->initialTranslations;
    }

    public function render()
    {
        return view('filament-translation-manager::livewire.translation-edit-form');
    }
}
