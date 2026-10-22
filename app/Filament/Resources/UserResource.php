<?php
namespace App\Filament\Resources;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Forms\Components\{TextInput,Select,Toggle};
use Filament\Tables\Columns\{TextColumn,IconColumn};
use Filament\Actions\{EditAction,DeleteAction};
use App\Filament\Resources\UserResource\Pages;
class UserResource extends Resource {
 protected static ?string $model=User::class;
 protected static ?string $recordTitleAttribute='name';
 public static function getNavigationLabel():string{return 'Team accounts';}
 public static function canViewAny():bool{return auth()->user()?->isOwner()===true;}
 public static function canCreate():bool{return auth()->user()?->isOwner()===true;}
 public static function canEdit($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canView($record):bool{return auth()->user()?->isOwner()===true;}
 public static function canDelete($record):bool{return auth()->user()?->isOwner()===true && $record->id!==auth()->id();}
 public static function canDeleteAny():bool{return false;}
 public static function form(Schema $schema):Schema{return $schema->components([
   TextInput::make('name')->required(),TextInput::make('email')->email()->required()->unique(ignoreRecord:true),
   TextInput::make('password')->password()->formatStateUsing(fn()=>null)->minLength(12)->required(fn(string $operation)=>$operation==='create')->dehydrated(fn($state)=>filled($state)),
   Select::make('role')->options(['owner'=>'Owner','editor'=>'Editor'])->required(),
   Toggle::make('is_active')->default(true),
 ]);}
 public static function table(Table $table):Table{return $table->columns([TextColumn::make('name')->searchable(),TextColumn::make('email')->searchable(),TextColumn::make('role'),IconColumn::make('is_active')->boolean()])->recordActions([EditAction::make(),DeleteAction::make()]);}
 public static function getPages():array{return ['index'=>Pages\ListUsers::route('/'),'create'=>Pages\CreateUser::route('/create'),'edit'=>Pages\EditUser::route('/{record}')];}
}
