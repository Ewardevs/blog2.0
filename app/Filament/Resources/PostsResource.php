<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostsResource\Pages;
use App\Filament\Resources\PostsResource\RelationManagers;
use App\Filament\Resources\PostsResource\RelationManagers\ImagesRelationManager;
use App\Models\Posts;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery():Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("title")
                    ->live(debounce: 500)
                    ->required(),
                    TextInput::make("extract")
                    ->required(),
                RichEditor::make('body')
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',

                        'underline',
                        'undo',
                    ])
                    ->required(),
                Select::make("category_id")
                    ->relationship("category", "name")
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make("slug")
                    ->unique(ignoreRecord: true)
                    ->required(),
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->default(Auth::id())
                    ->disabled()
                    ->dehydrated()
                    ->preload(),

                // Componente para subir imagen
                FileUpload::make('image')
                    ->image() // Solo se permiten imágenes
                    ->directory('posts') // Carpeta donde se guardarán las imágenes
                    ->required() // Hazlo obligatorio si es necesario
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")
                    ->searchable(),
		ImageColumn::make("image"),
                TextColumn::make("category.name")->limit(50)
                    ->searchable(),

            ])
            ->filters([
                SelectFilter::make("Category")
                ->relationship("category", "name")
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }
}
