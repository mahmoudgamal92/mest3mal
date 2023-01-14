<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\City;
use App\Orbscope\Models\Country;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CitiesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use App\Authorizable;
use Session;

class CitiesController extends Controller
{



    /**
     * @param CitiesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.cities.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.cities')]);
    }

    public function addNewCityForm()
    {
        $country = Country::where('status','active')->get();
        return view('admin.cities.newForm', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Country = Country::where('status','active')->get();
        return view('admin.cities.create',['title'=> trans('orbscope.add').' '.trans('orbscope.cities'),'country'=>$Country]);
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
            'country_id'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'country_id'  =>trans('orbscope.country'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $city = new City;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $city->name           = $names;
            $city->status         = $request->input('status');
            $city->show_website   = $request->input('show_website');
            $city->country_id     = $request->input('country_id');

            if(!empty($request->input('latitude'))){
                $lat = $request->input('latitude');
            }else {
                $lat = '30.0444196';
            }

            if(!empty($request->input('longitude'))){
                $lang = $request->input('longitude');
            }else {
                $lang = '31.23571160000006';
            }

            if(!empty($request->input('zoom'))){
                $zoom = $request->input('zoom');
            }else {
                $zoom = '6';
            }


            $city->latitude       = $lat;
            $city->longitude      = $lang;
            $city->zoom           = $zoom;



            $city->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$city->id),
                    'type'   =>'add',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$city->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/cities/'.$city->id);

        }
    }

    public function addNewCity(Request $request)
    {
        $rules = [
            'ar_name'    => 'required',
            'en_name'    => 'required',
            'country_id'    => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'country_id'  =>trans('orbscope.country'),
        ]);
        if ($validator->fails()) {
            $errors =  json_decode($validator->errors());

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        } else {
            $city = new City;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $city->name           = $names;
            $city->status         = $request->input('status');
            $city->show_website   = $request->input('show_website');
            $city->country_id     = $request->input('country_id');



            $city->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$city->id),
                    'type'   =>'add',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$city->id ,
                ]
            );

            $itemId     = $city->id;
            $itemName   = VarByLang($city->name, GetLanguage());

            return response()->json([
                'success'   => true,
                'itemId'    => $itemId,
                'itemName'  => $itemName,
                'message'   => trans('orbscope.success')
            ], 200);

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
        $cities = City::find($id);
        return view('admin.cities.show',['show'=>$cities,'title'=>trans('orbscope.show').' '.trans('orbscope.cities').' : '.VarByLang($cities->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::find($id);
        $Country = Country::where('status','active')->get();
        return view('admin.cities.edit',['edit'=>$cities,'title'=>trans('orbscope.edit').' '.trans('orbscope.cities').' : '.VarByLang($cities->name,GetLanguage()),'country' => $Country ]);
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
            'country_id'       => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'country_id'     =>trans('orbscope.country'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $city = City::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);

            $city->name           = $names;
            $city->name           = $names;
            $city->status         = $request->input('status');
            $city->show_website   = $request->input('show_website');
            $city->country_id     = $request->input('country_id');

            if(!empty($request->input('latitude'))){
                $lat = $request->input('latitude');
            }else {
                $lat = '30.0444196';
            }

            if(!empty($request->input('longitude'))){
                $lang = $request->input('longitude');
            }else {
                $lang = '31.23571160000006';
            }

            if(!empty($request->input('zoom'))){
                $zoom = $request->input('zoom');
            }else {
                $zoom = '6';
            }


            $city->latitude       = $lat;
            $city->longitude      = $lang;
            $city->zoom           = $zoom;

            $city->save();

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/cities/'.$id);

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
        $cities = City::find($id);
        @$cities->states()->delete();
        $cities->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$cities->id),
            'type'   =>'delete',
            'table'  =>'cities',
            'route'  =>LogRoute('cities'),
            'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$cities->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/cities');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                $cities = City::find($record);
                @$cities->states()->delete();
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'cities',
                    'route'  =>LogRoute('cities'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            City::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/cities');
        }
        else {
            $cities = City::find($data);
            @$cities->states()->delete();
            $cities->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'cities',
                'route'  =>LogRoute('cities'),
                'data'   =>'log.delete_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/cities');
        }
    }


    /**
     * Upload Excel File
     */
    public function upload()
    {
        return view('admin.cities.upload',['title'=>trans('orbscope.upload-file').' : '.trans('orbscope.cities')]);
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
            $country  = Country::where('status','active')->get();


            // Check If File Have Data (With and Without Header)
            if(count($getData) > 0){
                $headers  = GetExcelHeader($path,$delimiter,$encoding,$header);
                $rows     = GetExcelFirst($path,$delimiter,$encoding);
                session()->forget('data');
                $fileData = Session::put('data', $getData);
                return view('admin.cities.upload_data',['headers'=>$headers,'has_header'=>$header,'row'=>$rows,'data'=>$fileData,'title'=>trans('orbscope.upload-file').' : '.trans('orbscope.cities'),'country'=>$country]);
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
        $fields  = $request->input('feilds');
        $country = $request->input('country_id');

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
                $latitude[]      = InArray('latitude',$database,'30.0444196');
                $longitude[]     = InArray('longitude',$database,'31.23571160000006');
                $status[]        = InArray('status',$database,'inactive',['active','inactive']);
                $show_website[]  = InArray('show_website',$database,'hidden',['show','hidden']);
                $zoom[]          = intval(preg_replace('/[^0-9]+/', '', InArray('zoom',$database,'6')), 10);
            }
        }

        $messages      = $validator->errors()->add('column', $number_column)->toArray();
        $messagesArray = $validator->errors()->add('messages', $validation_message)->toArray();



        for($i=0;$i<count($names);$i++){
            $city = new City();
            $city->name           = $names[$i];
            $city->latitude       = $latitude[$i];
            $city->longitude      = $longitude[$i];
            $city->zoom           = $zoom[$i];
            $city->status         = $status[$i];
            $city->show_website   = $show_website[$i];
            $city->country_id     = $country;
            $city->save();

            Logs::SaveLog([
                'action' =>LogAction('add',$city->id),
                'type'   =>'add',
                'table'  =>'cities',
                'route'  =>LogRoute('cities'),
                'data'   =>'log.add_record'.' | '.'orbscope.cities'.' | '.' log.record_number '.' | '.$city->id ,
            ]);
            $count++;
        }



        if($count>0){
            session()->forget('data');
            session()->flash('success',trans('orbscope.added-message').' : '.$count);
            return redirect(AdminPath().'/cities/')->with('data_error',$messagesArray)->with('column',$messages);
        }else{
            session()->flash('error',trans('orbscope.nothing_data'));
            return redirect(AdminPath().'/cities/upload')->with('data_error',$messagesArray)->with('column',$messages);
        }

    }










}
