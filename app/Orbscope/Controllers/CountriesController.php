<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Country;
use App\Orbscope\Models\Currency;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\CountriesDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;


class CountriesController extends Controller
{



    /**
     * @param CountriesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('admin.countries.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.countries')]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.countries.create',[
            'title'         => trans('orbscope.add').' '.trans('orbscope.country'),
        ]);
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
            'status'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $country = new Country;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $country->name           = $names;
            $country->iso_code       = $request->input('iso');

            $country->status         = $request->input('status');
            $country->show_website   = $request->input('show_website');

            $image                     = $request->file('flag');
            $uploaded                  = Upload::uploadImages('countries', $image,'checkImages');

            if($uploaded == 'false'){
                return back()->withInput();
            }else{
                $country->flag           = $uploaded;
            }

            $country->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$country->id),
                    'type'   =>'add',
                    'table'  =>'countries',
                    'route'  =>LogRoute('countries'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$country->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/countries/'.$country->id);

        }
    }

    public function addNewCountry(Request $request)
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
            $errors =  json_decode($validator->errors());

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);

        } else {
            $country = new Country;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $country->name           = $names;
            $country->iso_code       = $request->input('iso');
            $country->currency       = $request->input('currency_id');
            $country->code           = $request->input('code');

            $country->status         = $request->input('status');
            $country->show_website   = $request->input('show_website');

            $image                     = $request->file('flag');
            if (!empty($image)){
                $uploaded                  = Upload::uploadImages('countries', $image,'checkImages');

            }

            $country->save();

            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$country->id),
                    'type'   =>'add',
                    'table'  =>'countries',
                    'route'  =>LogRoute('countries'),
                    'data'   =>'log.add_record'.' | '.'orbscope.counties'.' | '.' log.record_number '.' | '.$country->id ,
                ]
            );


            $itemId     = $country->id;
            $itemName   = VarByLang($country->name, GetLanguage());

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
        $countries = Country::find($id);
        return view('admin.countries.show',['show'=>$countries,'title'=>trans('orbscope.show').' '.trans('orbscope.countries').' : '.VarByLang($countries->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.countries.edit',[
            'edit' => $country,
            'title' => trans('orbscope.edit').' '.trans('orbscope.countries').' : '.VarByLang($country->name,GetLanguage()),

        ]);
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
            $country = Country::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $country->name           = $names;
            $country->status         = $request->input('status');
            $country->show_website   = $request->input('show_website');
            if($request->hasFile('flag')){
                $image = $request->file('flag');
                $uploaded                  = Upload::uploadImages('countries', $image,'checkImages');

                if($uploaded == 'false'){
                    return back()->withInput();
                }else{
                    @unlink('uploads/'.$country->flag);
                    $country->flag           = $uploaded;
                }
            }
            $country->save();


            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/countries/'.$id);

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
        $country = Country::find($id);
        @unlink('uploads/'.$country->flag);
        @$country->city()->delete();
        $country->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$country->id),
            'type'   =>'delete',
            'table'  =>'countries',
            'route'  =>LogRoute('countries'),
            'data'   =>'log.delete_record'.' | '.'orbscope.countries'.' | '.' log.record_number '.' | '.$country->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/countries');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $country   = Country::find($record);
                @unlink('uploads/'.$country->flag);
                @$country->city()->delete();
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'countries',
                    'route'  =>LogRoute('countries'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.countries'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Country::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/countries');
        }
        else {
            $countries = Country::find($data);
            @unlink('uploads/'.$countries->flag);
            @$countries->city()->delete();
            $countries->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'countries',
                'route'  =>LogRoute('countries'),
                'data'   =>'log.delete_record'.' | '.'orbscope.countries'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/countries');
        }
    }


    /**
     * Upload Excel File
     */


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Select Options
     */



    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */











}
