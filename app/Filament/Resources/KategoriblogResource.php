<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriblogResource\Pages;
use App\Filament\Resources\KategoriblogResource\RelationManagers;
use App\Models\Kategoriblog;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KategoriblogResource extends Resource
{
    protected static ?string $model = Kategoriblog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('nama kategori')->live(onBlur:true)->afterStateUpdated(function(string $state, Set $set) {
                    $set('slug',Str::slug($state));
                })->columnSpan(2)->rules(['nullable', 'string', 'max:255', 'sometimes', 'required']),
                Hidden::make('slug')->columnSpan(2)->rules(['nullable', 'string', 'max:255', 'sometimes', 'required']),
                Hidden::make('user_id')->dehydrateStateUsing(fn($state)=>Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->rowIndex(),
                TextColumn::make('title')->label('nama kategori'),
                TextColumn::make('slug')->label('slug')
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
            'index' => Pages\ListKategoriblogs::route('/'),
            'create' => Pages\CreateKategoriblog::route('/create'),
            'edit' => Pages\EditKategoriblog::route('/{record}/edit'),
        ];
    }
}
