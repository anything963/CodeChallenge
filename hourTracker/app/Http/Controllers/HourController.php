<?php

namespace App\Http\Controllers;
use App\Hour;
use Auth;
use DB;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class HourController extends Controller
{
    /**
     * @return hours for current user
     */
    public function index() {
        $date = date('Y-m-d',strtotime('last sunday'));
        $hours = DB::table('hours')->where('user_id', Auth::user()->id)
                                    ->where('created_at', '>=', $date)->get();
        return $hours;
    }

    /**
     * Inserts new hour if user has no entry for the week
     * Updates of the entry for week is found
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request) {

        //Range validation 0-10
        if ($this->rangeValidation($request)){
            return response ([
                'status' => 400,
                'error' => 'Bad Request.',
                'message' => 'Hours should be 0-10.'
            ], 400);
        }

        //Total hours validation
        if($this->totalHoursRuleValidation($request)) {
            return response ([
                'status' => 400,
                'error' => 'Bad Request.',
                'message' => 'Total hours should not be more than 40.'
            ], 400);
        }

        //Weekend rule validation
        if($this->weekendRuleValidation($request)){
            return response ([
                'status' => 400,
                'error' => 'Bad Request.',
                'message' => 'Cannot save hours for Monday if saved for Saturday and Sunday.'
            ], 400);
        }

        //check if entry is available for this week
        $date = date('Y-m-d',strtotime('last sunday'));
        $hour = Hour::where('user_id' , Auth::user()->id)->where('created_at', '>=', $date)->first();

        if ($hour){
            $hour->sunday = $request->sunday;
            $hour->monday = $request->monday;
            $hour->tuesday = $request->tuesday;
            $hour->wednesday = $request->wednesday;
            $hour->thursday = $request->thursday;
            $hour->friday = $request->friday;
            $hour->saturday = $request->saturday;
            $hour->save();
            return $hour;
        } else {
            $newHour = new Hour();
            $newHour->user_id = Auth::user()->id;
            $newHour->sunday = $request->sunday;
            $newHour->monday = $request->monday;
            $newHour->tuesday = $request->tuesday;
            $newHour->wednesday = $request->wednesday;
            $newHour->thursday = $request->thursday;
            $newHour->friday = $request->friday;
            $newHour->saturday = $request->saturday;
            $newHour->save();
            return $newHour;
        }


    }

    /**
     * a user cannot work more than 10 hours in a single day
     * @param Request $request
     * @return bool
     */
    private function rangeValidation(Request $request){
        $validator = Validator::make($request->all(), [
            'sunday' => 'integer|max:10|min:0',
            'monday' => 'integer|max:10|min:0',
            'tuesday' => 'integer|max:10|min:0',
            'wednesday' => 'integer|max:10|min:0',
            'thursday' => 'integer|max:10|min:0',
            'friday' => 'integer|max:10|min:0',
            'saturday' => 'integer|max:10|min:0'
        ]);

        if ($validator->fails()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * a user cannot work more than 40 hours in a week
     * @param Request $request
     * @return bool
     */
    private function totalHoursRuleValidation(Request $request){
        $totalHours = $request->sunday
            +$request->monday
            +$request->tuesday
            +$request->wednesday
            +$request->thursday
            +$request->friday
            +$request->saturday;
        if ($totalHours > 40 ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * if a user works Saturday and Sunday, they must not work Monday
     * @param Request $request
     * @return bool
     */
    private function weekendRuleValidation(Request $request){
        if ($request->saturday > 0 && $request->sunday > 0) {
            if($request->monday > 0){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
