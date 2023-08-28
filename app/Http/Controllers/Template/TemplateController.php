<?php

namespace App\Http\Controllers\Template;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    public function create()
    {
        return view('template.create-template');
    }

    public function store(Request $request)
    {   
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Create a new Template instance
        $template = new Template();
        $template->name = $data['name'];
        $template->subject = $data['subject'];
        $template->content = $data['content'];

        $template->save();

        return redirect()->route('template.create')->with('success', 'Email template created successfully!');
    }

    

    public function viewTemplates()
    {   
        $templates = Template::all();
        return view('template.view-templates', compact('templates'));
    }

    public function viewPopup()
    {   
        $templates = Template::all();
        return view('template.show-popup');
    }

    public function showPopup($id)
    {
        $template = Template::findOrFail($id);

        return response()->json([
            'name' => $template->name,
            'subject' => $template->subject, 
            'content' => $template->content, 
        ]);
    }
    
}
