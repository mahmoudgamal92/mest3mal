<?php

namespace App\Orbscope\Controllers;
use App\Http\Middleware\Admin;
use App\Orbscope\DataTables\OrdersDataTable;
use App\Orbscope\DataTables\ProjectDataTable;
use App\Orbscope\DataTables\ServicesDataTable;
use App\Orbscope\Models\Project;
use App\Orbscope\Models\Setting;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use App\Orbscope\Models\Target;
use App\Orbscope\Models\Unit;
use App\Orbscope\Models\Call;
use App\Orbscope\Models\Lead;
use App\Orbscope\Models\Group;
class AdminController extends Controller
{
    // Admin Login Page
    public function Login()
    {

        return view(AdminTheme().'.login');
    }

    public function projects($status,ProjectDataTable $dataTable){

        return $dataTable->LeadID($status)->render('admin.projects.index',['title'=>trans('orbscope.projects')]);
    }
    public function orders($status,OrdersDataTable $dataTable){

        return $dataTable->LeadID($status)->render('admin.projects.index',['title'=>trans('orbscope.orders')]);
    }

    public function services(ServicesDataTable $dataTable){

        return $dataTable->render('admin.projects.index',['title'=>trans('orbscope.services')]);

    }




    // Admin Login Request
    public function Login_Request(Request $request)
    {
        $rules = ['email'=>'required|email','password'=>'required'];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames(['email'=>trans('orbscope.email'),'password'=>trans('orbscope.password')]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            if(auth()->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],$request->input('remember'))) {

                 if (auth()->user()->status=='inactive'){
                     return back();
                 }
                return redirect(GetSettings()->admin_path);
            } else {
                session()->flash('error',trans('orbscope.fails_login'));
                return back()->withInput()->withErrors($validator);
            }
        }
    }

    // Admin Logout
    public function Logout()
    {
        auth()->logout();
        return redirect(GetSettings()->admin_path.'/login');
    }

    // Forget Password
    public function Forget_Password()
    {
        return view(AdminTheme().'.forget');
    }

    // Admin Index
    public function Index()
    {


        return view('admin.home.index',[
            'title'=>VarByLang(GetSettings()->name,GetLanguage()),
            'edit'  => Setting::orderBy('id','desc')->first(),
            ]);


    }

    public function teamLeaderIndex()
    {
        // set start point foreach var to avoid erros those vars will be used at the loop
        $calls           = 0;
        $leads           = 0;
        $meetings        = 0;
        $deals           = 0;
        $units           = 0;
        $money           = 0;
        // target
        $number_calls    = 0;
        $number_leads    = 0;
        $number_meetings = 0;
        $number_deals    = 0;
        $number_units    = 0;
        $amount_money    = 0;

        $g = Group::where('team_leader', auth()->user()->id)->first();
        if ($g) {
            $membersIds = explode('|', $g->members);
            $members = User::whereIn('id', $membersIds)->get();
            if ($members) {
                if (count($members) > 0) {
                    $agentTypes = [];
                    foreach ($members as $member) {
                        $agentTypes[] = $member->agent_types()->pluck('id')->first();
                    }
                    $agentTypes = array_unique($agentTypes);
                    $targets = Target::whereIn('agent_type', $agentTypes)->orderBy('id', 'DESC')->get();
                    if ($targets) {
                        if (count($targets) > 0) {
                            $teamMembers = [];
                            for ($i=0; $i < count($targets); $i++) {
                                if ($i + 1 <= count($members)) {
                                    $calls    += $members[$i]->calls()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count();
                                    $leads    += Lead::whereIn('id', array_unique($members[$i]->calls()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->pluck('lead_id')->toArray()))->count();
                                    $meetings += $members[$i]->meetings()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count();
                                    $deals    += $members[$i]->orders()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count();
                                    $units    += Unit::whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count();
                                    $money    += $members[$i]->orders()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->sum('price');
                                    $teamMembers[$i] = [
                                        'id'       => $members[$i]->id,
                                        'name'     => $members[$i]->name,
                                        'calls'    => $members[$i]->calls()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count(),
                                        'leads'    => Lead::whereIn('id', array_unique($members[$i]->calls()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->pluck('lead_id')->toArray()))->count(),
                                        'meetings' => $members[$i]->meetings()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count(),
                                        'deals'    => $members[$i]->orders()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count(),
                                        'units'    => Unit::whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->count(),
                                        'money'    => $members[$i]->orders()->whereBetween('created_at', [$targets[$i]->from_date, $targets[$i]->to_date])->sum('price'),
                                    ];
                                }
                                // target
                                $number_calls     += $targets[$i]->number_calls;
                                $number_leads     += $targets[$i]->number_leads;
                                $number_meetings  += $targets[$i]->number_meetings;
                                $number_deals     += $targets[$i]->number_deals;
                                $number_units     += $targets[$i]->number_units;
                                $amount_money     += $targets[$i]->amount_money;
                            }
                            return view('admin.home.index',[
                                'title'=>trans('orbscope.teamleader-index'),
                                'calls'             => $calls,
                                'leads'             => $leads,
                                'meetings'          => $meetings,
                                'deals'             => $deals,
                                'leads'             => $leads,
                                'units'             => $units,
                                'money'             => $money,
                                // target
                                'number_calls'      => $number_calls,
                                'number_leads'      => $number_leads, // الي عملهم خلال الي الفتره دي بشرط يكون كلمهم
                                'number_meetings'   => $number_meetings,
                                'number_deals'      => $number_deals, // orders during target time
                                'number_units'      => $number_units,
                                'amount_money'      => $amount_money, // orders money
                                'teamMembers'       => $teamMembers,
                                'membersTable'      => true,
                                'isTeamLeader'      => Group::where('team_leader', auth()->user()->id)->first() ? true : false,
                            ]);
                        }
                    }
                }
            }
            return view('admin.home.index',[
                'title'=>trans('orbscope.teamleader-index'),
                'calls'             => $calls,
                'leads'             => $leads,
                'meetings'          => $meetings,
                'deals'             => $deals,
                'leads'             => $leads,
                'units'             => $units,
                'money'             => $money,
                // target
                'number_calls'      => $number_calls,
                'number_leads'      => $number_leads, // الي عملهم خلال الي الفتره دي بشرط يكون كلمهم
                'number_meetings'   => $number_meetings,
                'number_deals'      => $number_deals, // orders during target time
                'number_units'      => $number_units,
                'amount_money'      => $amount_money, // orders money
                'teamMembers'       => [],
                'membersTable'      => true,
                'isTeamLeader'      => Group::where('team_leader', auth()->user()->id)->first() ? true : false,
            ]);
        }
        return redirect()->back();
    }



}
