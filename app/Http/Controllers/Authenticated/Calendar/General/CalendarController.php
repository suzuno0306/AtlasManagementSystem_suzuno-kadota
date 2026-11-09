<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSetting;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
	    $getDate = $request->getData;
            $reserveDays = [];
foreach ($getDate as $index => $date) {
    if (!empty($getPart[$date])) {
    $reserveDays[$date] = $getPart[$date];
}
}
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSetting::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
	    throw $e;
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    public function delete(Request $request)
{
    $getDate = $request->getData;
    $getPart = $request->getPart;
    $deleteDays = array_filter(array_combine($getDate, $getPart));

    DB::beginTransaction();

    try {
        foreach ($deleteDays as $key => $value) {
            $reserve_settings = ReserveSetting::where('setting_reserve', $key)
                ->where('setting_part', $value)
                ->first();

            if (!$reserve_settings) {
                continue;
            }

            $deleted = $reserve_settings->users()->detach(Auth::id());

            if ($deleted > 0) {
                $reserve_settings->increment('limit_users');
            }
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        throw $e;
    }

    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
}

}
