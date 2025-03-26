<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContectUsDetail;
use Illuminate\Http\Request;
use App\Mail\ContactFormReplyMail;
use Illuminate\Support\Facades\Mail;





class ContacController extends Controller
{

    public function index()
    {
       $contactData = ContectUsDetail::all();
       return view("admin.contact.index", compact("contactData"));
    }
    public function reply($id)
    {
        $contactdata = ContectUsDetail::find($id);
        return view("admin.contact.reply",compact('contactdata'));
    }
    

    public function destroy($id)
    {
        $prodColor = ContectUsDetail::findOrFail($id);
        $prodColor->delete();
        return redirect()->back()->with("success","deleted suceessfully");
    }

    public function replymail(Request $request, $id)
    {
        $contact = ContectUsDetail::findOrFail($id);

        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $contact->reply = $validated['reply'];
        $contact->save();
    
        Mail::to($contact->email)->send(new ContactFormReplyMail($contact, $validated['reply']));
    
        return redirect('admin/contactUs')->with('success', 'Reply sent successfully!');
    
    }


    
}
