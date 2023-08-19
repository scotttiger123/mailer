<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:csv|max:2048',
    ], [
        'file.mimes' => 'The uploaded file must be a CSV.',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $path = $request->file('file')->storeAs('uploads', $request->file('file')->getClientOriginalName());

        return response()->json(['message' => 'CSV file uploaded successfully', 'path' => $path], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while uploading the file'], 500);
    }
}
}
