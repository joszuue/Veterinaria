<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Paciente;
use App\Models\Propietario;
class PacienteTypeOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            //
            Card::make('Gatos', Paciente::query()->where('tipo', 'gato')->count()),
            Card::make('Perros', Paciente::query()->where('tipo', 'perro')->count()),
            Card::make('Conejos', Paciente::query()->where('tipo', 'conejo')->count()),
            Card::make('Propietarios', Propietario::query()->count()),
        ];
    }
}
