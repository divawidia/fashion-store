<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function viewprint(Request $request)
    {
        $year = $request->tahun;
        $transaksi = DB::table('transaction_details')
                    ->join('transactions','transaction_details.transaction_id','=','transactions.id')
                    ->join('products','transaction_details.product_id','=','products.id')
                    ->select('transactions.id as id_transaksi', 'products.product_name as nama_produk', 'transactions.status as status', 'transactions.created_at as datetime')
                    ->whereYear('transactions.created_at',$year)
                    ->get();
        
        //dd($year);
        $banyaktransaksi = transactions::whereYear('created_at', '=', $year)
                        ->count();

        //=============== Bayar
        $tahun_hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','success')
                        ->get()->first();
                if($tahun_hargacek1 == NULL){
                        $tahun_harga1 = NULL;
                }elseif($tahun_hargacek1 != NULL){
                        $tahun_harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $tahun_hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','delivered')
                        ->get()->first();
                if($tahun_hargacek2 == NULL){
                        $tahun_harga2 = NULL;
                }elseif($tahun_hargacek2 != NULL){
                        $tahun_harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $tahun_hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','verified')
                        ->get()->first();
                if($tahun_hargacek3 == NULL){
                        $tahun_harga3 = NULL;
                }elseif($tahun_hargacek3 != NULL){
                        $tahun_harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
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
        //=============== Bayar


        return view('admin.showprint',['transaksi'=>$transaksi,'tahun'=>$year,'total'=>$tahun_jumlah,'jumlah'=>$banyaktransaksi]);
	    
    }

    public function print(Request $request)
    {
        $year = $request->tahun;
        $transaksi = DB::table('transaction_details')
                    ->join('transactions','transaction_details.transaction_id','=','transactions.id')
                    ->join('products','transaction_details.product_id','=','products.id')
                    ->select('transactions.id as id_transaksi', 'products.product_name as nama_produk', 'transactions.status as status', 'transactions.created_at as datetime')
                    ->whereYear('transactions.created_at',$year)
                    ->get();
        //dd($transaksi);

        
        $banyaktransaksi = transactions::whereYear('created_at', '=', $year)
                        ->count();

        //=============== Bayar
        $tahun_hargacek1 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','success')
                        ->get()->first();
                if($tahun_hargacek1 == NULL){
                        $tahun_harga1 = NULL;
                }elseif($tahun_hargacek1 != NULL){
                        $tahun_harga1 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','success')
                        ->sum('total');
                }
                
                $tahun_hargacek2 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','delivered')
                        ->get()->first();
                if($tahun_hargacek2 == NULL){
                        $tahun_harga2 = NULL;
                }elseif($tahun_hargacek2 != NULL){
                        $tahun_harga2 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','delivered')
                        ->sum('total');
                }
                
                $tahun_hargacek3 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
                        ->where('status','verified')
                        ->get()->first();
                if($tahun_hargacek3 == NULL){
                        $tahun_harga3 = NULL;
                }elseif($tahun_hargacek3 != NULL){
                        $tahun_harga3 = transactions::select('total')
                        ->whereYear('created_at', '=', $year)
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
        //=============== Bayar

        $pdf = PDF::loadview('admin.print',['transaksi'=>$transaksi,'tahun'=>$year,'total'=>$tahun_jumlah,'jumlah'=>$banyaktransaksi]);
	    return $pdf->download('laporan-pegawai-pdf');
	    
    }
}
