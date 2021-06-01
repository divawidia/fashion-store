<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\admin_notifications;
use App\Models\transactions;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {    
        
        $year = date("Y");
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        $transaksi = [];
        foreach ($month as $key => $value) {
            $transaksi[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->count();
            
            $success[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','success')
                    ->count();
                    
            $unverified[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','unverified')
                    ->count();
                    
            $canceled[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','canceled')
                    ->count();
                    
            $expired[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','expired')
                    ->count();
                    
            $verified[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','verified')
                    ->count();
                    
            $delivered[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','delivered')
                    ->count();
        }
        //dd($user);
        
        //=====================================================================================================

        //==========================================================================================
        //BULANAN
        $bulan = date("m");
        $tahun = date("Y");

        
                $transaksi1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->count();
            
                $success1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->count();
                    
                $unverified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','unverified')
                        ->count();
                    
                $canceled1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','canceled')
                        ->count();
                    
                $expired1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','expired')
                        ->count();
                        
                $verified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->count();
                        
                $delivered1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->count();

                        $hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->get()->first();
                if($hargacek1 == NULL){
                        $harga1 = NULL;
                }elseif($hargacek1 != NULL){
                        $harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->get()->first();
                if($hargacek2 == NULL){
                        $harga2 = NULL;
                }elseif($hargacek2 != NULL){
                        $harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->get()->first();
                if($hargacek3 == NULL){
                        $harga3 = NULL;
                }elseif($hargacek3 != NULL){
                        $harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->sum('total');
                }

                if($harga1 == NULL && $harga2 == NULL && $harga3 == NULL){
                        $jumlah = 0;
                }
                if($harga1 == NULL && $harga2 != NULL && $harga3 != NULL){
                        $jumlah = $harga2 + $harga3;
                }
                if($harga2 == NULL && $harga1 != NULL && $harga3 != NULL){
                        $jumlah = $harga1 + $harga3;
                }
                if($harga3 == NULL && $harga1 != NULL && $harga2 != NULL){
                        $jumlah = $harga1 + $harga2;
                }
                if($harga1 == NULL && $harga2 == NULL && $harga3 != NULL){
                        $jumlah = $harga3;
                }
                if($harga2 == NULL && $harga3 == NULL && $harga1 != NULL){
                        $jumlah = $harga1;
                }
                if($harga1 == NULL && $harga3 == NULL && $harga2 != NULL){
                        $jumlah = $harga2;
                }
                if($harga1 != NULL && $harga2 != NULL && $harga3 != NULL){
                        $jumlah = $harga1 + $harga2 + $harga3;
                }
        //BULANAN
        //==========================================================================================

        //==========================================================================================
        //TAHUNAN

        
                $tahun_transaksi1 = transactions::whereYear('created_at', '=', $tahun)
                        ->count();

                $tahun_success1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->count();
                
                $tahun_unverified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','unverified')
                        ->count();
                
                $tahun_canceled1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','canceled')
                        ->count();
                
                $tahun_expired1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','expired')
                        ->count();
                        
                $tahun_verified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->count();
                        
                $tahun_delivered1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->count();

                        $tahun_hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->get()->first();
                if($tahun_hargacek1 == NULL){
                        $tahun_harga1 = NULL;
                }elseif($tahun_hargacek1 != NULL){
                        $tahun_harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $tahun_hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->get()->first();
                if($tahun_hargacek2 == NULL){
                        $tahun_harga2 = NULL;
                }elseif($tahun_hargacek2 != NULL){
                        $tahun_harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $tahun_hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->get()->first();
                if($tahun_hargacek3 == NULL){
                        $tahun_harga3 = NULL;
                }elseif($tahun_hargacek3 != NULL){
                        $tahun_harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->sum('total');
                }


                        if($tahun_harga1 == NULL && $tahun_harga2 == NULL && $tahun_harga3 == NULL){
                                $tahun_jumlah = 0;
                        }
                        if($tahun_harga1 == NULL && $tahun_harga2 != NULL && $tahun_harga3 != NULL){
                                $tahun_jumlah = $tahun_harga2 + $tahun_harga3;
                        }
                        if($tahun_harga2 == NULL && $tahun_harga1 != NULL && $tahun_harga3 != NULL){
                                $tahun_jumlah = $tahun_harga1 + $tahun_harga3;
                        }
                        if($tahun_harga3 == NULL && $tahun_harga1 != NULL && $tahun_harga2 != NULL){
                                $tahun_jumlah = $tahun_harga1 + $tahun_harga2;
                        }
                        if($tahun_harga1 == NULL && $tahun_harga2 == NULL && $tahun_harga3 != NULL){
                                $tahun_jumlah = $tahun_harga3;
                        }
                        if($tahun_harga2 == NULL && $tahun_harga3 == NULL && $tahun_harga1 != NULL){
                                $tahun_jumlah = $tahun_harga1;
                        }
                        if($tahun_harga1 == NULL && $tahun_harga3 == NULL && $tahun_harga2 != NULL){
                                $tahun_jumlah = $tahun_harga2;
                        }
                        if($tahun_harga1 != NULL && $tahun_harga2 != NULL && $tahun_harga3 != NULL){
                                $tahun_jumlah = $tahun_harga1 + $tahun_harga2 + $tahun_harga3;
                        }

        //TAHUNAN
        //==========================================================================================
                
    	return view('admin.index', ['bulan'=>$bulan, 'tahun'=>$tahun,'transaksi' => $jumlah, 'jumlah' => $jumlah,'transaksi1' => $transaksi1,'success1' => $success1,'unverified1' => $unverified1,'canceled1' => $canceled1,'expired1' => $expired1,'verified1' => $verified1,'delivered1' => $delivered1,
                                'tahun_jumlah' => $tahun_jumlah,'tahun_transaksi1' => $tahun_transaksi1,'tahun_success1' => $tahun_success1,'tahun_unverified1' => $tahun_unverified1,'tahun_canceled1' => $tahun_canceled1,'tahun_expired1' => $tahun_expired1,'tahun_verified1' => $tahun_verified1,'tahun_delivered1' => $tahun_delivered1])
                                    ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
                                    ->with('transaksi',json_encode($transaksi,JSON_NUMERIC_CHECK))
                                    ->with('success',json_encode($success,JSON_NUMERIC_CHECK))
                                    ->with('unverified',json_encode($unverified,JSON_NUMERIC_CHECK))
                                    ->with('canceled',json_encode($canceled,JSON_NUMERIC_CHECK))
                                    ->with('expired',json_encode($expired,JSON_NUMERIC_CHECK))
                                    ->with('verified',json_encode($verified,JSON_NUMERIC_CHECK))
                                    ->with('delivered',json_encode($delivered,JSON_NUMERIC_CHECK));
    }


    public function markReadAdmin()
    {
        $admin = admin::find(1);
        $admin->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->back();
    }

    public function showAllNotif()
    {
        $admin = admin::find(1);
        return view('admin.allNotif', compact(['admin']));
    }

    public function readSpesificNotif(Request $request)
    {
        $id = $request->notifId;
        $url = $request->url;
        $notif = admin_notifications::find($id);
        $notif->update(['read_at' => now()]);
        return redirect()->to($url);
    }

    public function cekReport(Request $request)
    {
        $year = date("Y");
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        $transaksi = [];
        foreach ($month as $key => $value) {
            $transaksi[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->count();
            
            $success[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','success')
                    ->count();
                    
            $unverified[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','unverified')
                    ->count();
                    
            $canceled[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','canceled')
                    ->count();
                    
            $expired[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','expired')
                    ->count();
                    
            $verified[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','verified')
                    ->count();
                    
            $delivered[] = transactions::whereYear('created_at', '=', $year)
                    ->where(DB::raw("DATE_FORMAT(created_at, '%M')"),$value)
                    ->where('status','delivered')
                    ->count();
        }

        //==========================================================================================
        //BULANAN
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        
                $transaksi1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->count();
            
                $success1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->count();
                    
                $unverified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','unverified')
                        ->count();
                    
                $canceled1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','canceled')
                        ->count();
                    
                $expired1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','expired')
                        ->count();
                        
                $verified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->count();
                        
                $delivered1 = transactions::whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->count();

                $hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->get()->first();
                if($hargacek1 == NULL){
                        $harga1 = NULL;
                }elseif($hargacek1 != NULL){
                        $harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->get()->first();
                if($hargacek2 == NULL){
                        $harga2 = NULL;
                }elseif($hargacek2 != NULL){
                        $harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->get()->first();
                if($hargacek3 == NULL){
                        $harga3 = NULL;
                }elseif($hargacek3->total != NULL){
                        $harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->whereMonth('created_at','=',$bulan)
                        ->where('status','verified')
                        ->sum('total');
                }

                if($harga1 == NULL && $harga2 == NULL && $harga3 == NULL){
                        $jumlah = 0;
                }
                if($harga1 == NULL && $harga2 != NULL && $harga3 != NULL){
                        $jumlah = $harga2 + $harga3;
                }
                if($harga2 == NULL && $harga1 != NULL && $harga3 != NULL){
                        $jumlah = $harga1 + $harga3;
                }
                if($harga3 == NULL && $harga1 != NULL && $harga2 != NULL){
                        $jumlah = $harga1 + $harga2;
                }
                if($harga1 == NULL && $harga2 == NULL && $harga3 != NULL){
                        $jumlah = $harga3;
                }
                if($harga2 == NULL && $harga3 == NULL && $harga1 != NULL){
                        $jumlah = $harga1;
                }
                if($harga1 == NULL && $harga3 == NULL && $harga2 != NULL){
                        $jumlah = $harga2;
                }
                if($harga1 != NULL && $harga2 != NULL && $harga3 != NULL){
                        $jumlah = $harga1 + $harga2 + $harga3;
                }
        //BULANAN
        //==========================================================================================

        //==========================================================================================
        //TAHUNAN

        
                $tahun_transaksi1 = transactions::whereYear('created_at', '=', $tahun)
                        ->count();
            
                $tahun_success1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->count();
                    
                $tahun_unverified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','unverified')
                        ->count();
                    
                $tahun_canceled1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','canceled')
                        ->count();
                    
                $tahun_expired1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','expired')
                        ->count();
                        
                $tahun_verified1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->count();
                        
                $tahun_delivered1 = transactions::whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->count();
                
                $tahun_hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->get()->first();
                if($tahun_hargacek1 == NULL){
                        $tahun_harga1 = NULL;
                }elseif($tahun_hargacek1 != NULL){
                        $tahun_harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $tahun_hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->get()->first();
                if($tahun_hargacek2 == NULL){
                        $tahun_harga2 = NULL;
                }elseif($tahun_hargacek2 != NULL){
                        $tahun_harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $tahun_hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->get()->first();
                if($tahun_hargacek3 == NULL){
                        $tahun_harga3 = NULL;
                }elseif($tahun_hargacek3 != NULL){
                        $tahun_harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $tahun)
                        ->where('status','verified')
                        ->sum('total');
                }
                
                if($tahun_harga1 == NULL && $tahun_harga2 == NULL && $tahun_harga3 == NULL){
                        $tahun_jumlah = 0;
                }
                if($tahun_harga1 == NULL && $tahun_harga2 != NULL && $tahun_harga3 != NULL){
                        $tahun_jumlah = $tahun_harga2 + $tahun_harga3;
                }
                if($tahun_harga2 == NULL && $tahun_harga1 != NULL && $tahun_harga3 != NULL){
                        $tahun_jumlah = $tahun_harga1 + $tahun_harga3;
                }
                if($tahun_harga3 == NULL && $tahun_harga1 != NULL && $tahun_harga2 != NULL){
                        $tahun_jumlah = $tahun_harga1 + $tahun_harga2;
                }
                if($tahun_harga1 == NULL && $tahun_harga2 == NULL && $tahun_harga3 != NULL){
                        $tahun_jumlah = $tahun_harga3;
                        
                }
                if($tahun_harga2 == NULL && $tahun_harga3 == NULL && $tahun_harga1 != NULL){
                        $tahun_jumlah = $tahun_harga1;
                }
                if($tahun_harga1 == NULL && $tahun_harga3 == NULL && $tahun_harga2 != NULL){
                        $tahun_jumlah = $tahun_harga2;
                }
                if($tahun_harga1 != NULL && $tahun_harga2 != NULL && $tahun_harga3 != NULL){
                        $tahun_jumlah = $tahun_harga1 + $tahun_harga2 + $tahun_harga3;
                }
        //TAHUNAN
        //==========================================================================================
        
        //dd($tahun_jumlah);
        return view('admin.index',['bulan'=>$bulan, 'tahun'=>$tahun,'transaksi' => $jumlah, 'jumlah' => $jumlah,'transaksi1' => $transaksi1,'success1' => $success1,'unverified1' => $unverified1,'canceled1' => $canceled1,'expired1' => $expired1,'verified1' => $verified1,'delivered1' => $delivered1,
                                'tahun_jumlah' => $tahun_jumlah,'tahun_transaksi1' => $tahun_transaksi1,'tahun_success1' => $tahun_success1,'tahun_unverified1' => $tahun_unverified1,'tahun_canceled1' => $tahun_canceled1,'tahun_expired1' => $tahun_expired1,'tahun_verified1' => $tahun_verified1,'tahun_delivered1' => $tahun_delivered1])
                                ->with('month',json_encode($month,JSON_NUMERIC_CHECK))
                                ->with('transaksi',json_encode($transaksi,JSON_NUMERIC_CHECK))
                                ->with('success',json_encode($success,JSON_NUMERIC_CHECK))
                                ->with('unverified',json_encode($unverified,JSON_NUMERIC_CHECK))
                                ->with('canceled',json_encode($canceled,JSON_NUMERIC_CHECK))
                                ->with('expired',json_encode($expired,JSON_NUMERIC_CHECK))
                                ->with('verified',json_encode($verified,JSON_NUMERIC_CHECK))
                                ->with('delivered',json_encode($delivered,JSON_NUMERIC_CHECK));
        
    }
}
