<?php

namespace App\Filament\Resources\CategoryPostResource\Pages;

use App\Filament\Resources\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategoryPosts extends ManageRecords
{
    protected static string $resource = CategoryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
