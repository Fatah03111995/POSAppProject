<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    //get direct to index
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //form action
    protected function getFormActions(): array
    {
        return [
            Action::make('Save')
                ->submit('Save')
                ->label('Create User')
                ->color('primary')
                ->size('lg')
                ->action(function () {
                    $this->save();
                }),
            Action::make('Cancel')
                ->label('Cancel')
                ->color('secondary')
                ->size('lg')
                ->url($this->getResource()::getUrl('index'))
                ->outlined()
        ];
    }
}
