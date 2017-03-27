<?php

namespace GMC\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use GMC\Services\Facades\Audience as Audiences;
use Validator;
use GMC\Models\Upload as Uploads;

class Upload extends Controller {

    protected $path;

    public function __construct() {
        $this->path = public_path('fileUploads');
    }

    public function download() {
        Excel::create(\Carbon\Carbon::now(), function($excel) {
            $excel->setTitle('Activity Token');
            $excel->setCreator('GMC')->setCompany('Gramedia Majalah');
            $excel->setDescription('Audience sample upload format');

            $excel->sheet('ActivityToken', function($sheet) {

//                $sheet->row(1, function($row) {
//                    $row->setBackground('#000000');
//                });
//                $sheet->fromArray(Audiences::Question()->all()->pluck('questionId'));
                
                $layers = Audiences::Layer()->select('layerName')->with(['questions' => function($query) {
                                $query->orderBy('questionSort', 'ASC');
                            }, 'questions.master'])->get();


                dd($layers->toArray());
                $sheet->row(1, $layers->toArray());
                
                $sheet->row(2, $layers->questions);

//                $sheet->row(2, $layers->transform(function($item) {
//                    if(is_null($item->masterId) == false) :
//                        $subText = $item->master->masterFormat->where('form', true)->pluck('name');
//                        $item->merge($subText);
//                    endif;
//                    $isMandatory = $item->questionIsMandatory ? '(mandatory)' : null;
//                    return camel_case($item->questionText) . $isMandatory;
//                })->toArray());
//                $sheet->freezeFirstRow();
            });
        })->export('xls');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('vendor.materialAdmin.upload.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $ext;
        $request->merge(['uploadFilename' => $fileName]);
        $validator = Validator::make($request->all(), Uploads::rules());

        if ($validator->fails()) :
            return response()->json($validator->errors(), 422);
        endif;

        if ($request->file('file')->isValid()) :
            $request->file('file')->move($this->path, $fileName);
            $create = Uploads::create($request->all());
            return response()->json(['create' => $create], 200);
        endif;
    }

    public function upload() {
        foreach (Uploads::where('uploadIsExecuted', false)->pluck('uploadFilename') as $uploadFilename) :
            $readers = Excel::load($this->path . '/' . $uploadFilename)->all();
            Audiences::executeUploadedFile($readers);
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
    public function update(Request $request, $id) {
        $upload = Uploads::findOrFail($id);
        $update = $upload->update(['uploadIsExecuted' => true]);
        return response()->json(['update' => $update], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

}
