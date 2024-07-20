<?php
namespace App\Http\Controllers;

use App\Http\Requests\users\UpdateProfilerequest;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
    {
        public function getLogin()
        {
            return view('admin.login');
        }
    public function postLogin(Request $request)
    {
        try {
            $message = trans('messages.invalid_login_credentials');
            $rememberMe = false;
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
                return redirect('admin/dashboard')->with('success_msg', "Logged in");
            }
        } catch (\Exception $e) {
            Log::error(__CLASS__ . "::" . __METHOD__ . "  " . $e->getMessage() . "on line" . $e->getLine());
        }

        return redirect('admin/dashboard')->with('success_msg', "Logged in");
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
    //////////////////////////...........Users Section.......//////////////
    Public function getUser(){
            return view('admin.Users.index');
    }
    public function getAdd(){
            return view('admin.Users.add');
    }
    public function getUsersList(){
        $user = User::whereUserType(2)->get();
        return DataTables::of($user)
            ->addColumn('action',function ($user){
                $button='';
                $button.=' <a class="btn btn-warning btn-sm" href="'. url("customer/edit".$user->id) .'"><i class="fas fa-user-edit"></i></a>';
                $button.=' <button class="btn btn-danger delete btn-sm" onclick="delete_btn('.$user->id .')"><i class="fas fa-user-minus"></i></a>';
                return $button;
            })->addColumn('status',function ($user){
                return $user->status===1?"Disabled":"Enabled";
            })->rawColumns(['action'])->make(true);
    }
    public function editUser($id){
            $detail =User::whereId($id)->first();
            return view('admin.Users.index',['header'=>"Edit Users",'detail'=>$detail]);
    }

    ///////////////.........Bookings section.......//////////
    public function booking(){
            return view('admin.Bookings.index');
    }

    public function getBookingList(){
        $booking = Booking::with('event');
        return DataTables::of($booking)
            ->addColumn('action',function ($booking){
            })->addColumn('status',function ($booking){
                return $booking->status===1?"Disabled":"Enabled";
            })->rawColumns(['action'])->make(true);
    }

    public function index(){
        $brand = Booking::with('Event')->get();
        return  view('admin.Bookings.index');
    }
    /////////////////.......Dashboard Section...///////////
    public function dashboard()
    {
        $events = DB::table('events')->count();
        $tables = DB::table('table_tops')->count('total_tables');
        $booked_table = DB::table('table_tops')->count('booked_tables');
        $booked_Tickets = DB::table('table_tops')->count('booked_tables');
        return view('admin.Dashboard',compact('tables','events','booked_table','booked_Tickets'));
    }
    ///////////////////////........Participants Section.....///////////////
    public function getParticipants(){
            return view('admin.Participants.index');
    }

    ////////////////////////......Profile Section..........////////
        public function editprofile(){
            return view('admin.profile')->with("user", auth()->user());
        }
        public function updateProfile(UpdateProfilerequest $request)
        {
            $user = auth()->user();

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'address' => $request->address,
                'cnic_no' => $request->cnic_no,
                'profile_picture' => $request->profile_picture,
                'gender' => $request->gender,

            ]);
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $file->move('uploads/profile/'. $request['id'], $file->getClientOriginalName());
                $file_name = $file->getClientOriginalName();
                $file_path = 'uploads/profile/' . $request['id'] . '/' . $file_name;
                User::whereId($request['id'])->update(['profile_picture' => $file_path]);
            }
                session()->flash('success', 'User Profile Update successfully');
                return redirect()->back();
            }
}
