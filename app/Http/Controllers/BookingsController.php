<?php

namespace App\Http\Controllers;

use App\Book;
use App\Package;
use App\Service;
use App\Washer;
use Illuminate\Http\Request;

class BookingsController extends Controller
{

    public function viewSpecificBooking($id){
        $book = Book::find($id);
        $washer = Washer::all();
        return view('assign', ['book' => $book], ['washer' =>$washer]);
    }

    public function showBookings(){
        $booking = Book::all()->where('status', 'booked');
        return view('assignWasher', ['booking' =>$booking]);
    }

    public function confirmWash(){
        $booking = Book::all()->where('status', 'assigned');
        return view('cofirmWash', ['booking' =>$booking]);
    }

    public function confirmPay(){
        $booking = Book::all()->where('status', 'washed');
        return view('confirmPayment', ['booking' =>$booking]);
    }
    public function AssignWasher($id){
        $book = Book::find($id);
        $book->washer_id = '1';
        $book->book_date = request('book_date');
        $book->book_time = request('book_time');
        $book->vehicle_id = request('vehicle_id');
        $book->package_id = request('package_id') ;
        $book->service_id = request('service_id');
        $book->customer_id = request('customer_id');
        $book->status = 'assigned' ;
        $book->save();
        return redirect('/confirmWash');
    }

    public function confirm($id){
        $book = Book::find($id);
        $book->status = 'washed' ;
        $book->save();
        return redirect('/confirmPayment');
    }

    public function payment($id){
        $book = Book::find($id);
        $book->status = 'payed' ;
        $book->save();
        return redirect('/assignWasher');
    }
}
