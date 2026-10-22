<?php
namespace App\Filament\Resources\DepartureResource\Pages;
use App\Filament\Resources\DepartureResource;
use Filament\Resources\Pages\ListRecords;
class ListDepartures extends ListRecords { protected static string $resource=DepartureResource::class;  protected function getHeaderActions():array {return [\Filament\Actions\CreateAction::make()];} }
