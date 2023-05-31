<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbStep;
use App\Models\UserSpmbStep;
use App\Models\CamabaDataPokok;
use App\Models\CamabaDataAlamat;
use App\Models\CamabaDataOrtu;
use App\Models\CamabaDataWaliPs;
use App\Models\CamabaDataDokumen;
use App\Models\CamabaDataPernyataan;
use App\Models\CamabaDataProgramStudi;
use App\Models\CamabaDataRiwayatPendidikan;
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
            $step1 = CamabaDataPokok::where('id_user',auth()->user()->id)->first();
            $step2 = CamabaDataAlamat::where('id_user',auth()->user()->id)->first();
            $step3 = CamabaDataOrtu::where('id_user',auth()->user()->id)->first();
            $step4 = CamabaDataWaliPs::where('id_user',auth()->user()->id)->first();
            $step5 = CamabaDataRiwayatPendidikan::where('id_user',auth()->user()->id)->first();
            $step6 = CamabaDataProgramStudi::where('id_user',auth()->user()->id)->first();
            $step7 = CamabaDataDokumen::where('id_user',auth()->user()->id)->first();
            $step8 = CamabaDataPernyataan::where('id_user',auth()->user()->id)->first();
            if($step1==null&&$step2==null&&$step3==null&&$step4==null&&$step5==null&&$step6==null&&$step7==null&&$step8==null){
                $uss = UserSpmbStep::where('user_id',auth()->user()->id)->first();
                $uss->step_3 = 0;
                $uss->save();
            }else if($step1!=null&&$step2!=null&&$step3!=null&&$step4!=null&&$step5!=null&&$step6!=null&&$step7!=null&&$step8!=null){
                $uss = UserSpmbStep::where('user_id',auth()->user()->id)->first();
                $uss->step_3 = 1;
                $uss->save();
            }else{
                $uss = UserSpmbStep::where('user_id',auth()->user()->id)->first();
                $uss->step_3 = 2;
                $uss->save();
            }
            
            $step = SpmbStep::all()->toArray();
            $user_step = UserSpmbStep::where('user_id',auth()->user()->id)->first();
            $step_with_status=array();
            return view('theme::dashboard.index',array(
                "steps"=>self::getStepStatus($step,$user_step,$step_with_status)
            ));
        }else if(!auth()->guest() && auth()->user()->role_id==8){
            $data = "dd";
            return view('theme::dashboard.index',array(
                "data" => $data
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
