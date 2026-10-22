<?php
namespace App\Filament\Resources;
use App\Models\Announcement;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\AnnouncementResource\Pages;
class AnnouncementResource extends Resource {
 protected static ?string $model = Announcement::class;
 protected static ?string $recordTitleAttribute = 'title';
 public static function getNavigationLabel():string {return 'Announcements';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('title')->required(),TextInput::make('eyebrow'),Textarea::make('description')->required(),FileUpload::make('image')->disk('public')->directory('announcements')->image(),DatePicker::make('event_date'),TextInput::make('price_from')->numeric()->prefix('₹'),TextInput::make('location'),TextInput::make('cta_label')->default('View trip'),TextInput::make('cta_url')->default('/tours')->required(),Toggle::make('is_active')->label('Show popup')->default(false),DateTimePicker::make('starts_at'),DateTimePicker::make('ends_at'),TextInput::make('priority')->numeric()->default(0)]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('title')->searchable()->sortable(),TextColumn::make('is_active')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListAnnouncements::route('/'),'create'=>Pages\CreateAnnouncement::route('/create'),'edit'=>Pages\EditAnnouncement::route('/{record}')];}
}
