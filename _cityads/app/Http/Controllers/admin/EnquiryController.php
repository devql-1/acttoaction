<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionFullForm;
use App\Models\Contact;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    //This method will show enquiries listing
    public function index()
    {
        Contact::where('is_read', 0)->update(['is_read' => 1]);
        $services_enquiries = Contact::latest()->get();
        return view('backend.enquiries.services.index', compact('services_enquiries'));
    }

    public function enquiryCount()
    {
        $count = Contact::where('is_read', 0)->count();
        return response()->json(['count' => $count]);
    }


    public function markAllRead()
    {
        Contact::where('is_read', 0)->update(['is_read' => 1]);
        return response()->json(['status' => 'success']);
    }

    public function latest()
    {
        $notifications = Contact::orderBy('id', 'desc')
            ->take(5) // sirf latest 5
            ->get(['id','username','created_at']);

        return response()->json([
            'count' => Contact::where('is_read',0)->count(),
            'notifications' => $notifications
        ]);
    }

    //This method will destroy a particular listing
    public function destroy($id){
        Contact::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
