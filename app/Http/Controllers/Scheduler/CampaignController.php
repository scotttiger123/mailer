<?php

namespace App\Http\Controllers\Scheduler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\MailsToGroup;
use App\Models\Campaign;
use Illuminate\Support\Facades\Mail;
use App\Mail\CampaignCreated;
use App\Jobs\SendEmailJob;
use App\Models\Template;

class CampaignController extends Controller
{
   
    function index() {
        $groups = Group::all();
        $templates = Template::all(); 
        return view('campaigns.create-campaign', compact('groups', 'templates'));
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
        
        
        $campaign = Campaign::create($data);
        $template = Template::where('id', $data['template_option'])->first();
        
        $emailAddressesData = MailsToGroup::where('group_id', $data['group_id'])->get();
        
        foreach ($emailAddressesData as $emailData) {
            $emailAddressesArray = json_decode($emailData->assign_emails_json);
        
            if (is_array($emailAddressesArray)) {
                
                foreach ($emailAddressesArray as $emailAddress) {
                        dispatch(new SendEmailJob($emailAddress,$template));
                }
            
            } else {
                
            }
        }  
        
       return redirect('campaign')->with('success', 'Campaign created successfully!');
    }

    public function view()
    {
        $campaigns = Campaign::all();
        return view('campaigns.view-campaign', compact('campaigns'));
    }
}
