<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Activation;
use App\Models\File;
class FileUpload extends Controller
{
    public function createForm(){
        return view('upload');
    }

    public function fileUpload(Request $req){
        $req->validate([
            'file' => 'required|mimes:sql,txt,xls,xlsx,pdf,doc,zip,docx,csv|max:2048'
        ]);
        $fileModel = new File;
        if ($req->file()) {
            $fileName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time() . '_' . $req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }
}
