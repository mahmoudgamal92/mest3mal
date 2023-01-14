<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\DepartmentDataTable;
use App\Orbscope\DataTables\OrdersDataTable;
use App\Orbscope\DataTables\PerantsDataTable;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\Order;
use App\Orbscope\Models\Parents_rate;
use Validator;
use Illuminate\Http\Request;
use Logs;
use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use Form;

use App\Authorizable;
class OrdersController extends Controller
{
    /**
     * @param departmentDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */

    //use Authorizable;
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.orders')]);
    }



    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.orders.show',['show'=>$order,'title'=>trans('orbscope.show').' '.trans('front.order_number').' : '.$order->order_number]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($department->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'department',
            'route'  =>LogRoute('department'),
            'data'   =>'log.delete_record'.' | '.'orbscope.department'.' | '.' log.record_number '.' | '.$department->id ,
        ]);
        $department->delete();
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/department');
    }







}
