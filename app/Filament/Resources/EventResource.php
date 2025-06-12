<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;

class EventResource extends Resource
{
    protected static ?string $model = event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Event';
    protected static ?string $pluralLabel = 'Events';
    protected static ?string $navigationGroup = 'Layanan Publik';

    protected static ?string $slug = 'events';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')

                ->required()
                ->maxLength(255),

         
            Forms\Components\TextInput::make('lokasi')
                ->required(),

            Forms\Components\DateTimePicker::make('waktu')
                ->required(),
                
   
           FileUpload::make('gambar')
                ->image()
                 ->directory('events')
                 ->required(),
                

                Forms\Components\Textarea::make('deskripsi')
                ->required()
                ->rows(10),


                
        
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul'),
                Tables\Columns\TextColumn::make('lokasi'),
            //    Tables\Columns\TextColumn::make('waktu')->dateTime(),
            //    ImageColumn::make('gambar'),

                BadgeColumn::make('status')
           ->label('Status Event')
           ->getStateUsing(function ($record) {
             return Carbon::parse($record->waktu)->isFuture()
               ? 'tersedia'
               : 'selesai';
             }) 
             ->colors([
              'success' => 'tersedia',
             'danger' => 'selesai',
             ])
             ->icons([
             'heroicon-o-check' => 'tersedia',
             'heroicon-o-x-mark' => 'selesai',
               ])
              ->sortable(false)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
             
                    Tables\Actions\DeleteBulkAction::make(),
            
            ]);
    }


    public static function getNavigationBadge(): ?string
{
    // Hitung event yang masih akan datang (belum lewat)
    $count = static::getModel()::where('waktu', '>', Carbon::now())->count();

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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}


