<?php

namespace App\Http\Controllers\Scheduler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Campaign;


class CampaignController extends Controller
{
    function index () {
        
        $groups = Group::all(); 
        return view('campaigns.create-campaign', compact('groups'));
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_name'     => 'required|string|max:255',
            'group_id'          => 'required|exists:groups,id', 
            'schedule_option'   => 'required|string',
            'start_date'        => 'nullable|date',
            'recurring_option'  => 'nullable|string',
            'template_option'   => 'required|string',
        ]);

        Campaign::create($data);

        return redirect('campaign')->with('success', 'Campaign created successfully!');
    }

    public function view()
    {
        $campaigns = Campaign::all();

        return view('campaigns.view-campaign', compact('campaigns'));
    }
}
