<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tracker;
use App\Project;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        $trackers = Tracker::whereNotNull('end_time')
                          ->orderBy('created_at', 'desc')
                          ->select('*', \DB::raw('DATE(created_at) as date'))
                          ->get()
                        ->groupBy('date');
        return view('Tracker.index', compact('projects', 'trackers'));
    }

    public function startTracker(Request $request)
    {
        $rules   = [
          'task'       => 'required',
          'project_id' => 'required',
        ];

        $validate =  Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return response()->json(['errors'=> $validate->errors()]);
        }

        $user    = \Auth::user();
        $tracker = Tracker::where(['project_id' => $request->project_id, 'user_id' => $user->id, 'task' => $request->task,])
                            ->whereDate('start_date', Carbon::now()->format('Y-m-d'))
                            ->first();
        if($tracker) {
          $tracker->update([
            'end_time' => Null,
            'count'    => ++$tracker->count
          ]);
          $data            = $this->getTimeDiffrence($tracker->start_time);
        } else {
          $tracker = Tracker::create([
            'project_id'  => $request->project_id,
            'user_id'     => $user->id,
            'start_time'  => Carbon::now(),
            'start_date'  => Carbon::now(),
            'task'        => $request->task,
            'count'       => 1,
          ]);
        }
        $data = $this->getTimeDiffrence($tracker->start_time);
        Session()->put('tracker', $tracker->id);
        Session()->put('this_session', Carbon::now()->format('H:i:A'));
        return response(['success' => $data]);
    }

    public function stopTracker($id)
    {
        if(Session()->has('tracker')) {
          $tracker = Tracker::where('id', Session()->get('tracker'))->first();
          $tracker->update(['end_time' => Carbon::now()]);
          Session()->forget('tracker');
          Session()->forget('this_session');
          return response(['success' => 'tracker stoped']);
        } else {
          return response(['error' => 'something went wrong']);
        }
    }

    public function checkTrackerSession()
    {
        if(Session()->has('tracker')) {
          $tracker = Tracker::where('id', Session()->get('tracker'))->first();
          $data    = $this->getTimeDiffrence($tracker->start_time);
          return response(['success' => $data]);
        } else {
          return response(['error' => 'something went wrong']);
        }
    }
    public function getTimeDiffrence($startTime)
    {
      $servingTime      = Carbon::parse($startTime);
      $data     = [
          'minuts'  => gmdate('i', Carbon::now()->diffInSeconds($servingTime, true)),
          'seconds' => gmdate('s', Carbon::now()->diffInSeconds($servingTime, true)),
          'hours'   => gmdate('H', Carbon::now()->diffInSeconds($servingTime, true)),
      ];
      return $data;
    }
}
