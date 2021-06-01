<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\transaction_details;
use App\Models\Provinces;
use App\Models\Cities;
use App\Models\carts;
use App\Models\products;
use App\Models\admin;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;

class AdminTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }


    
}
