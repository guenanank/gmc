<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Upload;
use App\Question;
use App\Activity;

class UploadController extends Controller 
{
    protected $path;
    protected $audience;


    public function __construct(AudienceRepository $audienceRepository) 
    {
        $this->path = public_path('fileUpload');
        $this->audience = $audienceRepository;
    }
    
    public function download()
    {
        Excel::create('Activity Name', function($excel) {
            $excel->setTitle('Activity Name');
            $excel->setCreator('GMC')->setCompany('Gramedia Majalah');
            $excel->setDescription('Audience sample upload format');
            
            $excel->sheet('ActivityToken', function($sheet) {
                $questions = Question::all();
                $sheet->fromArray($questions->pluck('questionText')->map(function($item) {
                    return camel_case($item);
                })->toArray());
                
                for($alpha = 'A', $i = 0; $i < $questions->count(); $i++, $alpha++) :
                    $question = $questions->get($i);
                    if($question->questionIsMandatory) :
                        $sheet->cell($alpha . '1', function($cell) {
                            $cell->setFontColor('#ff0000');
                        });
                    endif;
                endfor;
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
        dd($this->audience);
        foreach (Upload::where('uploadIsExecuted', false)->pluck('uploadFilename') as $uploadFilename) :
            $reader = Excel::load($this->path . '/' . $uploadFilename)->get();
            $activity = Activity::where('activityToken', $reader->getTitle())->firstOrFail();
            dd($activity);
            
        endforeach;
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