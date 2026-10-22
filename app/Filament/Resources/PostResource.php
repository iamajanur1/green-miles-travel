<?php
namespace App\Filament\Resources;
use App\Models\Post;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\PostResource\Pages;
class PostResource extends Resource {
 protected static ?string $model = Post::class;
 protected static ?string $recordTitleAttribute = 'title';
 public static function getNavigationLabel():string {return 'Journal posts';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('title')->required(),TextInput::make('slug')->required()->unique(ignoreRecord:true),Textarea::make('excerpt'),RichEditor::make('body')->required()->columnSpanFull(),FileUpload::make('cover_image')->disk('public')->directory('journal')->image(),Select::make('status')->options(['draft'=>'Draft','published'=>'Published'])->required(),DateTimePicker::make('published_at'),TextInput::make('read_minutes')->numeric()->default(3),TextInput::make('seo_title'),Textarea::make('seo_description')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('title')->searchable()->sortable(),TextColumn::make('status')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListPosts::route('/'),'create'=>Pages\CreatePost::route('/create'),'edit'=>Pages\EditPost::route('/{record}')];}
}
