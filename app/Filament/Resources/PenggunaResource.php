<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pengguna;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Widgets\DashboardOverview;
use App\Filament\Resources\PenggunaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenggunaResource\RelationManagers;

class PenggunaResource extends Resource
{
    protected static ?string $model = Pengguna::class;
        //protected static ?int $navigationSort = 2;
 // protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
   protected static ?string $navigationGroup = 'Users';
    protected static ?string $label = 'Pengguna';
    protected static ?string $pluralLabel = 'Daftar Pengguna';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('email'), TextInput::make('password')->hiddenOn('view'), TextInput::make('no_hp'), TextInput::make('alamat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('id'),
                TextColumn::make('nama') ->searchable(),
                TextColumn::make('email'),
                TextColumn::make('alamat'),
               
            ])
      // tetap aktifkan pencarian
        //   ->headerActions([
        //     ExportAction::make()
        //         ->exporter(PenggunaResource::class)
        // ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('primary'),
            ])
            ->bulkActions([
              Tables\Actions\DeleteBulkAction::make(),
                  
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
            'index' => Pages\ListPenggunas::route('/'),
            'create' => Pages\CreatePengguna::route('/create'),
            'edit' => Pages\EditPengguna::route('/{record}/edit'),
        ];
    }

    public function getResources(): array
{
    return [
        \App\Filament\Resources\PengaduanResource::class,
        \App\Filament\Resources\PenggunaResource::class,
        \App\Filament\Resources\EventResource::class,
        \App\Filament\Resources\NewsResource::class,
    ];
}

}
