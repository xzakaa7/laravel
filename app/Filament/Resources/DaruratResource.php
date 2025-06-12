<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Darurat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DaruratResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DaruratResource\RelationManagers;

class DaruratResource extends Resource
{
    protected static ?string $model = Darurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Darurat';
      protected static ?string $navigationGroup = 'Layanan Publik';
 //   protected static ?string $pluralLabel = 'Daftar Pengaduan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\Select::make('pengguna_id')
                    ->relationship('pengguna', 'nama')
                    ->label('Nama Pengguna')
                    ->required(),

                Forms\Components\TextInput::make('nama_pelapor')
                    ->required(),

                Forms\Components\Select::make('kategori')
                    ->options([
                        'darurat' => 'Darurat',
                        'sedang' => 'Sedang',
                        'standard' => 'Standard',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('keterangan'),

                Forms\Components\TextInput::make('lokasi')
                    ->required(),

                Forms\Components\TextInput::make('foto')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'dikirim' => 'Dikirim',
                        'diproses' => 'Diproses',
                        'ditangani' => 'Ditangani',
                    ])
                    ->default('dikirim')
                    ->required(),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           
                ->columns([
                Tables\Columns\TextColumn::make('nama_pelapor')->label('Pelapor'),
                Tables\Columns\TextColumn::make('kategori')->badge(),


                Tables\Columns\TextColumn::make('status')->badge(),
           //     Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Waktu Lapor'),

        TextColumn::make('lokasi')
    ->label('Map')
    ->formatStateUsing(fn ($record) => 
        '<a href="https://www.google.com/maps?q=' . urlencode($record->lokasi) . '" target="_blank" class="text-blue-600 underline">Lihat</a>'
    )
    ->html()  // Penting agar html tag <a> dirender, bukan tampil plain text
    ->alignCenter()

            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                 Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDarurats::route('/'),
            'create' => Pages\CreateDarurat::route('/create'),
            'edit' => Pages\EditDarurat::route('/{record}/edit'),
        ];
    }
}
