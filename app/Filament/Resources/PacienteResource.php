<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('tipo')
                ->options([
                    'gato' => 'Gato',
                    'perro' => 'Perro',
                    'conejo' => 'Conejo'
                ])
                ->required(),
                Forms\Components\DatePicker::make('fechaNac')
                ->required()
                ->maxDate(now()),
                Forms\Components\Select::make('propietario_id')
                ->relationship('propietario', 'nombre')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                    ->label('Dirección de correo electronico')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('telefono')
                    ->label('Número telefonico')
                    ->tel()
                    ->required(),
                ])
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nombre')
                ->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('fechaNac')
                ->sortable(),
                Tables\Columns\TextColumn::make('propietario.nombre')
                ->searchable(),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('tipo')
                ->options([
                    'gato' => 'Gato',
                    'perro' => 'Perro',
                    'conejo' => 'Conejo'
                ]),
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
            RelationManagers\TratamientosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}
