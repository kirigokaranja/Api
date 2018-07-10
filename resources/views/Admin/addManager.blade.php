<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 09/07/2018
 * Time: 09:09
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 09/07/2018
 * Time: 08:36
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <style>

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a, .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover, .dropdown:hover .dropbtn {
            background-color: red;
        }

        li.dropdown {
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <title>Add Manager</title>
</head>
<body>

<ul>
    <li><a href="/">Home</a></li>

    @if(session()->exists('user_name'))

        @if(session("user_type")=="3")
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Branch</a>
                <div class="dropdown-content">
                    <a href="{{'/Branches'}}">All Branches</a>
                    <a href="{{'/Branch'}}">Add Branch</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Service</a>
                <div class="dropdown-content">
                    <a href="{{'/Services'}}">All Services</a>
                    <a href="{{'/Service'}}">Add Service</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Vehicle</a>
                <div class="dropdown-content">
                    <a href="{{'/Vehicles'}}">All Vehicles</a>
                    <a href="{{'/Vehicle'}}">Add Vehicle</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Package</a>
                <div class="dropdown-content">
                    <a href="{{'/Packages'}}">All Packages</a>
                    <a href="{{'/Package'}}">Add Package</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Manager</a>
                <div class="dropdown-content">
                    <a href="{{'/Managers'}}">All Managers</a>
                    <a href="{{'/Manager'}}">Add Manager</a>
                </div>
                @endif
            </li>
            <li style="float:right"><a href="/logout">Logout</a></li>

        @else
            <li style="float:right"><a href="/login">Login</a></li>@endif
</ul>
<form method="post" action="/Manager" enctype="multipart/form-data" style="margin-top: 3%">
    {{csrf_field()}}

    Manager Name: <input type="text" name="manager_name" title="" value="{{$manager->manager_name or ''}}"><br><br>
    Manager Email: <input type="text" name="email" title="" value="{{$user->name or ''}}"><br><br>
    Manager Branch: <input type="text" name="branch_id" title="" value="{{$manager->branch_id or ''}}"><br><br>
    Manager Password: <input type="text" name="password" title="" value="{{$user->password or ''}}"><br><br>
    <input type="hidden" name="id" value="{{$manager->id or ''}}">
    <button type="submit">Submit Manager</button>
</form>
</body>
</html>