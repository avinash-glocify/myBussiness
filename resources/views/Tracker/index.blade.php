@extends('layouts.auth')
@section('content')
<div class="p-3 bg-gradient-light">
  <div class="row mt-2">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Start Tracker</h4>
          <div class="d-none" id="task_error">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <div class="alert alert-danger col-md-12 text-center">
                Please Add What are you working on
              </div>
            </div>
          </div>
          <div class="d-none" id="project_error">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
              <div class="alert alert-danger col-md-12 text-center">
                Please Select on which project are you working
              </div>
            </div>
          </div>
          <form class="form-inline border-solid-theme pt-2">
            <input type="text" class="form-control ml-2 mb-2 mr-sm-2 col-md-3" id="task" placeholder="Add What Are You Working on">
            <div class="input-group mb-2 mr-sm-2 col-md-2">
              <select class="mdb-select form-control selectpicker  @error('emails') is-invalid @enderror" id="projectId"  data-live-search="true" name="prject">
                <option value="">Select Project</option>
                @foreach($projects as $key => $project)
                <option value="{{$project->id}}">{{ $project->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-group mb-2 mr-sm-2 col-md-3">
              <div class="input-group-prepend"><div class="input-group-text text-success">
                @if(Session::has('this_session'))
                  {{Session::get('this_session')}}
                @else
                  {{ \Carbon\Carbon::now()->format('H:i:A') }}
                @endif
              </div></div>
              <div class="input-group-prepend"><div class="input-group-text text-success">{{ \Carbon\Carbon::now()->format('H:i:A') }}</div></div>
            </div>
            <div class="input-group mb-2 mr-sm-2 col-md-2">
              <span id="hour">00</span> :
              <span id="min">00</span> :
              <span id="sec">00</span> :
              <span id="milisec">00</span>
            </div>
            <button type="button" onclick="startStop()" id="start" class="btn btn-primary mb-2">Start</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @foreach($trackers as $timeKey =>  $tracker)
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            @foreach($tracker as $key => $projectTracker)
            @if($key == 0)
              <h4 class="card-header mb-2">
                @if(\Carbon\Carbon::parse($timeKey)->diffInDays() == 0)
                    Today
                  @elseif(\Carbon\Carbon::parse($timeKey)->diffInDays() == 1)
                    Yesterday
                  @else
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $timeKey)->diffForHumans() }}
                @endif
              </h4>
            @endif
            <div class="form-inline pt-2 border-solid-theme @if(!$loop->last) border-btn @endif">
              <input type="text" class="form-control ml-2 mb-2 mr-sm-2 col-md-3" value="{{ $projectTracker->task }}" placeholder="Add What Are You Working on">
              <div class="input-group mb-2 mr-sm-2 col-md-2">
                <select class="mdb-select form-control selectpicker  @error('emails') is-invalid @enderror" data-live-search="true" name="prject">
                  <option value="">Select Project</option>
                  @foreach($projects as $key => $project)
                  <option value="{{$project->id}}" @if($projectTracker->project_id == $project->id) Selected @endif>{{ $project->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="input-group mb-2 mr-sm-2 col-md-3">
                <div class="input-group-prepend"><div class="input-group-text text-success">
                  {{ \Carbon\Carbon::now()->format('H:i:A') }}
                </div></div>
                <div class="input-group-prepend"><div class="input-group-text text-success">{{ \Carbon\Carbon::now()->format('H:i:A') }}</div></div>
                @if($projectTracker->count > 1)
                  <div class="input-group-prepend p-3 ml-3 bg-info "><div class="text-success"></div> {{ $projectTracker->count }}</div>
                @endif
              </div>
              <div class="input-group mb-2 mr-sm-2 col-md-2">
                <span>{{ $projectTracker->total_track_time }}</span>
              </div>
              <button type="button" class="btn btn-primary mb-2 restart_tracker"><i class="mdi mdi-arrow-right-drop-circle-outline"></i></button>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  @endsection
</div>
