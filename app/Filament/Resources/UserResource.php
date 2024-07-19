<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Utilisateurs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('lastname')
                    ->label('Lastname')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->required(),
                Forms\Components\TextInput::make('postalcode')
                    ->label('Postalcode')
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->label('City')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->required(),
                Forms\Components\Select::make('role_id')
                    ->label('Role')
                    ->options(Role::pluck('state', 'id')->toArray()) // Pluck pour obtenir les options
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('remember_token')
                    ->label('Remember Token')
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->label('Lastname')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('postalcode')
                    ->label('Postalcode')
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role.state') // Affichage du champ 'state' du modèle Role
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(),

            ])
            ->filters([
                // Ajoutez des filtres si nécessaire
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
            // Ajoutez des gestionnaires de relations si nécessaire
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
