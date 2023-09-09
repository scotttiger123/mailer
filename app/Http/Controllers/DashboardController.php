<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\EmailLog;

class DashboardController extends Controller
{
    
    public function index()
    {
        $totalGroups = Group::count();
        $totalTemplates = Template::count();
        $totalCampaigns = Campaign::count();
        $TotalEmailLog = EmailLog::count();
        // $emailAnalyticsData = $this->getEmailAnalyticsData(); // Replace with your data fetching logic

        return view('dashboard', compact( 'totalTemplates', 'totalCampaigns','totalGroups','TotalEmailLog'));
    }

}
