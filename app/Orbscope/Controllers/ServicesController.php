<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\ServicesDataTable;
use App\Orbscope\Models\Service;
use Validator;
use Illuminate\Http\Request;

use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;
class ServicesController extends Controller
{

   

    public function index(ServicesDataTable $dataTable)
    {
        return $dataTable->render('admin.services.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.services')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create',['title'=> trans('orbscope.add').' '.trans('orbscope.service') ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'ar_name'    => 'required',
            'en_name'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $service = new Service;
            $name    = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names   = EncodeVar($name);
            $service->name           = $names;
            $service->status         = $request->input('status');
            $image                   = $request->file('image');
            $uploaded                = Upload::uploadImages('services', $image,'checkImages');
            if($uploaded == 'false'){
                return back()->withInput();
            }
            $service->image           = $uploaded;
            $service->save();
            Logs::SaveLog([
                'action' =>LogAction('add',$service->id),
                'type'   =>'add',
                'table'  =>'services',
                'route'  =>LogRoute('services'),
                'data'   =>'log.add_record'.' | '.'orbscope.services'.' | '.' log.record_number '.' | '.$service->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/services/'.$service->id);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('admin.services.show',['show'=>$service,'title'=>trans('orbscope.show').' '.trans('orbscope.service').' : '.VarByLang($service->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.services.edit',['edit'=>$service,'title'=>trans('orbscope.edit').' '.trans('orbscope.services').' : '.VarByLang($service->name,GetLanguage()) ]);
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
        $rules = [
            'ar_name'    => 'required',
            'en_name'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $service = Service::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $service->name           = $names;
            $service->status         = $request->input('status');
            if($request->hasFile('image')){
                $image                   = $request->file('image');
                $uploaded                = Upload::uploadImages('services', $image,'checkImages');
                if($uploaded == 'false'){
                    return back()->withInput();
                }else{
                    @unlink('uploads/'.$service->image);
                    $service->image     = $uploaded;
                }
            }

            $service->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/services/'.$id);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$service->id),
            'type'   =>'delete',
            'table'  =>'services',
            'route'  =>LogRoute('services'),
            'data'   =>'log.delete_record'.' | '.'orbscope.services'.' | '.' log.record_number '.' | '.$service->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/services');
    }

    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $service   = Service::find($record);
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'services',
                    'route'  =>LogRoute('services'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.services'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Service::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/services');
        }
        else {
            $services = Service::find($data);
            $services->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'services',
                'route'  =>LogRoute('services'),
                'data'   =>'log.delete_record'.' | '.'orbscope.services'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/services');
        }
    }


    /**
     * Upload Excel File
     */
    public function upload()
    {
        return view('admin.services.upload',['title'=>trans('orbscope.upload-file').' : '.trans('orbscope.services')]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Select Options
     */
    public function upload_data(Request $request)
    {

        if($request->hasFile('import_file')){
            $path       = $request->file('import_file');
            $header     = $request->input('has_header');
            $encoding   = $request->input('encoding');
            $duplicate  = $request->input('duplicate_record');
            $delimiter  = $request->input('delimiter');

            // Check CSV Extention
            if(!checkFiles($path->getClientOriginalName())){
                session()->flash('error',trans('orbscope.select_file') ." " .trans('orbscope.type_csv'));
                return redirect()->back();
            }

            // Delimiter Value
            if(empty($delimiter)){
                $delimiter = ',';
            }else{
                $delimiter  = $request->input('delimiter');
            }


            // Get CSV Data
            $getData  = GetExcelData($path,$delimiter,$encoding,$header,$duplicate);


            // Check If File Have Data (With and Without Header)
            if(count($getData) > 0){
                $headers  = GetExcelHeader($path,$delimiter,$encoding,$header);
                $rows     = GetExcelFirst($path,$delimiter,$encoding);
                session()->forget('data');
                $fileData = Session::put('data', $getData);
                return view('admin.services.upload_data',['headers'=>$headers,'has_header'=>$header,'row'=>$rows,'data'=>$fileData,'title'=>trans('orbscope.upload-file').' : '.trans('orbscope.services')]);
            }else{
                return back()->with('error',trans('orbscope.nothing_data'));
            }
        }else{
            return back()->with('error',trans('orbscope.select-file-error'));
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_excel(Request $request)
    {
        $count = 0;
        $data   = Session::get('data');
        $fields = $request->input('feilds');
        $number_column       = [];
        $validation_message  = [];
        $names               = [];
        $insert = ReplaceArrayKeys($data, $fields);
        for ($i = 0; $i < count($insert); $i++) {
            $query[] = $insert[$i];
        }


        foreach ($query as $key => $database) {
            $rules = [
                'ar'         => 'required',
                'en'         => 'required',
            ];


            $validator = Validator::make($database, $rules);

            $validator->SetAttributeNames([
                'ar'   =>trans('orbscope.ar-name'),
                'en'   =>trans('orbscope.en-name'),
            ]);

            if ($validator->fails()) {
                $number_column[] = $key + 1;
                $validation_message[] = $validator->messages()->toJson(JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);;

            } else {
                $name = array('ar' => $database['ar'],'en' => $database['en']);
                $names[]         = EncodeVar($name);
                $status[]        = InArray('status',$database,'inactive',['active','inactive']);
            }
        }

        $messages      = $validator->errors()->add('column', $number_column)->toArray();
        $messagesArray = $validator->errors()->add('messages', $validation_message)->toArray();



        for($i=0;$i<count($names);$i++){
            $service = new Service();
            $service->name           = $names[$i];
            $service->status         = $status[$i];
            $service->save();

            Logs::SaveLog([
                'action' =>LogAction('add',$service->id),
                'type'   =>'add',
                'table'  =>'services',
                'route'  =>LogRoute('services'),
                'data'   =>'log.add_record'.' | '.'orbscope.services'.' | '.' log.record_number '.' | '.$service->id ,
            ]);
            $count++;
        }



        if($count>0){
            session()->forget('data');
            session()->flash('success',trans('orbscope.added-message').' : '.$count);
            return redirect(AdminPath().'/services/')->with('data_error',$messagesArray)->with('column',$messages);
        }else{
            session()->flash('error',trans('orbscope.nothing_data'));
            return redirect(AdminPath().'/services/upload')->with('data_error',$messagesArray)->with('column',$messages);
        }

    }


}
