<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
</head>
<body>

<ul>
    <li><a href="#home">Home</a></li>
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
        </li>
        <li style="float:right"><a href="/logout">Logout</a></li>
    @endif
    <li style="float:right"><a href="/login">Login</a></li>
</ul>

<div class="container" style="margin-top: 5%">
    <div class="row">
        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <center>
                <h1>Login</h1>

                <!--Check for sucess message-->
                @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{session()->get('message')}}
                    </div>
                @endif

                @if(session()->has('message_logout'))
                    <div class="alert alert-success">
                        {{session()->get('message_logout')}}
                    </div>
                @endif

                <form method="post" action="/Login" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="text" placeholder="Email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control" required><br>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </center>
        </div>

        <div class="col-lg-4"></div>
    </div>
</div>

</body>
</html>