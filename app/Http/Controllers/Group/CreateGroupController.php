<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Group;
use App\Models\MailsToGroup;

class CreateGroupController extends Controller
{
    function index () {
       
        return view('group.create-group');
    
    }

    function assign_mails_index () {
        
        $groupNames = Group::pluck('group_name', 'id');
        return view('group.assign-mails', compact('groupNames'));
    }
    
    public function store_assigned_mails (Request $request) {
        
    //dd($request->all());

    $data = $request->validate([
        'group_id'           => 'required|string|max:255',
        'assign_emails_json' => 'nullable|string',
        'file' => 'required|mimes:csv|max:2048', // Make sure you're validating the file type
    ]);
    
    $emailsArray = explode(',', $data['assign_emails_json']);
    $assignEmailsJson = json_encode($emailsArray);
    $data['assign_emails_json'] = $assignEmailsJson;
    
    // Store the file in storage/app/public directory
     $path = $request->file('file')->storeAs('uploads', $request->file('file')->getClientOriginalName());
        

        MailsToGroup::create($data);
        
        return redirect('assign-mails')->with('success', 'Mail Assigned successfully.');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'group_name'        => 'required|string|max:255',
            'group_description' => 'nullable|string',
            'group_type'        => 'required|string',
            'group_category'    => 'required|string',
            'privacy_settings'  => 'required|string',
            
        ]);

        Group::create($data);

        // Redirect back or to a specific route after successful data storage
        return redirect()->route('group')->with('success', 'Group created successfully.');
        
    }


    

    public function view_group(){

        $groups = Group::with('mailsToGroups')->get();
        return view('group.view-groups', compact('groups'));
    }
    

}
