<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class Library extends Controller
{
    public function index()
    {
        return view('library');
    }

    public function getFiles()
    {
        $model = new File();
        $data = $model->select('id', 'name', 'file_path')->orderBy('id', 'desc')->get();
        return view('library', ['data' => $data]);
    }

    public function fileDownload(File $file)
    {
        $cut_path = explode('/', $file['file_path'], 3);
        return response()->download(storage_path('app/public/' . $cut_path[2]));
    }
}
