<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Validation\ValidationException;
// use App\Services\app;
// use App\Services\Controller;
//  use App\Services\ControllerServiceProvider;
//  use App\Models\User;
class FileController extends Controller
{

    public function store(Request $request)
    {

        // Validate the request
       // dd($request->all());
        $validator = Validator::make($request->all(), [  
        //   'file_name' => 'required',
          'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Adjust the file validation as needed
         ]);
        // Check for validation failure
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
       

       // Get the uploaded file
       $file = $request->file('file');
       $path='Files';
       $filename = $file->getClientOriginalName();
      
       $file2 = new File();
       $file2=File::create([
           'file_name'=>$filename,
           'create_date' => now(),
           'reservation' => $request->reservation,
          'path'=>$path,
          'file'=>$file
       ]);

       
       if($file->move($path,$file->getClientOriginalName())){
        return response()->json(['data' => $file2, 'message' => 'Success'], 200);
       }
      // Return the response
       return'error';
    }
    
     /** 
    *reserve a specific file
     */

    public function checkin(File $file)
    { 
        $lockedFile = $this->FileService->checkin($file);
       return $this->successResponse($lockedFile);





    // $fileService = new FileService(); // يمكنك إنشاء كائن من الخدمة هنا
    // $lockedFile = $fileService->checkin($file);
    // return response()->json(['data' => $lockedFile, 'message' => 'File checked in successfully.'], 200);
    
    
        // $file_id = $request->input('file');

        // قم بفحص $file_id واستخدامه كما هو مناسب لتطبيقك
        // يمكنك استخدامه في دالة $this->fileService->checkin($file_id)

        // $lockedFile = $this->fileService->checkin($file_id);

        // return $this->successResponse($lockedFile);
    }

     /**
     * Release reservation of a file
     */
    public function checkout(File $file)
    {
        $releasedFile = $this->fileService->checkout($file);
        return $this->successResponse($releasedFile);
    }

    // // Release reservation of a file
    
    // public function checkout(File $file)
    // {
    //     $releasedFile = $this->fileService->checkout($file);
    //     return $this->successResponse($releasedFile);
    // }

















}
