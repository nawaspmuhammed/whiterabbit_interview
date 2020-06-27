<?php

namespace App\Http\Controllers;


use App\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DirectoryController extends Controller
{
    public function index(){
        
        if(request("search")!=""){
            $files= Directory:: whereRaw("file_name regexp '^.*\.(txt|TXT|jpg|JPG|jpeg|JPEG|gif|GIF|doc|DOC|docx|DOCX|pdf|PDF|png|PNG)$'")->where("file_name","like","%".request("search")."%")->  paginate(10);
        }else{
            $files= Directory:: paginate(1);
        }
      
       return view('directory/index',compact("files"));
       
    }
    public function create()
    {
        return view('directory/create');
    }

     /**
     * Save the files.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt,doc,docx,pdf,png,jpeg,jpg,gif',
        ]);
       
        $fileName = $request->file->extension().time().'.'.$request->file->extension();  
        //Storage::putFile('documents', $fileName);
        $request->file->move(public_path('documents'), $fileName);
    

        $file_data["file_name"] =     $fileName;
        $file_data["uuid"] =    DB::raw("uuid()");
        
        $file_data["url"] =   asset("documents/". $fileName) ;
        Directory::create( $file_data);
        return redirect()->route('index')
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
       
    }
    /**
     * Remove the file.
     *
     * @param  int  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directory $file)
    {
        $file->delete();
        return redirect()->route('index')
        ->with('success','You have successfully Deleted file.')
        ->with('file' ,$file->file_name);
    }
    

    public function filehistory()
    {
        if(request("search")!=""){
            $file_list= Directory:: whereRaw("file_name regexp '^.*\.(txt|TXT|jpg|JPG|jpeg|JPEG|gif|GIF|doc|DOC|docx|DOCX|pdf|PDF|png|PNG)$'")->where("file_name","like","%".request("search")."%")->onlyTrashed()->  paginate(10);
        }else{
            $file_list= Directory::onlyTrashed()->  paginate(10);
        }
      
       return view('directory/filehistory',compact("file_list"));
    }

}
