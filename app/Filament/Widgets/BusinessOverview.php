<?php
namespace App\Filament\Widgets;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\{Enquiry,Trip,Departure,Announcement};
class BusinessOverview extends StatsOverviewWidget {
 protected function getStats():array{return [
  Stat::make('New enquiries',Enquiry::where('status','new')->count())->description('Needs a reply'),
  Stat::make('Published trips',Trip::where('status','published')->count())->description('Currently listed'),
  Stat::make('Upcoming departures',Departure::whereDate('starts_on','>=',today())->where('status','!=','cancelled')->count())->description('From today'),
  Stat::make('Active announcements',Announcement::where('is_active',true)->count())->description('Manage popups'),
 ];}
}
