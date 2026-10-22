<?php
namespace App\Filament\Resources;
use App\Models\Setting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\SettingResource\Pages;
class SettingResource extends Resource {
 protected static ?string $model = Setting::class;
 protected static ?string $recordTitleAttribute = 'business_name';
 public static function getNavigationLabel():string {return 'Site settings';}
 public static function canViewAny():bool{return auth()->user()?->isOwner()===true;}
 public static function canCreate():bool{return false;}
 public static function canEdit($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canView($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('business_name')->required(),TextInput::make('phone_primary'),TextInput::make('phone_secondary'),TextInput::make('whatsapp')->required(),TextInput::make('email')->email(),TextInput::make('address'),TextInput::make('hero_badge'),TextInput::make('hero_title')->required(),Textarea::make('hero_body'),FileUpload::make('hero_image')->disk('public')->directory('hero')->image(),TextInput::make('default_seo_title'),Textarea::make('default_seo_description')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('business_name')->searchable()->sortable(),TextColumn::make('email')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListSettings::route('/'),'create'=>Pages\CreateSetting::route('/create'),'edit'=>Pages\EditSetting::route('/{record}')];}
}
