<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Suaramu;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuaramuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SuaramuResource\RelationManagers;

class SuaramuResource extends Resource
{
    protected static ?string $model = Suaramu::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
    protected static ?string $navigationGroup = 'Layanan Publik';
    protected static ?string $label = 'Suara Rakyat';
    
    
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pengguna_id')
            ->relationship('pengguna', 'nama') // sesuaikan dengan kolom nama di tabel pengguna
            ->required(),

        TextInput::make('judul')->required()->maxLength(255),

        Textarea::make('isi_saran')->required()->maxLength(5000),

        Select::make('kategori')
            ->options([
                'pendidikan' => 'Pendidikan',
                'lingkungan' => 'Lingkungan',
                'kesehatan' => 'Kesehatan',
                'transportasi' => 'Transportasi',
                'lainnya' => 'Lainnya',
            ])
            ->nullable()
            ->label('Kategori'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                        TextColumn::make('pengguna.nama')->label('Nama pengirim saran'),
        TextColumn::make('judul')->label('Judul saran'),
        
        TextColumn::make('kategori')->label('Kategori Saran'),
        TextColumn::make('created_at')->dateTime('d M Y')->label('Dibuat Pada'),

            ])
            ->filters([
                //
            ])
            ->actions([              
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListSuaramus::route('/'),
            'create' => Pages\CreateSuaramu::route('/create'),
            'edit' => Pages\EditSuaramu::route('/{record}/edit'),
        ];
    }
}
