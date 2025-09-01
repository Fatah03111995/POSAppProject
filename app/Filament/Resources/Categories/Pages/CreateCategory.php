<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    //get direct to index
    protected function  getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
