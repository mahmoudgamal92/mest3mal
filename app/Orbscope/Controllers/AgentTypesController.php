<?php

namespace App\Orbscope\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\Models\AgentType;
use App\Orbscope\DataTables\AgentTypesDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Excel;
use Alert;
use Session;
use Logs;
use Lang;
use App\Authorizable;

class AgentTypesController extends Controller
{
    use Authorizable;
    /**
     * @param AgentTypesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(AgentTypesDataTable $dataTable)
    {
        return $dataTable->render('admin.agentTypes.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.agentTypes')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agentTypes.create',['title'=> trans('orbscope.add').' '.trans('orbscope.agentTypes')]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $rules = [
            'ar_name'    => 'required',
            'en_name'    => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name')
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $agentTypes = new AgentType();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);
            $agentTypes->name           = $names;
            $agentTypes->description    = $request->input('description');
            $agentTypes->save();

            Logs::SaveLog(
                [
                'action' =>LogAction('add',$agentTypes->id),
                'type'   =>'add',
                'table'  =>'agentTypes',
                'route'  =>LogRoute('agentTypes'),
                'data'   =>'log.add_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$agentTypes->id ,
                ]
            );

            session()->flash('success',trans('orbscope.added-message'));
            return redirect(AdminPath().'/agentTypes/'.$agentTypes->id);
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
        $agentTypes = AgentType::find($id);
        return view('admin.agentTypes.show',['show'=>$agentTypes,'title'=>trans('orbscope.show').' '.trans('orbscope.agentTypes').' : '.VarByLang($agentTypes->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agentTypes = AgentType::find($id);
        return view('admin.agentTypes.edit',['edit'=>$agentTypes,'title'=>trans('orbscope.edit').' '.trans('orbscope.agentTypes').' : '.VarByLang($agentTypes->name,GetLanguage()) ]);
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
            'ar_name'=>'required',
            'en_name'=>'required',
        ];

        $Validator = Validator::make($request->all(),$rules);

        $Validator->SetAttributeNames([
            'ar_name'=>trans('orbscope.ar-name'),
            'en_name'=>trans('orbscope.en-name'),
        ]);

        if($Validator->fails())
        {
            return back()->withInput()->withErrors($Validator);
        }else{
            $agentTypes = AgentType::find($id);;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);
            $agentTypes->name       = $names;
            $agentTypes->description    = $request->input('description');
            $agentTypes->save();
            Logs::SaveLog([
                'action' =>LogAction('edit',$agentTypes->id),
                'type'   =>'edit',
                'table'  =>'agentTypes',
                'route'  =>LogRoute('agentTypes'),
                'data'   =>'log.edit_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$agentTypes->id ,
            ]);
            session()->flash('success',trans('orbscope.updated'));
            return redirect(AdminPath().'/agentTypes/'.$agentTypes->id);
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
        $agentTypes = AgentType::find($id);
        $agentTypes->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$agentTypes->id),
            'type'   =>'delete',
            'table'  =>'agentTypes',
            'route'  =>LogRoute('agentTypes'),
            'data'   =>'log.delete_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$agentTypes->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/agentTypes');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Multi Delete
     */
    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            AgentType::destroy($data);
            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'agentTypes',
                    'route'  =>LogRoute('agentTypes'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agentTypes');
        }
        else {
            $agentTypes = AgentType::find($data);
            $agentTypes->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'agentTypes',
                'route'  =>LogRoute('agentTypes'),
                'data'   =>'log.delete_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agentTypes');
        }
    }

    /**
     * Upload Excel File
     */
    public function upload()
    {
        if (!auth()->user()->hasPermissionTo('Add Agent Type') && auth()->user()->type != 'admin' ) {
            return abort(404);
        }
        return view('admin.agentTypes.upload',['title'=>trans('orbscope.upload-file').' : '.trans('orbscope.agentTypes')]);
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
                return view('admin.agentTypes.upload_data',['headers'=>$headers,'has_header'=>$header,'row'=>$rows,'data'=>$fileData,'title'=>trans('orbscope.upload-file').' : '.trans('orbscope.agentTypes')]);
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
                'ar' => 'required',
                'en' => 'required'
            ];


            $validator = Validator::make($database, $rules);
            $validator->SetAttributeNames([
                'ar' => trans('orbscope.ar-name'),
                'en' => trans('orbscope.en-name')
            ]);

            if ($validator->fails()) {
                $number_column[] = $key + 1;
                $validation_message[] = $validator->messages()->toJson(JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);;

            } else {
                $name = array('ar' => $database['ar'],'en' => $database['en']);
                $names[]     = EncodeVar($name);
                if(array_key_exists('description',$database)) {
                    $description[] = $database['description'];

                }else {
                    $description[] = '';
                }
            }
        }

        $messages      = $validator->errors()->add('column', $number_column)->toArray();
        $messagesArray = $validator->errors()->add('messages', $validation_message)->toArray();

        for($i=0;$i<count($names);$i++){
            $agentTypes = new AgentType();
            $agentTypes->name = $names[$i];
            $agentTypes->description    = $description[$i];
            $agentTypes->save();

            Logs::SaveLog([
                'action' =>LogAction('add',$agentTypes->id),
                'type'   =>'add',
                'table'  =>'agentTypes',
                'route'  =>LogRoute('agentTypes'),
                'data'   =>'log.add_record'.' | '.'orbscope.agentTypes'.' | '.' log.record_number '.' | '.$agentTypes->id ,
            ]);
            $count++;
        }



        if($count>0){
            session()->forget('data');
            session()->flash('success',trans('orbscope.added-message').' : '.$count);
            return redirect(AdminPath().'/agentTypes/')->with('data_error',$messagesArray)->with('column',$messages);
        }else{
            session()->flash('error',trans('orbscope.nothing_data'));
            return redirect(AdminPath().'/agentTypes/upload')->with('data_error',$messagesArray)->with('column',$messages);
        }

    }


}
