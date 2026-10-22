<?php
namespace App\Filament\Resources;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\CategoryResource\Pages;
class CategoryResource extends Resource {
 protected static ?string $model = Category::class;
 protected static ?string $recordTitleAttribute = 'name';
 public static function getNavigationLabel():string {return 'Categories';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('name')->required(),TextInput::make('slug')->required()->unique(ignoreRecord:true),TextInput::make('tagline'),TextInput::make('icon'),FileUpload::make('cover_image')->disk('public')->directory('categories')->image(),Toggle::make('is_active')->default(true),TextInput::make('sort_order')->numeric()->default(0)]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('name')->searchable()->sortable(),TextColumn::make('is_active')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListCategories::route('/'),'create'=>Pages\CreateCategory::route('/create'),'edit'=>Pages\EditCategory::route('/{record}')];}
}
