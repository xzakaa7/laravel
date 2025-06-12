<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Users;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UsersResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UsersResource\RelationManagers;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;
       // protected static ?int $navigationSort = 1;
     //protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
  protected static ?string $navigationGroup = 'Users';
    protected static ?string $label = 'Admin Super';
    protected static ?string $pluralLabel = 'Daftar Admin';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama')
                    ->placeholder('Masukkan Nama')
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->placeholder('Masukkan Email')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->maxLength(255)
                     ->placeholder('Masukkan Password'),

                
                Forms\Components\Select::make('roles')
                ->relationship('roles' , 'name' )->label('Role Permission')->placeholder('Pilih Role')
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                   TextColumn::make('id')
                   ->label('Id '),
                TextColumn::make('name')->label('Nama Admin'),
                TextColumn::make('email')->label('Email Admin'),
             
                // BadgeColumn::make('roles.name')
                // ->label('Role')
                // ->colors([
                //     'primary' => fn ($state) => $state === 'Super Admin',
                //     'warning' => fn ($state) => $state === 'Test',
                //     //'danger' => fn ($state) => $state === 'super-admin',
                //     //'warning' => fn ($state) => $state === 'moderator',
                // ])

                  Tables\Columns\BadgeColumn::make('roles.name')->colors([
                    'danger' => 'SuperAdmin',
                    'success' => 'admin',
                    'warning' => 'Petugas',
                ])
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
             
                
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
