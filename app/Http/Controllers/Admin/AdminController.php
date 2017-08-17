<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function productSale()
    {
        return true;
    }

    public function productPurchase()
    {
        return true;
    }

    public function salesRelation()
    {
        return true;
    }

    public function purchasesRelation()
    {
        return true;
    }
}
