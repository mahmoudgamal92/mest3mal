<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\AgentType;
use App\Orbscope\Models\Country;
use App\Orbscope\Models\City;
use App\Orbscope\Models\LeadRequest;
use App\Orbscope\Models\State;
use App\Orbscope\Models\Service;
use App\Orbscope\Models\Developer;
use App\Orbscope\Models\Project;
use App\Orbscope\Models\Lead;
use App\Orbscope\Models\LeadSource;
use App\Orbscope\Models\Industry;
use App\Orbscope\Models\Campaign;
use App\Orbscope\Models\Call;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\GetAgentcallsDatatable;
use App\Orbscope\DataTables\GetAgentmettingsDatatable;
use App\Orbscope\DataTables\GetAgentrequestsDatatable;
use App\Orbscope\DataTables\GetAgentcilDatatable;
use App\Orbscope\DataTables\GetAgenttcrDatatable;
use App\Orbscope\DataTables\GetAgentcomplainsDatatable;
use App\Orbscope\DataTables\AgentsDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use Agents;
use Leads;
use Route;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class AgentsController extends Controller
{
    use Authorizable;
    /**
     * @param AgentsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(AgentsDataTable $dataTable)
    {
        return $dataTable->render('admin.agents.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.agents')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.agents.create',['title'=> trans('orbscope.add').' '.trans('orbscope.agents'), 'roles' => $roles]);
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
            $agents                 = new User();
            $agents->name           = $request->input('name');
            $agents->email          = $request->input('email');
            $agents->password       = bcrypt($request->input('password'));
            $agents->type           = 'agent';
            $main_image             = $request->file('main_image');
            if(!empty($main_image) && $main_image != ''){
                $uploaded_image               = Upload::uploadImages('agents', $main_image,'checkImages');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $agents->image       = $uploaded_image;
                }
            }
            $agents->save();

            $roles = $request['roles']; //Retrieving the roles field
            //Checking if a role was selected
            if (isset($roles)) {
                foreach ($roles as $role) {
                    $role_r = Role::where('id', '=', $role)->firstOrFail();
                    $agents->assignRole($role_r); //Assigning role to user
                }
            }

            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$agents->id),
                    'type'   =>'add',
                    'table'  =>'agents',
                    'route'  =>LogRoute('agents'),
                    'data'   =>'log.add_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();
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
        $agents             = User::find($id);
        return view('admin.agents.show',['show'=>$agents,'title'=>trans('orbscope.show').' '.trans('orbscope.agents').' : '.$agents->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = User::find($id);
        $roles = Role::get(); //Get all roles
        if ($agent) {
            $agentTypes = AgentType::all();
            return view('admin.agents.edit',[
                'title'=> trans('orbscope.edit').' '.trans('orbscope.agents'),
                'edit' => $agent,
                'agentTypes'=>$agentTypes,
                'roles'=>$roles,

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $agents = User::find($id);
        if ($agents) {
            $rules = [
                'name'         => 'required',
                'password'     => 'sometimes|nullable|min:6',
                'email'        => 'required|unique:users,email,'.$id.',id',
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'name'       =>trans('orbscope.name'),
                'email'      =>trans('orbscope.email'),
                'password'   =>trans('orbscope.password'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $agents->name           = $request->input('name');
            $agents->email          = $request->input('email');
            if ($request->input('password') != '') {
                $agents->password       = bcrypt($request->input('password'));
            }
            $agents->agent_type     = $request->input('agentType');
            if ($request->image != '') {
                if (! is_null($agents->image)) {
                    if (File::exists(public_path('uploads') . '/' . $agents->image)) {
                        unlink(public_path('uploads') . '/' . $agents->image);
                    }
                }
                $uploaded_image  = Upload::uploadImages('agents', $request->image,'checkImages');
                if($uploaded_image == 'false'){
                    return back()->withInput();
                }else{
                    $agents->image = $uploaded_image;
                }
            }
            $agents->save();

            $roles = $request['roles']; //Retreive all roles
            if (isset($roles)) {
                $agents->roles()->sync($roles);  //If one or more role is selected associate user to roles
            }
            else {
                $agents->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }

            Logs::SaveLog([
                'action' =>LogAction('add',$agents->id),
                'type'   =>'edit',
                'table'  =>'agents',
                'route'  =>LogRoute('agents'),
                'data'   =>'log.add_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

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
        $agents = User::find($id);
        $agents->delete();
        Logs::SaveLog([
            'action' =>LogAction('delete',$agents->id),
            'type'   =>'delete',
            'table'  =>'agents',
            'route'  =>LogRoute('agents'),
            'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/agents');
    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'agents',
                    'route'  =>LogRoute('agents'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            User::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agents');
        }
        else {
            $agents = User::find($data);
            $agents->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'agents',
                'route'  =>LogRoute('agents'),
                'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agents');
        }
    }



}
