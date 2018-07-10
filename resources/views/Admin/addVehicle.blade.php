<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 09/07/2018
 * Time: 12:54
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
        .container {
            position: relative;
            width: 80%;
            max-width: 450px;
            margin: 0 auto;
        }

        form {
            position: relative;
            width: 100%;
            margin: 50px auto;
            padding: 50px;
            background: white;
            text-align: center;
        }

        input {
            display: inline-block;
            width: 100%;
            margin: 20px 0;
            padding: 10px;
            border: 2px dashed lightblue;
            outline: none;
            font-size: 20px;
            font-family: 'Economica', 'Arial', sans-serif;
            font-weight: 400;
            transition: all 0.2s ease;
        }

        input:focus { border-color: deepskyblue; }

        button {
            position: absolute;
            left: calc(50% - 150px / 2);
            bottom: calc(- 50px / 2);
            width: 150px;
            height: 50px;
            padding: 10px 15px;
            margin-top: 20px;
            border: none;
            outline: none;
            cursor: pointer;
            color: white;
            font-family: 'Economica', 'Arial', sans-serif;
            font-size: 20px;
            font-weight: 700;
            background: mediumblue;
            transition: all 0.2s ease;
        }

        button:hover { background: midnightblue; }

        button.valid,
        button.valid:hover { background: mediumseagreen; }

        svg {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        svg path {
            stroke-width: 10px;
            stroke: mediumseagreen;
            fill: none;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        svg path.hidden { opacity: 0; }

        svg path.animate { -webkit-animation: drawBorder 1s linear; animation: drawBorder 1s linear; }

        @-webkit-keyframes drawBorder {
            from {
                stroke-dasharray: 4000;
                stroke-dashoffset: 4000;
            }

            to {
                stroke-dasharray: 4000;
                stroke-dashoffset: 0;
            }
        }

        @keyframes drawBorder {
            from {
                stroke-dasharray: 4000;
                stroke-dashoffset: 4000;
            }

            to {
                stroke-dasharray: 4000;
                stroke-dashoffset: 0;
            }
        }

        h3 {
            margin-top: 0;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 24px;
            font-weight: 700;
        }
    </style>
    <title>Add Vehicle</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Economica:400,700"/>
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
<div class="container">
    <form method="post" action="/Vehicle" enctype="multipart/form-data" style="margin: 3%">
        {{csrf_field()}}
        <h3>Vehicle Details</h3>
        <svg width="100%" height="100%">
            <path class="hidden" d="M0 0 H200 V200 H0 Z"></path>
        </svg>

        Vehicle Name: <input type="text" name="vehicle_name" title="" value="{{$vehicle->vehicle_name or ''}}"><br><br>
        Vehicle Image: <input type="text" name="image" title="" value="{{$vehicle->image or ''}}"><br>
        <input type="hidden" name="id" value="{{$vehicle->id or ''}}">
        <button type="submit">Submit Vehicle</button>
    </form>
</div>

<!--<form method="post" action="/Vehicle" enctype="multipart/form-data" style="margin-top: 3%">
    {{csrf_field()}}

        Vehicle Name: <input type="text" name="vehicle_name" title="" value="{{$vehicle->vehicle_name or ''}}"><br><br>
    Vehicle Image: <input type="text" name="image" title="" value="{{$vehicle->image or ''}}"><br>
    <input type="hidden" name="id" value="{{$vehicle->id or ''}}">
    <button type="submit">Submit Vehicle</button>
</form>-->
</body>

<script>
    var formAnimator = {
        init: function() {
            this.form = document.querySelector("form");
            this.button = document.querySelector("button");
            this.path = document.querySelector("path");
            this.createPath();
            this.form.addEventListener("submit", this.animate, false);
            window.addEventListener("resize", this.createPath);
        },

        createPath: function() {
            console.log("creating path");
            var that = formAnimator;
            that.dPath =
                "M" +
                (that.button.offsetLeft + that.button.offsetWidth) +
                " " +
                that.form.offsetHeight +
                " H" +
                that.form.offsetWidth +
                " V0 H0 V" +
                that.form.offsetHeight +
                " H" +
                that.button.offsetLeft;
            console.log(that.dPath);
            if(that.path.setAttribute("d", that.dPath);)
            {
                that.path.setAttribute("/Vehicle");
            }
        },

        animate: function(e) {
            var that = formAnimator;
            e.preventDefault();
            that.path.classList.add("animate");
            that.path.classList.remove("hidden");
            that.button.classList.add("valid");
            that.path.addEventListener(
                "webkitAnimationEnd",
                function() {
                    this.classList.remove("animate");
                    this.classList.add("hidden");
                    that.button.classList.remove("valid");
                },
                false
            );
        }
    };

    window.addEventListener(
        "DOMContentLoaded",
        function() {
            formAnimator.init();
        },
        false
    );

</script>
</html>
