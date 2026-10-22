<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('greenmiles:health',function(){ $this->info('Green Miles Travel configuration loaded.'); });

// Data minimization: remove closed enquiries after 24 months.
\Illuminate\Support\Facades\Schedule::call(function(){\App\Models\Enquiry::where('status','closed')->where('updated_at','<',now()->subMonths(24))->delete();})->daily();
