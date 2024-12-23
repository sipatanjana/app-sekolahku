<?php

namespace App\Filament\Resources\UserCoursesResource\Pages;

use App\Filament\Resources\UserCoursesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserCourses extends ListRecords
{
    protected static string $resource = UserCoursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
