<?php

namespace App\Http\Controllers;

use App\Book;
use App\Branch;
use App\Customer;
use App\Package;
use App\Service;
use App\Vehicle;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUseController extends Controller
{
     public function register(Request $request){

    $validated = Validator::make($request->all(),[
        'name' => 'unique:users,name'
    ]);

    if ($validated->fails()){

        $response = [
            'status' => false,
            'message' =>$validated->errors()
        ];
        return response()->json($response);
    }

         $customer = new Customer();
         $customer->first_name = request('first_name');
         $customer->last_name = request('last_name');
         $customer->email = request('email');
         $customer->phone_number = request('phone_number') ;
         $customer->save();

         $id = $customer->id;
         $user= new User();
         $user->user_id = $id;
         $user->name = request('email');
         $user->user_type = '2';
         $user->password = Hash::make(request('password')) ;
         $user->save();

    if ($user->save() && $customer->save()){



        $response = [
            'status' => true,
            'message' => 'Registration Successful',
            'user' => $user,
            'customer' => $customer
        ];
    }else{
        $response = [
            'status' => false,
            'message' => 'Registration Unsuccessful'
        ];
    }

    return response()->json($response);

}

    public function login(Request $request){
        $user = new User();
        $name = request('name');
        $password = request('password');
        $user['name'] = $name;

        if ($user = User::where('name', '=', $name)->first()){

            if (Hash::check($password, $user->password)){

                $response = [
                    'status' => true,
                    'message' => 'Login Successful',
                    'user' => $user
                ];
            }else{

                $response = [
                    'status' => false,
                    'message' => 'Login Unsuccessful'
                ];
            }
            return response()->json($response);

        }else{

            $response = [
                'status' => false,
                'message' => 'Invalid email or password'
            ];
            return response()->json($response);
        }

    }

    public function book(){

         $book = new Book();
        $book->book_date = request('book_date');
        $book->book_time = request('book_time');
        $book->vehicle_id = request('vehicle_id');
        $book->package_id = request('package_id') ;
        $book->service_id = request('service_id');
        $book->customer_id = request('customer_id');
        $book->washer_id = '0';
        $book->status = 'booked' ;

        $package = Package::find($book->package_id);
        $p1 = $package->price;
        $service = Service::find($book->service_id);
        $p2 = $service->price;
        $price = $p1 + $p2;

        $book->amount = $price;
        $book->save();

        if ($book->save()){

            $response = [
                'status' => true,
                'message' => 'Booking Successful',
                'book' => $book
            ];
        }else{
            $response = [
                'status' => false,
                'message' => 'Booking Unsuccessful'
            ];
        }

        return response()->json($response);
    }
    public function allVehicles(){

        $vehicle = Vehicle::all();

        return response()->json($vehicle);
    }

    public function allServices(){

        $service = Service::all();

        return response()->json($service);
    }

    public function allPackages(){

        $package = Package::all();

        return response()->json($package);
    }

    public function BookingDetails($user_id){

        $book = Book::where('customer_id', $user_id)->get();

        return response()->json($book);

    }

    public function allBranches(){

        $branch = Branch::all();

        return response()->json($branch);
    }

    public function BranchDetails($id){

        $branch = Branch::where('id', $id)->get();

        return response()->json($branch);

    }

    public function profileDetails($id){

        $profile = Customer::where('id', $id)->get();

        return response()->json($profile);

    }
}
