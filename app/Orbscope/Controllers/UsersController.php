<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\DataTables\BalancesDatatable;
use App\Orbscope\DataTables\DepositingDatatable;
use App\Orbscope\DataTables\WithdrawalsDatatable;
use App\Orbscope\DataTables\WithdrawalsRequestsDatatable;
use App\Orbscope\Models\Balance;
use App\Orbscope\Models\Withdrawal;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\UsersDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class UsersController extends Controller
{
    //use Authorizable;
    /**
     * @param usersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.users')]);
    }

    public function users_balance(BalancesDatatable $datatable){

        return $datatable->render('admin.users.balance',['title' => trans('orbscope.balances_users')]);

    }

    public function set_balance(Request $request){

       $balanc=Balance::find($request->balance_id);

       if (!empty($balanc)){


          $balanc->net =$request->amount;
          $balanc->save();

           session()->flash('success',trans('orbscope.success'));
           return redirect()->back();


       }else{

           session()->flash('error',trans('orbscope.error'));
           redirect()->back();
       }
    }


    public function depositing(DepositingDatatable $datatable){

        return $datatable->render('admin.users.depositing',['title'=>trans('orbscope.depositing')]);
    }


    public function withdrawals(WithdrawalsDatatable $datatable){

        return $datatable->render('admin.users.depositing',['title'=>trans('front.withdrawals')]);

    }

    public function withdrawals_requests(){

        return view('admin.users.withdrawals',['title'=>trans('orbscope.orders').' '.trans('front.withdrawals')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create',['title'=> trans('orbscope.add').' '.trans('orbscope.users'), 'roles' => $roles]);
    }

    public function withdrawals_done($id,$status){
      if($status=='done'){
          $with=Withdrawal::find($id);
          $with->status='done';
          $with->recived_date=date('Y-m-d h:i:s');
          $with->save();
          session()->flash('success',trans('orbscope.success'));
          return redirect()->back();
      }else{

          $with=Withdrawal::find($id);
          $with->acount_problem='yes';
          $with->save();
          session()->flash('success',trans('orbscope.success'));
          return redirect()->back();
      }

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
            'name'         => 'required',
            'password'     => 'required',
            'email'        => 'required|unique:users',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'       =>trans('orbscope.name'),
            'email'      =>trans('orbscope.email'),
            'password'   =>trans('orbscope.password'),
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $users                 = new User();
            $users->name           = $request->input('name');
            $users->email          = $request->input('email');
            $users->employee_id          = $request->input('employee_id');
            $users->password       = bcrypt($request->input('password'));
            $users->type           = 'agent';
            $users->active_date=date('Y-m-d');
            $users->save();

            $roles = $request['roles']; //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {
                foreach ($roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();
                    $users->assignRole($role_r); //Assigning role to user
                }
            }

            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$users->id),
                    'type'   =>'add',
                    'table'  =>'users',
                    'route'  =>LogRoute('users'),
                    'data'   =>'log.add_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$users->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/users');
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

       $show=User::find($id);

       return view('admin.users.show',compact('show'),['title'=>trans('orbscope.show').' '.trans('orbscope.user').' '.$show->name]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = User::find($id);
        if ($agent) {
            return view('admin.users.edit',[
                'title'=> trans('orbscope.edit').' '.trans('orbscope.user'),
                'edit' => $agent,

            ]);
        }
    }


    public function user_status($id,$status){
        $user=User::find($id);
        $user->status=$status;
        $user->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $users = User::find($id);
        if ($users) {
            $rules = [
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|unique:users,email,' . $id . ',id',

            ];
            $validator = Validator::make($request->all(), $rules);
            $validator->SetAttributeNames([
                'name' => trans('orbscope.name'),
                'email' => trans('orbscope.email'),
                'phone' => trans('orbscope.phone'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            } else {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                if (!empty($request->password) && $request->password!=null) {

                    $user->password = bcrypt($request->password);
                }
                $user->save();
                session()->flash('success', trans('orbscope.success'));
                return redirect()->back();

            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $users = User::find($id);
        $users->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$users->id),
            'type'   =>'delete',
            'table'  =>'users',
            'route'  =>LogRoute('users'),
            'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$users->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/users');
    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'users',
                    'route'  =>LogRoute('users'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            User::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/users');
        }
        else {
            $users = User::find($data);
            $users->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'users',
                'route'  =>LogRoute('users'),
                'data'   =>'log.delete_record'.' | '.'orbscope.users'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/users');
        }
    }


    public function rates($id){

        $user=User::find($id);

        return view('admin.users.rates',compact('user'),['title'=>trans('orbscope.rates').' '.trans('orbscope.user').' '.$user->name]);

    }

    public function download_cv($id){

        $file_path = public_path('uploads').'/cv_editor/'.$id;
        return response()->download($file_path);
    }




}
