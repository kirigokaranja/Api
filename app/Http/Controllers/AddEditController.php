<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Package;
use App\Service;
use App\User;
use App\Manager;
use App\Vehicle;
use App\Washer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AddEditController extends Controller
{
    public function addBranch(){
        $branch = null;
        if (request('id') !== null){
            $branch = Branch::find(request('id'));
            $branch->branch_name = request('branch_name');
            $branch->latitude = request('latitude');
            $branch->longitude = request('longitude');
            $branch->opening_time = request('opening_time');
            $branch->closing_time = request('closing_time');
            $branch->save();
            return redirect('/Branches');

        }else{
            $branch = new Branch();
            $branch->branch_name = request('branch_name');
            $branch->latitude = request('latitude');
            $branch->longitude = request('longitude');
            $branch->opening_time = request('opening_time');
            $branch->closing_time = request('closing_time');
            $branch->save();
            return redirect('/Branches');
        }
    }

    public function addManager(){
        $manager = null;
        if (request('id') !== null){
            $manager = Manager::find(request('id'));
            $manager->manager_name = request('manager_name');
            $manager->branch_id = request('branch_id');
            $manager->save();

            $id = $manager->id;
            $user = new User();
            $user->user_id = $id;
            $user->name = request('email');
            $user->password = request('password');
            $user->user_type = '2';
            $user->save();

            if ($user->save() && $manager->save()){
                return redirect('/Managers');
            }

        }else{
            $manager = new Manager();
            $manager->manager_name = request('manager_name');
            $manager->branch_id = request('branch_id');
            $manager->save();

            $id = $manager->id;
            $user = new User();
            $user->user_id = $id;
            $user->name = request('email');
            $user->password = request('password');
            $user->user_type = '2';
            $user->save();

        if ($user->save() && $manager->save()){
            return redirect('/Managers');
        }

        }
    }


    public function addVehicle(){
        $vehicle = null;
        if (request('id') !== null){
            $vehicle = Vehicle::find(request('id'));
            $vehicle->vehicle_name = request('vehicle_name');
            $vehicle->image = request('image');
            $vehicle->save();
            return redirect('/Vehicles');

        }else{
            $vehicle = new Vehicle();
            $vehicle->vehicle_name = request('vehicle_name');
            $vehicle->image = request('image');
            $vehicle->save();
            return redirect('/Vehicles');
        }
    }


    public function addPackage(){
        $package = null;
        if (request('id') !== null){
            $package = Package::find(request('id'));
            $package->package_name = request('package_name');
            $package->price = request('price');
            $package->time_period = request('time_period');
            $package->details = request('details');
            $package->save();
            return redirect('/Packages');

        }else{
            $package = new Package();
            $package->package_name = request('package_name');
            $package->price = request('price');
            $package->time_period = request('time_period');
            $package->details = request('details');
            $package->save();
            return redirect('/Packages');
        }
    }


    public function addService(){
        $service = null;
        if (request('id') !== null){
            $service = Service::find(request('id'));
            $service->service_name = request('service_name');
            $service->duration = request('duration');
            $service->price = request('price');
            $service->details = request('details');
            $service->save();
            return redirect('/Services');

        }else{
            $service = new Service();
            $service->service_name = request('service_name');
            $service->duration = request('duration');
            $service->price = request('price');
            $service->details = request('details');
            $service->save();
            return redirect('/Services');
        }
    }


    public function addWasher(){
        $washer = null;
        if (request('id') !== null){
            $washer = Washer::find(request('id'));
            $washer->washer_name = request('washer_name');
            $washer->branch_id = request('branch_id');
            $washer->save();
            return redirect('/Washers');

        }else{
            $washer = new Washer();
            $washer->washer_name = request('washer_name');
            $washer->branch_id = request('branch_id');
            $washer->save();
            return redirect('/Washers');
        }
    }


    public function login(Request $request){
        //no need for validation
        $user = new User();

        //check if the email address exists
        $email = $request->input('email');
        $user_pass = $request->input('password');
        $user['name'] = $email;
        $user['password'] = $user_pass;

        if($user = User::where('name','=',$email)->first()){
            /*
             *  email exists
             *  Go to database and select password
             */

            if($user = User::where('password','=',$user_pass)->first()){
                //$user['authorize'] = "authorized";

                //store a piece of info after login
                session(['user_id'=>$user->id]);
                session(['user_name'=>$user->name]);
                session(['user_type'=>$user->user_type]);
                return view('home');

            }else{
                //$user['authorize'] = "Not Authorized";
                return back()->with('message','Invalid Email or password');
            }

        }else{

            return back()->with('message','Invalid Email or password');
        }

    }

    public function logout(Request $request){
        $request->session()->flush();//errase all sessions
        //go back to homepage
        return redirect('/login')->with('message_logout','You have logged out sucessfully');
    }
}
