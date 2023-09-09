<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Group;
use App\Models\MailsToGroup;
use App\Imports\EmailsImport; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

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
        $data = $request->validate([
            'group_id' => 'required|string|max:255',
            'assign_emails_json' => [
                'nullable',
                'string',
                Rule::requiredIf(function () use ($request) {
                    return !$request->hasFile('email_list'); // Only required if email_list is not present
                }),
            ],
            'email_list' => [
                'nullable',
                'file',
                'mimes:xlsx',
                Rule::requiredIf(function () use ($request) {
                    return empty($request->input('assign_emails_json')); // Only required if assign_emails_json is empty
                }),
            ],
        ]);
        
        if($data['assign_emails_json']){
            $emailsArray = explode(',', $data['assign_emails_json']);
            $assignEmailsJson = json_encode($emailsArray);
            $data['assign_emails_json'] = $assignEmailsJson;
            MailsToGroup::create($data);
        }   
    
            if ($request->hasFile('email_list') && $request->file('email_list')->isValid()) {
                $groupId = $request->input('group_id'); // Get the group_id from the request

                // Pass the $groupId when creating the import instance
                $import = new EmailsImport($groupId);

                Excel::import($import, $request->file('email_list'));

              
            }

            return redirect('assign-mails')->with('success', 'Mail Assigned successfully.');   

    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'group_name'        => 'required|string|max:255|unique:groups,group_name',
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
    

    public function deleteGroup(Request $request, $id)
    {
        try {
            $group = Group::findOrFail($id);
            $group->delete();
            return redirect()->route('view-groups')->with('success', 'Group deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('view-groups')->with('error', 'Failed to delete group');
        }
    }


    public function update(Request $request)
    {
        
        $group = Group::findOrFail($request->input('editGroupId'));
        
        $group->group_name = $request->input('editGroupName');
        $emails = preg_split('/\r\n|\r|\n/', $request->input('editAssignedEmails'));
        $group->mailsToGroups()->delete(); // Delete existing email assignments
    
        foreach ($emails as $email) {
            $group->mailsToGroups()->create([
                'assign_emails_json' => json_encode([$email]),
            ]);
        }
        $group->save();
        return redirect()->route('view-groups')->with('success', 'Group updated successfully');
    }

}
