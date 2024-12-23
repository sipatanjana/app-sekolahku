<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserCoursesResource\Pages;
use App\Filament\Resources\UserCoursesResource\RelationManagers;
use App\Models\Courses;
use App\Models\User;
use App\Models\UserCourses;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserCoursesResource extends Resource
{
    protected static ?string $model = UserCourses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_user')
                    ->label('User')
                    ->required()
                    ->searchable()
                    ->options(User::all()->pluck('name', 'id')),
                Forms\Components\Select::make('id_course')
                    ->required()
                    ->label('Course')
                    ->searchable()
                    ->options(Courses::all()->pluck('course', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('User.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Courses.course')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserCourses::route('/'),
            'create' => Pages\CreateUserCourses::route('/create'),
            'edit' => Pages\EditUserCourses::route('/{record}/edit'),
        ];
    }
}
