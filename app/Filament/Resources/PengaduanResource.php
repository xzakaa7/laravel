<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Pengaduan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengaduanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengaduanResource\RelationManagers;

class PengaduanResource extends Resource
{
    protected static ?string $model = pengaduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';
    protected static ?string $navigationGroup = 'Layanan Publik';
    protected static ?string $label = 'Pengaduan';
    
    protected static ?string $pluralLabel = 'Daftar Pengaduan';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pengguna_id')
                ->relationship('pengguna', 'nama')
                ->required(),
            Forms\Components\TextInput::make('judul')
                ->required(),
                Select::make('jenis_pengaduan')
    ->label('Jenis Pengaduan')
    ->required()
    ->options([
        'darurat' => 'Darurat',
        'biasa' => 'Biasa',
    ])
    ->native(false) // agar pakai dropdown custom UI Filament, bukan default browser
    ->default('biasa'),
        
       
            Forms\Components\TextInput::make('lokasi')
                ->required(),
            // Forms\Components\Select::make('status')
            //     ->options([
            //         'dikirim' => 'Dikirim',
            //         'diproses' => 'Diproses',
            //         'ditangani' => 'Ditangani',
            //     ])
            //     ->default('dikirim')
            //     ->native(false)
            //     ->required(),


            Select::make('status')
            ->options([
                'dikirim' => 'Dikirim',
                'diproses' => 'Diproses',
                'ditangani' => 'Ditangani',
    ])
                  ->default('dikirim')
                  ->native(false)
                  ->required()
                ->disabled(fn ($record) => $record && $record->status === 'ditangani'),
                     Forms\Components\FileUpload::make('foto')
                         ->downloadable()
                ->disk('public')
                // ->directory('pengaduan')
                ->required(),

                    Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->rows(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->poll('30 s')
            ->columns([
                Tables\Columns\TextColumn::make('pengguna.nama')->label('Nama Pelapor'),
                Tables\Columns\TextColumn::make('judul')
                ->label('🚨 Pengaduan'),
                Tables\Columns\TextColumn::make('lokasi')
                
                //->verticallyAlignStart()
                ->label('📍 Lokasi'),
                TextColumn::make('jenis_pengaduan')
                ->label('Jenis Pengaduan')
                ->badge() // Untuk membuat tampilannya seperti label
                ->color(fn (string $state): string => match ($state) {
                'darurat' => 'danger', // merah
                'biasa' => 'warning',  // kuning
                 default => 'secondary',
    })
    ->formatStateUsing(fn (string $state) => ucfirst($state)),
          //     ImageColumn::make('foto'),
                Tables\Columns\BadgeColumn::make('status')->colors([
                    'danger' => 'dikirim',
                    'warning' => 'diproses',
                    'success' => 'ditangani',
                ])
                ->label('status laporan'),
         //       Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                ->label('Detail'),
                Tables\Actions\EditAction::make(),
             
            ])
            ->bulkActions([
             Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
public static function getNavigationBadge(): ?string
{
    $count = static::getModel()::whereIn('status', ['Dikirim', 'Diproses'])->count();

    return $count > 0 ? (string) $count : null;
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
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }
}
