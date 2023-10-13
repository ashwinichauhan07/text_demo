<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\LicensePayment;
use App\Models\Total_payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use App\Notifications\RegisterNotify;
use App\Http\Controllers;
use Carbon\Carbon;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('AdminCheck');
    }

    public function index()
    {
        $totalInstitute = User::where('userType',2)->get();

        $totalStudent = User::where('userType',4)->get();
        //dd($totalStudent);
        $userData = User::with('roles')->where('userType','!=',1)->latest()->get();

        $instituteData = User::where('userType',2)->get();
        //dd($instituteData);

        $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('userType',2)
        ->groupBy('day_name','day')
        ->orderBy('day','desc')
        ->get();
        //dd($record);

        $data = [];
        foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }

        $data_count = 0;

        if (isset($data['data']) && !empty($data['data'])) {

            foreach ($data['data'] as $key => $data_value) {
            $data_count += $data_value;
            }

            $data['count'] = $data_count;

        }

       // data for pie char

        $data['total'] = ['institute','student'];

        $institute = User::where(['userType' => 2])->count();

        $student = User::where(['userType' => 4])->count();

        $data['total_count'] = [$institute,$student];


        $data['chart_data'] = json_encode($data);

        $instituteData = Institute::with('user')->get();

        $total_revenue = LicensePayment::all();
//        dd($total_revenue);

        $total_amount = 0;
        foreach ($total_revenue as $key => $total_value) {
            $total_amount += $total_value->amount;
        }
//dd($total_revenue);

        return view('admin.index',compact('instituteData', 'totalInstitute', 'totalStudent', 'userData','total_amount'),$data);
        // return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
