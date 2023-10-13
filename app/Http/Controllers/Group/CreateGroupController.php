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
use Illuminate\Support\Facades\Auth;

class CreateGroupController extends Controller
{
    function index () {
       
        return view('group.create-group');
    
    }

    public function assign_mails_index()
{
    $userId = Auth::id();

    $groupNames = Group::where('created_by', $userId)->pluck('group_name', 'id');

    return view('group.assign-mails', compact('groupNames'));
}

    
    public function store_assigned_mails (Request $request) {
        $data = $request->validate([
            'group_id' => 'required|string|max:255',
            'assign_emails_json' => [
                'nullable',
                'string',
                Rule::requiredIf(function () use ($request) {
                    return !$request->hasFile('email_list'); 
                }),
            ],
            'email_list' => [
                'nullable',
                'file',
                'mimes:xlsx',
                Rule::requiredIf(function () use ($request) {
                    return empty($request->input('assign_emails_json')); 
                }),
            ],
        ]);
        
        // if($data['assign_emails_json']){
        //     $emailsArray = explode(',', $data['assign_emails_json']);
        //     $assignEmailsJson = json_encode($emailsArray);
        //     $data['assign_emails_json'] = $assignEmailsJson;
        //     MailsToGroup::create($data);
        // }   

        
        if ($data['assign_emails_json']) {
            $emailsArray = explode(' ', $data['assign_emails_json']);
            $emailsArray = array_map('trim', $emailsArray);
            $emailsArray = array_filter($emailsArray, function ($email) {
                return !empty($email);
            });
        
            $assignEmailsJson = json_encode(array_values($emailsArray));
            $data['assign_emails_json'] = $assignEmailsJson;
            MailsToGroup::create($data);
        }
        
        
            if ($request->hasFile('email_list') && $request->file('email_list')->isValid()) {
                $groupId = $request->input('group_id'); // Get the group_id from the request

               
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
    
        $userId = Auth::id();
        $data['created_by'] = $userId;
    
        Group::create($data);
    
        return redirect()->route('group')->with('success', 'Group created successfully.');
    }
    

    
    public function view_group()
        {
            $userId = Auth::id();

            $groups = Group::with('mailsToGroups')
                ->where('created_by', $userId)
                ->get();

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
        
        // Split the input by spaces, remove empty elements, and convert to JSON
        $emails = explode(' ', $request->input('editAssignedEmails'));
        $emails = array_map('trim', $emails); // Remove leading/trailing spaces
        $emails = array_filter($emails, function ($email) {
            return !empty($email);
        });
    
        $group->mailsToGroups()->delete();
        $group->mailsToGroups()->create([
            'assign_emails_json' => json_encode(array_values($emails)),
        ]);
        
        $group->save();
        return redirect()->route('view-groups')->with('success', 'Group updated successfully');
    }
    

    

}
