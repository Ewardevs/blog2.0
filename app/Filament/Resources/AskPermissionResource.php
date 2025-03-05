<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AskPermissionResource\Pages;
use App\Filament\Resources\AskPermissionResource\RelationManagers;
use App\Models\AskPermission;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Modal\Actions\ButtonAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class AskPermissionResource extends Resource
{
    protected static ?string $model = AskPermission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->required()
                    ->relationship("user", "name")
                    ->disabled(fn($livewire) => User::where('id', $livewire->data['user_id'])->value('role') === 'admin'),

                TextInput::make("reason")
                    ->default(AskPermission::where("user_id", Auth::id())->value("reason"))
                    ->disabled(),



                Actions::make([
                    Action::make('approve')
                        ->label('Aceptar')
                        ->modalHeading('Confirmar acción')
                        ->modalDescription('¿Estás seguro de que quieres cambiar el rol de este usuario a Admin?')
                        ->modalSubmitActionLabel('Sí, cambiar')
                        ->action(fn($livewire) => User::where('id', $livewire->data['user_id'])->update(['role' => 'admin']))
                        ->color('success')
                        ->disabled(fn($livewire) => User::where('id', $livewire->data['user_id'])->value('role') === 'admin')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('reason'),

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
            'index' => Pages\ListAskPermissions::route('/'),
            'create' => Pages\CreateAskPermission::route('/create'),
            'edit' => Pages\EditAskPermission::route('/{record}/edit'),
        ];
    }
}
