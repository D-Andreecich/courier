<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UserOrder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function sendMarker(){
        $km = 1000;
        $order2 = Order::all();
        // Start XML file, echo parent node
        echo '<markers>';
        // Iterate through the rows, printing XML nodes for each
        foreach ($order2 as $latlng){
            $lat = $latlng->coordinate_a->getLat();	// 40.7484404
            $lng = $latlng->coordinate_a->getLng();	// -73.9878441
            // Add to XML document node
            echo '<marker ';
            echo 'address="' . $latlng->address_a . '" ';
            echo 'lat="' . $lat. '" ';
            echo 'lng="' . $lng. '" ';
            echo 'distance="' . $latlng->distance/$km . 'km' . '" ';
            echo 'weigh="' . $latlng->weigh. '" ';
            echo 'width="' . $latlng->width. '" ';
            echo 'height="' . $latlng->height. '" ';
            echo 'depth="' . $latlng->depth. '" ';
            echo 'price="' . $latlng->price. '" ';
            echo 'time_of_receipt="' . $latlng->time_of_receipt. '" ';
            echo 'distance="' . $latlng->distance/$km . 'km' . '" ';
            echo '/>';
        }
        // End XML file
        echo '</markers>';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sendMarker();
       // $order = Order::all()->where('status', 'published');
        $orders = [];

        if (Order::all()->count()) {
            $orders = Order::all()->where('status', 'published');
        }

        return view('home', ['orders' => $orders]);
    }
}
