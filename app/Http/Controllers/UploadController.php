<?php

namespace GMC\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use GMC\Services\Containers\AudienceContainer as AudienceRepository;
use Validator;
use GMC\Models\Upload;

class UploadController extends Controller 
{
    protected $path;
    protected $repo;

    public function __construct(AudienceRepository $repo) 
    {
        $this->repo = $repo;
        $this->path = public_path('fileUploads');
    }
    
    public function download()
    {        
        Excel::create(\Carbon\Carbon::now(), function($excel) {
            $excel->setTitle('Activity Name');
            $excel->setCreator('GMC')->setCompany('Gramedia Majalah');
            $excel->setDescription('Audience sample upload format');
            
            $excel->sheet('ActivityToken', function($sheet) {
                
                $sheet->fromArray(AudienceRepository::Question()->all()->pluck('questionId'));
                $sheet->row(1, function($row) {
                    $row->setBackground('#000000');
                });
                $sheet->row(2, AudienceRepository::Question()->all()->transform(function($item) {
                    $isMandatory = $item->questionIsMandatory ? '(mandatory)' : null;
                    return camel_case($item->questionText) . $isMandatory;
                })->toArray());
                
                $sheet->freezeFirstRow();
                
            });
        })->export('xls');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('upload.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $ext;
        $request->merge(['uploadFilename' => $fileName]);
        $validator = Validator::make($request->all(), Upload::$rules);
        
        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;
        
        if($request->file('file')->isValid()) :
            $request->file('file')->move($this->path, $fileName);
            $create = Upload::create($request->all());
            return response()->json(['create' => $create], 200);
        endif;
    }

    public function upload()
    {
        foreach (Upload::where('uploadIsExecuted', false)->pluck('uploadFilename') as $uploadFilename) :
            $readers = Excel::load($this->path . '/' . $uploadFilename)->all();
            AudienceRepository::executeUploadedFile($readers);
        endforeach;
        
        dd('upload');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $upload = Upload::findOrFail($id);
        $update = $upload->update(['uploadIsExecuted' => true]);
        return response()->json(['update' => $update], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        
    }
    
}