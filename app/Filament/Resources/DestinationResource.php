<?php
namespace App\Filament\Resources;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\DestinationResource\Pages;
class DestinationResource extends Resource {
 protected static ?string $model = Destination::class;
 protected static ?string $recordTitleAttribute = 'name';
 public static function getNavigationLabel():string {return 'Destinations';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('name')->required(),TextInput::make('slug')->required()->unique(ignoreRecord:true),TextInput::make('region'),Textarea::make('summary'),RichEditor::make('description')->columnSpanFull(),TextInput::make('best_time'),Textarea::make('how_to_reach'),FileUpload::make('cover_image')->disk('public')->directory('destinations')->image(),FileUpload::make('gallery_image')->disk('public')->directory('destinations')->image(),Toggle::make('is_featured'),TextInput::make('sort_order')->numeric()->default(0),TextInput::make('seo_title'),Textarea::make('seo_description')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('name')->searchable()->sortable(),TextColumn::make('region')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListDestinations::route('/'),'create'=>Pages\CreateDestination::route('/create'),'edit'=>Pages\EditDestination::route('/{record}')];}
}
