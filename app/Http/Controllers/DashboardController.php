<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Campaign;
use App\Models\Group;
use App\Models\EmailLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
class DashboardController extends Controller
{
    
    public function index()
    {
        $totalGroups    = Group::count();
        $totalTemplates = Template::count();
        $totalCampaigns = Campaign::count();
        $TotalEmailLog  = EmailLog::count();
    
        $user = auth()->user(); 
    
        $package = Package::find($user->package_id);
        
        $campaigns = Campaign::pluck('campaign_name', 'id')->all(); 
    
        return view('dashboard', compact('totalTemplates', 'totalCampaigns', 'totalGroups', 'TotalEmailLog', 'campaigns', 'package'));
    }
    


    public function getEmailLogData($campaignId) {
        
        try {
            $userId = Auth::id();
            $emailLogData = EmailLog::where('campaign_id', $campaignId)
                ->where('user_id', $userId) 
                ->select([
                    'campaign_id',
                    DB::raw('COUNT(*) as total_sent'),
                    DB::raw('SUM(CASE WHEN opened_at IS NOT NULL THEN 1 ELSE 0 END) as total_opened')
                ])
                ->groupBy('campaign_id')
                ->first();
            
                $record = EmailLog::where('campaign_id', $campaignId)->get();
                

            if ($emailLogData) {
                return response()->json([
                    'campaign_id' => $emailLogData->campaign_id,
                    'total_sent' => $emailLogData->total_sent,
                    'total_opened' => $emailLogData->total_opened,
                    'record'     => $record
                ]);
            } else {
                return response()->json([
                    'campaign_id' => $campaignId,
                    'total_sent' => 0,
                    'total_opened' => 0,
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching email log data: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching data'], 500); 
        }
    }

}
