<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function update(Request $req)
    {
        Log::info('recieved update request');
        $req->file('photo')->store('storage/uploads');

        return redirect('/uploads/show');
    }
}