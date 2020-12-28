<?php

namespace App\Http\Controllers;

use App\Offering;
use App\Purchase;
use Illuminate\Http\Request;
class Purchases extends Controller
{
    public function getPurchases()
    {
        $purchases = Purchase::all();
        return response($purchases);
    }

    public function createPurchase(Request $request)
    {

        $input = $request->all();
        $input = json_decode($input['data']);

        //make multiple purchase
        foreach ($input->offerings as $offering) {
            $newPurchase = new Purchase();
            $newPurchase->title = $offering->title;
            $newPurchase->customer_name = $input->customer_name;
            $newPurchase->quantity = $offering->selectedQuantity;
            $newPurchase->price = $offering->price;
            $newPurchase->total = $offering->price * $offering->selectedQuantity;
            $newPurchase->offering_id = $offering->id;

            if ($newPurchase ->save()) {
                $this->minusOfferingQuantity($offering->id,$offering->selectedQuantity);
            }
        }

        $offerings = Offering::all();
        return response($offerings);
    }

        public function minusOfferingQuantity($offeringID,$quantity) {
        $offering = Offering::find($offeringID);
        $offering->quantity = $offering->quantity - $quantity;
        $offering->save();
    }
}
