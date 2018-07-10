<?php

namespace App\Http\Controllers;

use App\Book;
use App\Branch;
use App\Manager;
use App\Package;
use App\Service;
use App\User;
use App\Vehicle;
use App\Washer;
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function showAddBranchForm(){
        return view('Admin.addBranch');
    }

    public function showallBranches(){
        $branch = Branch::all();
        return view('Admin.Branch', ['branch' =>$branch]);
    }

    public function viewSpecificBranch($id){
        $branch = Branch::find($id);
        return view('Admin.addBranch', ['branch' => $branch]);
    }


    public function showAddManagerForm(){
        return view('Admin.addManager');
    }

    public function showallManagers(){
        $manager = Manager::all();
        $user = User::all();
        return view('Admin.Manager', ['manager' =>$manager], ['user' => $user]);
    }

    public function viewSpecificManager($id){
        $manager = Manager::find($id);
        $user = User::all()->where('user_id', $id);
        return view('Admin.addManager', ['manager' => $manager], ['user' => $user]);
    }


    public function showAddVehicleForm(){
        return view('Admin.addVehicle');
    }

    public function showallVehicles(){
        $vehicle = Vehicle::all();
        return view('Admin.Vehicle', ['vehicle' =>$vehicle]);
    }

    public function viewSpecificVehicle($id){
        $vehicle = Vehicle::find($id);
        return view('Admin.addVehicle', ['vehicle' => $vehicle]);
    }


    public function showAddPackageForm(){
        return view('Admin.addPackage');
    }

    public function showallPackages(){
        $package = Package::all();
        return view('Admin.Package', ['package' =>$package]);
    }

    public function viewSpecificPackage($id){
        $package = Package::find($id);
        return view('Admin.addPackage', ['package' => $package]);
    }


    public function showAddServiceForm(){
        return view('Admin.addService');
    }

    public function showallServices(){
        $service = Service::all();
        return view('Admin.Service', ['service' =>$service]);
    }

    public function viewSpecificService($id){
        $service = Service::find($id);
        return view('Admin.addService', ['service' => $service]);
    }


    public function showAddWasherForm(){
        return view('Admin.addWasher');
    }

    public function showallWashers(){
        $washer = Washer::all();
        return view('Admin.Washer', ['washer' =>$washer]);
    }

    public function viewSpecificWasher($id){
        $washer = Washer::find($id);
        return view('Admin.addWasher', ['washer' => $washer]);
    }


    public function login(){
        return view('login');
    }

    public function assignWasher(){
        return view('assignWasher');
    }

    public function confirmWash(){
        return view('cofirmWash');
    }

    public function confirmPayment(){
        return view('confirmPayment');
    }

    public function countBooked(){
        $booked = Book::all()->where('status', 'booked')->count();
        $assigned = Book::all()->where('status', 'assigned')->count();
        $washed = Book::all()->where('status', 'washed')->count();
        return view('navigation bar.nav', ['booked' => $booked], ['assigned' => $assigned], ['washed' => $washed]);
    }
}
