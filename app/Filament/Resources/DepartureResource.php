<?php
namespace App\Filament\Resources;
use App\Models\Departure;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\DepartureResource\Pages;
class DepartureResource extends Resource {
 protected static ?string $model = Departure::class;
 protected static ?string $recordTitleAttribute = 'starts_on';
 public static function getNavigationLabel():string {return 'Departures';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([Select::make('trip_id')->relationship('trip','title')->required()->searchable(),DatePicker::make('starts_on')->required(),DatePicker::make('ends_on')->required(),TextInput::make('seats_total')->numeric(),TextInput::make('seats_booked')->numeric()->default(0),TextInput::make('price_override')->numeric()->prefix('₹'),Select::make('status')->options(['available'=>'Available','enquire'=>'Enquire','full'=>'Full','cancelled'=>'Cancelled'])->default('enquire')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('starts_on')->searchable()->sortable(),TextColumn::make('status')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListDepartures::route('/'),'create'=>Pages\CreateDeparture::route('/create'),'edit'=>Pages\EditDeparture::route('/{record}')];}
}
