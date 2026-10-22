<?php
namespace App\Filament\Resources;
use App\Models\Enquiry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Textarea,Select,RichEditor,FileUpload,Toggle,DatePicker,DateTimePicker,Repeater};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\EnquiryResource\Pages;
class EnquiryResource extends Resource {
 protected static ?string $model = Enquiry::class;
 protected static ?string $recordTitleAttribute = 'name';
 public static function getNavigationLabel():string {return 'Enquiries';}
 public static function canViewAny():bool{return auth()->user()?->canAccessPanel(filament()->getCurrentPanel())??false;}
 public static function canCreate():bool{return false;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDeleteAny():bool{return auth()->user()?->isOwner()===true;}
 public static function form(Schema $schema):Schema {return $schema->components([TextInput::make('name')->required(),TextInput::make('phone')->required(),TextInput::make('email')->email(),Select::make('trip_id')->relationship('trip','title'),TextInput::make('preferred_dates'),TextInput::make('group_size')->numeric(),Textarea::make('message')->columnSpanFull(),Select::make('status')->options(['new'=>'New','contacted'=>'Contacted','confirmed'=>'Confirmed','closed'=>'Closed'])->required(),Textarea::make('notes')->columnSpanFull()]);}
 public static function table(Table $table):Table {return $table->columns([TextColumn::make('name')->searchable()->sortable(),TextColumn::make('status')->sortable(),TextColumn::make('updated_at')->since()->sortable()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListEnquiries::route('/'),'create'=>Pages\CreateEnquiry::route('/create'),'edit'=>Pages\EditEnquiry::route('/{record}')];}
}
