<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\ServicesDataTable;
use App\Orbscope\Models\Category;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\Shop;
use App\Orbscope\Models\Subject;
use Illuminate\Http\Request;
use App\Orbscope\Models\Supplier;
use App\Orbscope\Models\SubCategory;
use Validator;
use App\Orbscope\DataTables\SubCategoryDataTable;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class SubcategoryController extends Controller
{

    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub_category.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.sub_category')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = Department::where('status','active')->get();
        return view('admin.sub_category.create',['title'=> trans('orbscope.add').' '.trans('orbscope.sub_category'),'shop'=>$shop]);
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
            'shop_id'    =>'required',
            'cat_id'      =>'required',


        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'shop_id' =>trans('orbscope.shop'),
            'cat_id' =>trans('orbscope.category'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $sub = new SubCategory;
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $sub->name           = $names;
            $sub->depart_id	       = $request->input('shop_id');
            $sub->cat_id	       = $request->input('cat_id');
            $sub->status         = $request->input('status');
            $image                     = $request->file('flag');
            $uploaded                  = Upload::uploadImages('sub_category', $image,'checkImages');

            if($uploaded == 'false'){
                return back()->withInput();
            }else{
                $sub->image           = $uploaded;
            }
            $sub->save();
            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$sub->id),
                    'type'   =>'add',
                    'table'  =>'sub_categories',
                    'route'  =>LogRoute('sub_category'),
                    'data'   =>'log.add_record'.' | '.'orbscope.sub_categorys'.' | '.' log.record_number '.' | '.$sub->id ,
                ]
            );

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/sub_category/'.$sub->id);

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
        $sub_category = SubCategory::find($id);
        return view('admin.sub_category.show',['show'=>$sub_category,'title'=>trans('orbscope.show').' '.trans('orbscope.sub_category').' : '.VarByLang($sub_category->name,GetLanguage())]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub = SubCategory::find($id);
        $shop= Department::where('status','active')->get();
        $category= Category::where('status','active')->get();
        return view('admin.sub_category.edit',['edit'=>$sub,'shop'=>$shop,'category'=>$category,'title'=>trans('orbscope.edit').' '.trans('orbscope.sub_category').' : '.VarByLang($sub->name,GetLanguage()) ]);
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
            'cat_id'     =>'required',
            'shop_id'     =>'required',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'ar_name'  =>trans('orbscope.ar-name'),
            'en_name'  =>trans('orbscope.en-name'),
            'cat_id'  =>trans('orbscope.category'),
            'shop_id'  =>trans('orbscope.shop'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $sub = SubCategory::find($id);
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = EncodeVar($name);

            $sub->name           = $names;
            $sub->depart_id	       = $request->input('shop_id');
            $sub->cat_id	       = $request->input('cat_id');
            $sub->status         = $request->input('status');
            if ($request->file('flag')) {
                $image                     = $request->file('flag');
                $uploaded                  = Upload::uploadImages('sub_category', $image,'checkImages');

                if($uploaded == 'false'){
                    return back()->withInput();
                }else{
                    @unlink('uploads/'.$sub->image);
                    $sub->image           = $uploaded;
                }
            }
            $sub->save();
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/sub_category/'.$id);

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
        $sub = SubCategory::find($id);
        @unlink('uploads/'.$sub->image);
        $sub->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$sub->id),
            'type'   =>'delete',
            'table'  =>'sub_categories',
            'route'  =>LogRoute('sub_category'),
            'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$sub->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/sub_category');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $record){
                $sub   = SubCategory::find($record);
                @unlink('uploads/'.$sub->image);

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'sub_categories',
                    'route'  =>LogRoute('sub_category'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            SubCategory::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/sub_category');
        }
        else {
            $sub_category = SubCategory::find($data);
            @unlink('uploads/'.$sub_category->image);
            $sub_category->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'sub_categories',
                'route'  =>LogRoute('sub_category'),
                'data'   =>'log.delete_record'.' | '.'orbscope.sub_category'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/sub_category');
        }
    }





    public function subcat_ajax(Request $request){
        $data=Category::where('depart_id',$request->shop)->where('status','active')->get();
        return view('admin.sub_category.cats',['data'=>$data]);
    }
}
