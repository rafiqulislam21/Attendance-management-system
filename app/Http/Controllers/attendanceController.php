<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Attendance;
use App\Models\Empoyee;
use App\Models\Supervisor;
use App\Models\Zone;
use App\User;


class attendanceController extends Controller
{
  public function index(){

    $totalEmployee = Empoyee::all()->count();
    $totalSupervisor = User::where('user_type','!=','Admin')->count();
    $totalZone = Zone::all()->count();

    return view('index', compact('totalEmployee','totalSupervisor','totalZone'));


  }

  public function attendance($admin_id){
    $employees = Empoyee::where('supervisor_id',$admin_id)->get()->toArray();
    return view('employee_attendance',compact('employees'));
  }

  public function attendanceEdit(){
    $today = date('d');
    $todayMonth = date('F');
    $todayYear = date('Y');

    $yesterday = date('d',strtotime("-1 days"));
    $yesterdayMonth = date('F',strtotime("-1 days"));
    $yesterdayYear = date('Y',strtotime("-1 days"));

    // print_r($yesterday.$yesterdayMonth.$yesterdayYear);die;
    $employees = Attendance::where('day',$today)->get()->toArray();
    $supervisors = User::where('user_type','!=','Admin')->get()->toArray();


    return view('employee_attendance_edit',compact('employees','supervisors'));
  }
  //new add
  public function attendanceEditBySup(Request $request){
    $today = date('d');
    $todayMonth = date('F');
    $todayYear = date('Y');

    $yesterday = date('d',strtotime("-1 days"));
    $yesterdayMonth = date('F',strtotime("-1 days"));
    $yesterdayYear = date('Y',strtotime("-1 days"));

    $user_id = $request->input('supervisor_id');
    $selectDay = $request->input('day');

    if ($selectDay=="Today") {
      $employees = Attendance::where('day',$today)->where('month',$todayMonth)->where('year',$todayYear)->where('supervisor_id',$user_id)->get()->toArray();
    }else{
      $employees = Attendance::where('day',$yesterday)->where('month',$yesterdayMonth)->where('year',$yesterdayYear)->where('supervisor_id',$user_id)->get()->toArray();
    }

    $supervisors = User::where('user_type','!=','Admin')->get()->toArray();

    if ($employees==null) {
      $test = "null";
    }else {
      $test = "data";
    }

    return view('employee_attendance_edit_by_supervisors',compact('employees','supervisors','test'));
  }

  public function attendancedetails(){
    $attendanceDetailsAll = Attendance::all()->toArray();
    $supervisors = User::where('user_type','!=','Admin')->get()->toArray();
     $attendanceDetails=[];
    $i=0;
    foreach ($attendanceDetailsAll as  $value) {
      $attendanceDetails[$i]['employee_id'] = $value['employee_id'];
      $attendanceDetails[$i]['employee_name'] = $value['employee_name'];
      $attendanceDetails[$i]["total_day"] = DB::table('_attendance')->count();
      $attendanceDetails[$i]['total_present_day'] = DB::table('_attendance')->where('status','present')->where('employee_id',$value['employee_id'])->count();
      $attendanceDetails[$i]['total_absent_day'] = DB::table('_attendance')->where('status','absent')->where('employee_id',$value['employee_id'])->count();
      $attendanceDetails[$i]['total_late_day'] = DB::table('_attendance')->where('status','late')->where('employee_id',$value['employee_id'])->count();

      $i++;
    }
    // echo "<pre>";
    // print_r($attendanceDetails);die;
    $status = '';

    return view('employee_attendance_details', compact('attendanceDetails','supervisors','status'));
  }
  //new added
  public function attendancedetailsForSupervisor($user_id){

    $status = '';

    return view('employee_attendance_details_for_supervisors', compact('status'));
  }

  public function attendancedetailsByDay(Request $request){
    $supervisors = User::where('user_type','!=','Admin')->get()->toArray();

    $day = $request->input('day_name');
    $month = $request->input('month_name');
    $year = $request->input('year_name');
    $supervisor_id = $request->input('supervisor_id');
    $attendanceDetailsAll;

    if ($day == 'all') {

      $attendanceDetailsAll = Attendance::select('employee_id','supervisor_id','employee_name','month','year')->where('month', $month)->where('year',$year)->where('supervisor_id',$supervisor_id)->distinct()->get()->toArray();

    }else {
      $attendanceDetailsAll= Attendance::where('day',$day)->where('month', $month)->where('year',$year)->where('supervisor_id',$supervisor_id)->get()->toArray();
    }

    if ($attendanceDetailsAll==null) {
        $status = 'Attendance was not taken that day!';
        return view('employee_attendance_details',compact('supervisors','status'));
        // return redirect()->route('attendancedetails')->with('warning', 'Attendance was not taken that day!');

    }else {
      $i=0;
      foreach ($attendanceDetailsAll as $value) {
        if ($day=="all") {
          $attendanceDetails[$i]['employee_id'] = $value['employee_id'];
          $attendanceDetails[$i]['employee_name'] = $value['employee_name'];
          $attendanceDetails[$i]["total_day"] = DB::table('_attendance')->where('month',$month)->where('supervisor_id',$supervisor_id)->distinct('day')->count('day');

          $attendanceDetails[$i]['employee_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count('comment');
          $attendanceDetails[$i]['employee_single_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->where('comment','!=',null)->get()->toArray();

          $attendanceDetails[$i]['total_present_day'] = DB::table('_attendance')->where('status','present')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_late_day'] = DB::table('_attendance')->where('status','late')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_absent_day'] = (int)($attendanceDetails[$i]['total_late_day']/3) + DB::table('_attendance')->where('status','absent')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();

          $attendanceDetails[$i]['total_late_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"late")->where('month',$month)->where('year',$year)->get()->toArray();
          $attendanceDetails[$i]['total_absent_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"absent")->where('month',$month)->where('year',$year)->get()->toArray();

          $attendanceDetails[$i]['total_present_percentage'] = (int)(($attendanceDetails[$i]['total_present_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_late_percentage'] =(int) (($attendanceDetails[$i]['total_late_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_absent_percentage'] = (int)(($attendanceDetails[$i]['total_absent_day']/$attendanceDetails[$i]["total_day"])*100);

          $i++;
        }else{
          $attendanceDetails[$i]['employee_id'] = $value['employee_id'];
          $attendanceDetails[$i]['employee_name'] = $value['employee_name'];
          $attendanceDetails[$i]['employee_comment'] = $value['comment'];
          $attendanceDetails[$i]['employee_single_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->where('comment','!=',null)->get()->toArray();

          $attendanceDetails[$i]["total_day"] = DB::table('_attendance')->where('day',$day)->where('supervisor_id',$supervisor_id)->distinct('day')->count('day');

          $attendanceDetails[$i]['total_present_day'] = DB::table('_attendance')->where('status','present')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_late_day'] = DB::table('_attendance')->where('status','late')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_absent_day'] = (int)($attendanceDetails[$i]['total_late_day']/3) + DB::table('_attendance')->where('status','absent')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();

          $attendanceDetails[$i]['total_late_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"late")->where('month',$month)->where('year',$year)->get()->toArray();
          $attendanceDetails[$i]['total_absent_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"absent")->where('month',$month)->where('year',$year)->get()->toArray();

          $attendanceDetails[$i]['total_present_percentage'] = (int)(($attendanceDetails[$i]['total_present_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_late_percentage'] = (int)(($attendanceDetails[$i]['total_late_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_absent_percentage'] =(int) (($attendanceDetails[$i]['total_absent_day']/$attendanceDetails[$i]["total_day"])*100);

          $i++;
        }

      }
      // echo "<pre>";
      // print_r($attendanceDetails);die;
      return view('employee_attendance_details_selected',compact('attendanceDetails', 'supervisors'));
    }

  }


  //new added

  public function attendancedetailsByDaySupervisor(Request $request,$user_id){
    $day = $request->input('day_name');
    $month = $request->input('month_name');
    $year = $request->input('year_name');
    $attendanceDetailsAll;
    // print_r("works");die;
    if ($day == 'all') {

      $attendanceDetailsAll = Attendance::select('employee_id','supervisor_id','employee_name','month','year')->where('month', $month)->where('year',$year)->where('supervisor_id',$user_id)->distinct()->get()->toArray();

    }else {
      $attendanceDetailsAll= Attendance::where('day',$day)->where('month', $month)->where('year',$year)->where('supervisor_id',$user_id)->get()->toArray();
    }

    if ($attendanceDetailsAll==null) {
      $status = 'Attendance was not taken that day!';
      return view('employee_attendance_details_for_supervisors',compact('status'));
    }else {
      $i=0;
      foreach ($attendanceDetailsAll as $value) {
        if ($day=="all") {
          $attendanceDetails[$i]['employee_id'] = $value['employee_id'];
          $attendanceDetails[$i]['employee_name'] = $value['employee_name'];

          $attendanceDetails[$i]['employee_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count('comment');
          $attendanceDetails[$i]['employee_single_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->where('comment','!=',null)->get()->toArray();

          $attendanceDetails[$i]["total_day"] = DB::table('_attendance')->where('month',$month)->where('supervisor_id',$user_id)->distinct('day')->count('day');

          $attendanceDetails[$i]['total_present_day'] = DB::table('_attendance')->where('status','present')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_late_day'] = DB::table('_attendance')->where('status','late')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_absent_day'] = (int)($attendanceDetails[$i]['total_late_day']/3) + DB::table('_attendance')->where('status','absent')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->count();

          $attendanceDetails[$i]['total_late_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"late")->where('month',$month)->where('year',$year)->get()->toArray();
          $attendanceDetails[$i]['total_absent_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"absent")->where('month',$month)->where('year',$year)->get()->toArray();

          $attendanceDetails[$i]['total_present_percentage'] =(int) (($attendanceDetails[$i]['total_present_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_late_percentage'] = (int)(($attendanceDetails[$i]['total_late_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_absent_percentage'] = (int)(($attendanceDetails[$i]['total_absent_day']/$attendanceDetails[$i]["total_day"])*100);

          $i++;
        }else{
          $attendanceDetails[$i]['employee_id'] = $value['employee_id'];
          $attendanceDetails[$i]['employee_name'] = $value['employee_name'];
          $attendanceDetails[$i]['employee_comment'] = $value['comment'];
          $attendanceDetails[$i]['employee_single_comment'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('month',$month)->where('year',$year)->where('comment','!=',null)->get()->toArray();

          $attendanceDetails[$i]["total_day"] = DB::table('_attendance')->where('day',$day)->where('supervisor_id',$user_id)->distinct('day')->count('day');

          $attendanceDetails[$i]['total_present_day'] = DB::table('_attendance')->where('status','present')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_late_day'] = DB::table('_attendance')->where('status','late')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();
          $attendanceDetails[$i]['total_absent_day'] = (int)($attendanceDetails[$i]['total_late_day']/3) + DB::table('_attendance')->where('status','absent')->where('employee_id',$value['employee_id'])->where('day',$day)->where('month',$month)->where('year',$year)->count();

          $attendanceDetails[$i]['total_late_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"late")->where('month',$month)->where('year',$year)->get()->toArray();
          $attendanceDetails[$i]['total_absent_day_date'] = DB::table('_attendance')->where('employee_id',$value['employee_id'])->where('status',"absent")->where('month',$month)->where('year',$year)->get()->toArray();

          $attendanceDetails[$i]['total_present_percentage'] = (int)(($attendanceDetails[$i]['total_present_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_late_percentage'] = (int)(($attendanceDetails[$i]['total_late_day']/$attendanceDetails[$i]["total_day"])*100);
          $attendanceDetails[$i]['total_absent_percentage'] =(int) (($attendanceDetails[$i]['total_absent_day']/$attendanceDetails[$i]["total_day"])*100);

          $i++;
        }

      }

      return view('employee_attendance_details_for_supervisors_selected',compact('attendanceDetails'));
    }


  }


  public function submitAttendance(Request $request, $user_id){
    $employeeIds = $request->input('employee_id');
    //print_r($employeeIds);
    $employeeNames = $request->input('employee_name');
    //print_r( $employeeNames);
    $values =$request->input('attendance_taking');
    $comment =$request->input('attendance_comment');

    $todays_attendance= Attendance::where('day',date('d'))->where('month', date('F'))->where('year',date('Y'))->where('supervisor_id',$user_id)->get()->toArray();
    if($todays_attendance!=null){
      return redirect()->route('attendance',$user_id)->with('warning', 'Attendance already submited for today!');
    }
    else{



      $length = sizeof($values);
      // print_r($length);die;
      for($i=0;$i<$length;$i++){
        // print_r($employeeIds[$i]);
        // print_r($employeeNames[$i]);
        // print_r($values[$i]);
        // print_r(date('d'));
        // echo"<br>";
        date_default_timezone_set("Asia/Dhaka");
        $attendanceRow = new Attendance();
        $attendanceRow->employee_id = $employeeIds[$i];
        $attendanceRow->employee_name = $employeeNames[$i];
        $attendanceRow->day = date('d');
        $attendanceRow->time = date("H:i:s");
        $attendanceRow->month = date('F');
        $attendanceRow->year = date('Y');
        $attendanceRow->supervisor_id = $user_id;
        $attendanceRow->comment = $comment[$i];
        $attendanceRow->status = $values[$i];
        $attendanceRow->save();

      }


      return redirect()->route('attendance',$user_id)->with('success', 'Attendance save successfully!');
    }

  }

  public function submitAttendanceUpdate(Request $request){
    $employeeIds = $request->input('employee_id');
    $employeeNames = $request->input('employee_name');
    $values =$request->input('attendance_taking');
    $length = sizeof($values);
    $comment =$request->input('attendance_comment');
    // $attendanceRow->comment = $comment[$i];

    for($i=0;$i<$length;$i++){
      date_default_timezone_set("Asia/Dhaka");
      $attendanceRow = Attendance::where('employee_id',$employeeIds[$i])->update(['status' => $values[$i],'comment' => $comment[$i]]);;
    }


    return redirect()->route('attendanceEdit')->with('success', 'attendance updated successfully!');

  }





  public function addemployee(){
    $zones = Zone::all()->toArray();
    $users = User::where('user_type','!=','Admin')->get()->toArray();
    return view('employee_add', compact('zones', 'users'));

  }

  public function newEmployee(Request $request){
    $employee = new Empoyee();
    $employee->employee_id = $request->input('emp_id');
    $employee->employee_name = $request->input('emp_name');
    $employee->designation = $request->input('emp_designation');
    $employee->start_date = $request->input('emp_start_date');
    $employee->supervisor_id = $request->input('emp_supervisor');
    $employee->zone_id = $request->input('emp_zone');
    $employee->save();

    return redirect()->route('addemployee')->with('success', 'Employee information added successfully!');


  }

  public function employeelistForAdmin(){
    $employeesAll = Empoyee::all()->toArray();
    $i=0;
     $employees=[];
    foreach ($employeesAll as  $value) {
      $employees[$i]['id'] = $value['id'];
      $employees[$i]['employee_id'] = $value['employee_id'];
      $employees[$i]['employee_name'] = $value['employee_name'];
      $employees[$i]["designation"] = $value['designation'];
      $employees[$i]['start_date'] = $value['start_date'];
      $employees[$i]['zone_id'] = $value['zone_id'];
      $employees[$i]['supervisor_id'] = $value['supervisor_id'];
      $employees[$i]["sup_name"] = User::where('user_id',$value['supervisor_id'])->value('name');
      $employees[$i]["zone_name"] = Zone::where('zone_id',$value['zone_id'])->value('zone_name');

      $i++;
    }

    $zones = Zone::all()->toArray();
    $supervisors = User::all()->toArray();
    return view('employee_list_for_admin',compact('employees', 'zones', 'supervisors'));

  }

  public function employeelistForAdminZone(Request $request){
    $zones = Zone::all()->toArray();
    $supervisors = User::all()->toArray();
    $zone_id = $request->input('zone_id');
    $employeesAll = Empoyee::where('zone_id', $zone_id)->get()->toArray();

    if ($employeesAll==null) {
      $employeesAll = Empoyee::all()->toArray();
      }

    $i=0;
    foreach ($employeesAll as  $value) {
      $employees[$i]['id'] = $value['id'];
      $employees[$i]['employee_id'] = $value['employee_id'];
      $employees[$i]['employee_name'] = $value['employee_name'];
      $employees[$i]["designation"] = $value['designation'];
      $employees[$i]['start_date'] = $value['start_date'];
      $employees[$i]['zone_id'] = $value['zone_id'];
      $employees[$i]['supervisor_id'] = $value['supervisor_id'];
      $employees[$i]["sup_name"] = User::where('user_id',$value['supervisor_id'])->value('name');
      $employees[$i]["zone_name"] = Zone::where('zone_id',$value['zone_id'])->value('zone_name');

      $i++;
    }

      return view('employee_list_for_admin',compact('employees', 'zones', 'supervisors'));
  }

  public function employeelist($admin_id){

    $employeesAll = Empoyee::where('supervisor_id',$admin_id)->get()->toArray();
    $employees=[];
    $i=0;
    foreach ($employeesAll as  $value) {
      $employees[$i]['id'] = $value['id'];
      $employees[$i]['employee_id'] = $value['employee_id'];
      $employees[$i]['employee_name'] = $value['employee_name'];
      $employees[$i]["designation"] = $value['designation'];
      $employees[$i]['start_date'] = $value['start_date'];
      $employees[$i]['zone_id'] = $value['zone_id'];
      $employees[$i]['supervisor_id'] = $value['supervisor_id'];
      $employees[$i]["sup_name"] = User::where('user_id',$value['supervisor_id'])->value('name');
      $employees[$i]["zone_name"] = Zone::where('zone_id',$value['zone_id'])->value('zone_name');

      $i++;
    }
    $zones = Zone::all()->toArray();
    $supervisors = User::all()->toArray();
    $zones = Zone::all()->toArray();
    $supervisors = Supervisor::all()->toArray();

    return view('employee_list',compact('employees', 'zones', 'supervisors'));

  }

  public function updateEmployee(Request $request, $id){
    $employeeUp = Empoyee::find($id);
    $employeeUp->employee_id = $request->input('emp_id');
    $employeeUp->employee_name = $request->input('emp_name');
    $employeeUp->designation = $request->input('emp_gender');
    $employeeUp->start_date = $request->input('emp_phone');
    $employeeUp->supervisor_id = $request->input('emp_supervisor');
    $employeeUp->zone_id = $request->input('emp_zone');
    $employeeUp->save();

    return redirect()->route('employeelistForAdmin')->with('success', 'Employee information updated successfully!');
  }

  public function deleteEmployee($id){
    $employeeDelete = Empoyee::find($id);
    $employeeDelete->delete();
    return redirect()->route('employeelistForAdmin')->with('warning', 'Employee deleted successfully!');
  }




  public function addSupervisor(){
    $zones = Zone::all()->toArray();
    return view('add-supervisor',compact('zones'));
  }

  public function viewSupervisor(){

    // $employees = Empoyee::all()->toArray();
    $categories = Zone::all()->toArray();
    $supervisors = User::where('user_type','!=','Admin')->get()->toArray();
    return view('view-supervisor',compact('categories', 'supervisors'));


  }

  public function newSupervisor(Request $request){
    $supervisor = new Supervisor();
    $supervisor->login_id = $request->input('sup_id');
    $supervisor->password = $request->input('sup_password');
    $supervisor->name_sup = $request->input('sup_name');
    $supervisor->gender = $request->input('sup_gender');
    $supervisor->phone_sup = $request->input('sup_phone');
    $supervisor->zone_id = $request->input('sup_zone');
    $supervisor->save();
    return redirect()->route('addSupervisor')->with('success', 'Supervisor added updated successfully!');

  }

  public function updateSupervisor(Request $request, $id){
    $supervisor = User::find($id);
    $supervisor->name = $request->input('sup_name');
    $supervisor->user_id = $request->input('sup_id');
    $supervisor->user_type = $request->input('sup_user_type');
    $supervisor->email = $request->input('sup_email');
    $supervisor->save();
    return redirect()->route('viewSupervisor')->with('success', 'Supervisor information updated successfully!');

  }

  public function deleteSupervisor($id){
    $supervisor = User::find($id);
    $supervisor->delete();
    return redirect()->route('viewSupervisor')->with('warning', 'Supervisor deleted successfully!');
  }






  public function addZone(){
    return view('add-zone');
  }

  public function newZone(Request $request){
    $zone = new Zone();
    $zone->zone_name = $request->input('zone_name');
    $zone->zone_division = $request->input('zone_division');
    $zone->save();
    return redirect()->route('addZone')->with('success', 'Zone added successfully!');
  }

  public function viewZone(){
    $zones = Zone::all()->toArray();
    return view('view-zone',compact('zones'));
  }

  public function updateZone(Request $request, $id){
    $zone = Zone::find($id);
    $zone->zone_name = $request->input('zone_name');
    $zone->zone_division = $request->input('zone_division');
    $zone->save();
    return redirect()->route('viewZone')->with('success', 'Zone Updated successfully!');
  }

}
