<?php
namespace App\Filament\Resources;
use App\Models\Testimonial;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\TestimonialResource\Pages;
class TestimonialResource extends Resource {
 protected static ?string $model = Testimonial::class;
 protected static ?string $recordTitleAttribute = 'name';
 public static function getNavigationLabel():string {return 'Testimonials';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('name')->required(),TextInput::make('city'),Select::make('trip_id')->relationship('trip','title'),Textarea::make('quote')->required(),TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->default(5),FileUpload::make('photo')->disk('public')->directory('portraits')->image(),Toggle::make('consent_given')->label('Written permission has been obtained'),Select::make('status')->options(['pending'=>'Pending','approved'=>'Approved'])->default('pending')]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('name')->searchable()->sortable(),TextColumn::make('status')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListTestimonials::route('/'),'create'=>Pages\CreateTestimonial::route('/create'),'edit'=>Pages\EditTestimonial::route('/{record}')];}
}
