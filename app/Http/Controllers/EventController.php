<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\EventSpeaker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\view;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Yajra\DataTables\DataTables;
class EventController extends Controller
{
    public function getEvent(){
        return view('admin.Events.index');
    }
    public function addEvent(){
        return view('admin.Events.add');
    }
    public function getListEvents(){
        $event=Event::select('events.*')->with('eventSpeakers');
        return DataTables::of($event)
            ->addColumn('action',function ($event){
                $button='';
                $button.=' <a class="btn btn-warning btn-sm" href="'. url("events/edit/".$event->id) .'"><i class="fas fa-user-edit"></i></a>';
                $button.=' <button class="btn btn-danger delete btn-sm" onclick="delete_btn('.$event->id .')"><i class="fas fa-user-minus"></i></a>';
                return $button;
            })->addColumn('status',function ($event){
                return $event->status===1?"Disabled":"Enabled";
            })->rawColumns(['action'])->make(true);
    }
    //////////////////////////......Relationships .......................//////////////
        public function index(){
            $Speakers = Event::with('EventSpeaker')->get();
            return  view('admin.Events.add');
        }
    /////////////////////////////////////////////////////
    public function submitEventForm(Request $request)
    {

        $events_data = [
            'event_type' => $request ['event_type'],
            'organiser_name' => $request ['organiser_name'],
            'organiser_phone_number' => $request ['organiser_phone_number'],
            'event_start' => $request ['event_start'],
            'event_end' => $request ['event_end'],
            'event_detail' => $request ['event_detail']
        ];
          if ($request['event_id'] != "") {
              Event::whereId($request['event_id'])->update($events_data);
              EventSpeaker::whereEventId($request['event_id'])->delete();
              $event=Event::whereId($request['event_id'])->first();
            } else {
              $event = Event::create($events_data);
            }

            if(isset($request['first_name'])&&count($request['first_name'])>0){
                foreach ($request['first_name'] as $k=>$name){
                    if($request['first_name'][$k]!=''){
                        EventSpeaker::create([
                            "event_id"=>$event->id,
                            "first_name"=>$request['first_name'][$k],
                            "last_name"=>$request['last_name'][$k],
                            "phone_number" => $request['phone_number'][$k],
                            "gender"=>$request['gender'][$k],
                            "email"=>$request['email'][$k],
                            "date"=>date('Y-m-d',strtotime($request['date'][$k])),
                        ]);
                    }
                }
            }

            return response()->json([
                "success" => [
                    "message" => "Event added successfully"
                ]
            ]);
    }
    public function editEvent ($id){
        $detail=Event::with('eventSpeakers')->whereId($id)->first();
        return view("admin.Events.add",['header'=>"Edit Events","detail"=>$detail,]);
    }
    public function deleteEvent($id){
        Event::whereId($id)->delete();
        EventSpeaker::whereEventId($id)->delete();
        Session::flash("success","record deleted successfully");
        return redirect('admin/events');
    }
}
