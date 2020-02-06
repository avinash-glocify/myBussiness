<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tracker extends Model
{
    protected $guarded = [];

    public function getTotalTrackTimeAttribute()
    {
        $endTime  = $this->end_time ?? Carbon::now();
        $endTime  = Carbon::parse($endTime);
        $time     = $endTime->diffInSeconds(Carbon::parse($this->start_time));
        return gmdate('H:i:s', $time);
    }
}
