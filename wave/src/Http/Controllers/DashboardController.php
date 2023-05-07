<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbStep;
use App\Models\UserSpmbStep;
// use Wave\SpmbConfig;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->guest() && auth()->user()->role_id==3){
            $step = SpmbStep::all()->toArray();
            $user_step = UserSpmbStep::where('user_id',auth()->user()->id)->first();
            $step_with_status=array();
            return view('theme::dashboard.index',array(
                "steps"=>self::getStepStatus($step,$user_step,$step_with_status)
            ));
        }else{
            return view('theme::dashboard.index',array(
                
            ));
        }
    }

    public static function getStepStatus($step,$user_step,$step_with_status)
    {
        foreach ($step as $key => $value) {
            $temp = $value;
            switch ($value['id']) {
                case 1:
                    $temp['status']=$user_step->step_1;
                    break;
                    case 2:
                        $temp['status']=$user_step->step_2;
                        break;
                        case 3:
                            $temp['status']=$user_step->step_3;
                            break;
                            case 4:
                                $temp['status']=$user_step->step_4;
                                break;
                                case 5:
                                    $temp['status']=$user_step->step_5;
                                    break;
                                    case 6:
                                        $temp['status']=$user_step->step_6;
                                        break;
                                        case 7:
                                            $temp['status']=$user_step->step_7;
                                            break;
                                            case 8:
                                                $temp['status']=$user_step->step_8;
                                                break;
                                                case 9:
                                                    $temp['status']=$user_step->step_9;
                                                    break;
                                                    case 10:
                                                        $temp['status']=$user_step->step_10;
                                                        break;
                                                        case 11:
                                                            $temp['status']=$user_step->step_11;
                                                            break;
                default:
                    break;
            }
            array_push($step_with_status,$temp);
        }
        return $step_with_status;
    }
}
