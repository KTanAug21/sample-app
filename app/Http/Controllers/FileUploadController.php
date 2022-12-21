<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Log;
class FileUploadController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        Log::info('recieved show request');
        return view('file-upload.index', []);
    }

    /**
     * Upload image
     * 
     * @param \Illuminate\Http\Request $request
     * @return redirect
     */
    public function store(Request $request)
    {
        // some validation here later

        // Upload file
        Log::info('recieved update request');
        $file = $request->file('mFile');
        $file->storeAs(
            'storage/uploads',
            $file->getClientOriginalName()
        );

        // Go back to form
        return redirect('/uploads/show',['status'=>201]);
    }
}