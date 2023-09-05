<?php
namespace App\Imports;

use Illuminate\Support\Collection; // Make sure to use the correct namespace
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\MailsToGroup;

class EmailsImport implements ToCollection 
{
    protected $groupId;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            $email = $row[0]; 
 
            $this->emailAddresses[] = $email;
        }

        
        $jsonEmails = json_encode($this->emailAddresses);

        MailsToGroup::create([
            'group_id' => $this->groupId,
            'assign_emails_json' => $jsonEmails,
        ]);
    }
}