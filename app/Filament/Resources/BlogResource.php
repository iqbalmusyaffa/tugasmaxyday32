<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\Kategoriblog;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            //
            Section::make()->schema([
                TextInput::make('post_title')->label('judul')->rules(['nullable', 'string', 'max:255', 'sometimes', 'required'])->live(onBlur:true)->afterStateUpdated(function(string $state, Set $set) { $set('post_slug',Str::slug($state)); } ),
                Hidden::make('post_slug')->label('slug')->rules(['nullable', 'string', 'max:255', 'sometimes', 'required']),
                RichEditor::make('content')->rules(['nullable', 'string', 'sometimes', 'required']),
            ])->columnSpan(2),
            Section::make()->schema([
                SpatieMediaLibraryFileUpload::make('image')->image()->imageEditor()->optimize('webp'),
                Select::make('kategoris_id')->label('kategori')->options(Kategoriblog::all()->pluck('title','id'))->rules(['nullable', 'exists:kategoriblogs,id', 'sometimes', 'required']),
                Checkbox::make('is_published'),
            ])->columnSpan(1),
            Hidden::make('user_id')->dehydrateStateUsing(fn($state)=>Auth::id()),
        ])->columns(3);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->rowIndex(),
                TextColumn::make('post_title')->label('judul'),
                TextColumn::make('post_slug')->label('slug'),
                TextColumn::make('categories.title')->label('kategori'),
                CheckboxColumn::make('is_published')->label('public')
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
