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
use App\Models\EmailLog;


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
            'campaign_name'     => 'required|string|max:255|unique:campaigns,campaign_name',
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
                        
                        $email_id = rand(0, 99999);
                        $template = json_decode($template, true); 
                        $template["email_id"] = $email_id;
                        
                        dispatch(new SendEmailJob($emailAddress,$template));
                        EmailLog::create([
                            'recipient_email' => $emailAddress,
                            'email_id'        => $email_id,
                            'campaign_id'     => $campaign->id,                        
                            'user_id'         => auth()->user()->id
                        ]);
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


    public function deleteCampaign(Request $request, $id)
        {
            $campaign = Campaign::findOrFail($id);
            $campaign->delete();
            return redirect()->route('campaign.view')->with('success', 'Campaign deleted successfully');

           
        }

        public function resendCampaign(Request $request, $id)
        {
           
            $existingCampaign = Campaign::findOrFail($id);
            
            $template = Template::where('id', $existingCampaign->template_option)->first();
            
            $emailAddressesData = MailsToGroup::where('group_id', $existingCampaign->group_id)->get();
            
            foreach ($emailAddressesData as $emailData) {
                
                $emailAddressesArray = json_decode($emailData->assign_emails_json);
                
                if (is_array($emailAddressesArray)) {
                    
                    foreach ($emailAddressesArray as $emailAddress) {
                        
                        $email_id = rand(0, 99999);
                        
                        $template = json_decode($template, true); 
                        $template["email_id"] = $email_id;
                        
                        dispatch(new SendEmailJob($emailAddress,$template));
                        EmailLog::create([
                            'recipient_email' => $emailAddress,
                            
                            'email_id'        => $email_id,
                            'campaign_id'     => $existingCampaign->id,
                            'user_id'         => auth()->user()->id
                        ]);
                    
                        }
                        
                    }

                
            }
    
            return redirect()->route('campaign.view')->with('success', 'Campaign restarted successfully');
        }

        public function edit(Campaign $campaign){
            $groups = Group::all();
            $templates = Template::all(); 
            return view('campaigns.edit', compact('campaign', 'groups', 'templates'));
        }
        public function update(Request $request, Campaign $campaign)
        {
            
            $data = $request->validate([
                'campaign_name' => 'required|string|max:255',
                'group_id' => 'required|exists:groups,id', 
                'schedule_option' => 'required|in:instant,scheduled',
                'start_date' => 'nullable|date_format:Y-m-d\TH:i', 
                'recurring_option' => 'nullable|in:daily,weekly', 
                'template_option' => 'required|exists:templates,id', 
            ]);
    
            
            $campaign->update($data);
    
            return redirect()->route('campaign.view')->with('success', 'Campaign updated successfully');
        }
}
