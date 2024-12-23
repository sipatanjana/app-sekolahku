<?php

namespace App\Filament\Resources\UserCoursesResource\Pages;

use App\Filament\Resources\UserCoursesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserCourses extends EditRecord
{
    protected static string $resource = UserCoursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
