<?php
namespace App\Filament\Resources;
use App\Models\Trip;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\TripResource\Pages;
class TripResource extends Resource {
 protected static ?string $model = Trip::class;
 protected static ?string $recordTitleAttribute = 'title';
 public static function getNavigationLabel():string {return 'Trips';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('title')->required()->maxLength(150),
TextInput::make('slug')->required()->unique(ignoreRecord:true)->maxLength(160),
Textarea::make('summary')->maxLength(160),
RichEditor::make('description')->columnSpanFull(),
Select::make('destination_id')->relationship('destination','name')->searchable(),
Select::make('categories')->relationship('categories','name')->multiple()->preload()->required(),
TextInput::make('price_per_person')->numeric()->minValue(0)->required()->prefix('₹'),
TextInput::make('price_note')->default('from / person'),
TextInput::make('duration_days')->numeric()->required()->default(2),
TextInput::make('duration_nights')->numeric()->required()->default(1),
Select::make('difficulty')->options(['easy'=>'Easy','moderate'=>'Moderate','hard'=>'Hard'])->required(),
TextInput::make('start_point'),TextInput::make('group_size_max')->numeric(),
TextInput::make('best_season'),TextInput::make('altitude_m')->numeric(),
FileUpload::make('cover_image')->disk('public')->directory('trips')->image()->maxSize(10240),
FileUpload::make('gallery_images')->disk('public')->directory('trips')->multiple()->image()->reorderable()->maxFiles(10)->maxSize(10240),
Repeater::make('itinerary')->schema([TextInput::make('day')->numeric()->required(),TextInput::make('title')->required(),Textarea::make('body')])->defaultItems(1)->columnSpanFull(),
Repeater::make('inclusions')->simple(TextInput::make('item'))->columnSpanFull(),
Repeater::make('exclusions')->simple(TextInput::make('item'))->columnSpanFull(),
Repeater::make('faq')->schema([TextInput::make('question'),Textarea::make('answer')])->columnSpanFull(),
Toggle::make('is_featured')->label('Featured on homepage'),
Select::make('status')->options(['draft'=>'Draft','scheduled'=>'Scheduled','published'=>'Published','archived'=>'Archived'])->required()->default('draft'),
DateTimePicker::make('publish_at'),
TextInput::make('sort_order')->numeric()->default(0),
TextInput::make('seo_title'),Textarea::make('seo_description')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('title')->searchable()->sortable(),TextColumn::make('status')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListTrips::route('/'),'create'=>Pages\CreateTrip::route('/create'),'edit'=>Pages\EditTrip::route('/{record}')];}
}
