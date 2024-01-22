<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    function index()
    {
        $files = File::latest()->get();
        return inertia('Files/Index', compact('files'));
    }

    function create()
    {
        return inertia('Files/Create');
    }

    function store(Request $request)
    {
        $request->validate([
            'file' => ['required'],
        ]);
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->file->move(public_path() . '/uploads/files', $filename);
            $file = $filename;
        }

        File::create([
            'file' => $file
        ]);

        return to_route('files')->with('success', 'File uploaded successfully');

    }

    public function edit($id)
    {

        $file = File::find($id);
        return inertia('Files/Edit', compact('file'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'file' => ['required'],
        ]);
        $present = File::where('id', $request->fileId)->first();
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            request()->file->move(public_path() . '/uploads/files', $filename);
            $file = $filename;
        }else{
            $file = $present->file;
        }

        File::where('id', $request->fileId)->update([
            'file' => $file
        ]);

        return to_route('files')->with('success', 'File updated successfully');
    }

    public function delete($id)
    {

        File::find($id)->delete();
        return to_route('files')->with('success', 'File deleted successfully');
    }
}
