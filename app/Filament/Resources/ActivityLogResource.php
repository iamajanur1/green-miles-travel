<?php
namespace App\Filament\Resources;
use App\Models\ActivityLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\ActivityLogResource\Pages;
class ActivityLogResource extends Resource {
 protected static ?string $model=ActivityLog::class;
 public static function getNavigationLabel():string{return 'Audit history';}
 public static function canViewAny():bool{return auth()->user()?->isOwner()===true;}
 public static function canCreate():bool{return false;}
 public static function canEdit($record):bool{return false;}
 public static function canDelete($record):bool{return false;}
 public static function canDeleteAny():bool{return false;}
 public static function form(Schema $schema):Schema{return $schema->components([]);}
 public static function table(Table $table):Table{return $table->columns([TextColumn::make('action'),TextColumn::make('model'),TextColumn::make('model_id'),TextColumn::make('user_id'),TextColumn::make('created_at')->dateTime()]);}
 public static function getPages():array{return ['index'=>Pages\ListActivityLogs::route('/')];}
}
