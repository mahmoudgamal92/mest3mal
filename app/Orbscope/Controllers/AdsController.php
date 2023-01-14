<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\AdsDataTable;
use App\Orbscope\DataTables\AuctionsDataTable;
use App\Orbscope\Models\Ad;
use App\Orbscope\Models\Auction;
use App\Orbscope\Models\Department;
use Illuminate\Http\Request;
use App\Orbscope\Models\Category;
use Validator;
use App\Orbscope\DataTables\CategorySub;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;
use App\Authorizable;

class AdsController extends Controller
{

    public function index(AdsDataTable $dataTable)
    {
        return $dataTable->render('admin.ads.index',['title' => trans('orbscope.show-all').' '.trans('front.ads')]);
    }

    public function auctions(AuctionsDataTable $dataTable){

        return $dataTable->render('admin.auctions.index',['title' => trans('orbscope.show-all').' '.trans('front.Auctions')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function status($id,$status){
        $ad=Ad::findOrFail($id);
        $ad->status=$status;
        $ad->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function delete_auction($id){
        $auct=Auction::findOrFail($id);
        $auct->delete();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
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
            'depart_id'    => 'required',



        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'depart_id'  =>trans('orbscope.department'),


        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {


            $country = new Category;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);
            $image                     = $request->file('flag');
            $uploaded                  = Upload::uploadImages('category', $image,'checkImages');

            if($uploaded == 'false'){
                return back()->withInput();
            }else{
                $country->image           = $uploaded;
            }
            $country->name             = $names;
            $country->depart_id           = $request->input('depart_id');
            if ($request->input('depart_id')==55){

                $country->type ='realstate';

            }elseif ($request->input('depart_id')==56){

                $country->type ='cars';
            }
            $country->status           = $request->input('status');
            $country->icon   = $request->input('icon');
            $country->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$country->id),
                    'type'   =>'add',
                    'table'  =>'categories',
                    'route'  =>LogRoute('category'),
                    'data'   =>'log.add_record'.' | '.'orbscope.categorys'.' | '.' log.record_number '.' | '.$country->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/category/');

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
        $category = Category::find($id);
        return view('admin.category.show',['show'=>$category,'title'=>trans('orbscope.show').' '.trans('orbscope.category').' : '.VarByLang($category->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Category::find($id);
        return view('admin.category.edit',['edit'=>$country,'title'=>trans('orbscope.edit').' '.trans('orbscope.category').' : '.VarByLang($country->name,GetLanguage()) ]);
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
            'depart_id'    => 'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'depart_id'  =>trans('orbscope.department'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $country = Category::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $country->name           = $names;
            $country->depart_id           = $request->input('depart_id');
            $country->status         = $request->input('status');
            $image                     = $request->file('flag');
            $uploaded                  = Upload::uploadImages('category', $image,'checkImages');

            if($uploaded == 'false'){
                return back()->withInput();
            }else{
                $country->image           = $uploaded;
            }
            $country->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/category');

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
        $country = Ad::find($id);
        $country->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/ads');
    }





}
