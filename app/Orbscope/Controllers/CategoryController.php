<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\CategoryDataTable;
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

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.categorys')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = Department::where('status','active')->get();
        return view('admin.category.create',['title'=> trans('orbscope.add').' '.trans('orbscope.category'),'shop'=>$shop]);
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
        $country = Category::find($id);
        @unlink('uploads/'.$country->image);
        $country->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$country->id),
            'type'   =>'delete',
            'table'  =>'category',
            'route'  =>LogRoute('category'),
            'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$country->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/category');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $country   = Category::find($record);
                @unlink('uploads/'.$country->image);

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'category',
                    'route'  =>LogRoute('category'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Category::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/category');
        }
        else {
            $category = Category::find($data);
            @unlink('uploads/'.$category->image);
            $category->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'category',
                'route'  =>LogRoute('category'),
                'data'   =>'log.delete_record'.' | '.'orbscope.category'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/category');
        }
    }





    public function get_Subcategory($id,CategorySub $dataTable){
        $leads       = Category::find($id);
        return $dataTable->LeadID($id)->render('admin.category.requests',['title'=>trans('orbscope.show').' '.trans('orbscope.category').' : '.VarByLang($leads->name,GetLanguage()),'show'=>$leads]);

    }
    public function get_product($id,CategoryProduct $dataTable){
        $leads       = Category::find($id);
        return $dataTable->LeadID($id)->render('admin.category.requests',['title'=>trans('orbscope.show').' '.trans('orbscope.category').' : '.VarByLang($leads->name,GetLanguage()),'show'=>$leads]);

    }



}
