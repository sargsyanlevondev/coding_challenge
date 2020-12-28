<?php

namespace App\Http\Controllers;

use App\Offering;

class Offerings extends Controller
{
    public function getOfferings()
    {
        $offerings = Offering::all();
        return response($offerings);
    }
}
