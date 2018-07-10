<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 10/07/2018
 * Time: 13:32
 */
?>
        <!DOCTYPE html>
<html>
<head>
    <title>Confirm Payment</title>
</head>
<body>

@include('navigation bar.nav')

<div style="text-align: center;">

    <table border="1" style="margin-top: 3%">
        <tr>
            <th>Booking Id</th>
            <th>Booking Date </th>
            <th>Booking Time</th>
            <th>Vehicle</th>
            <th>Package</th>
            <th>Service</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Washer</th>
        </tr>
        @foreach($booking as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->book_date}}</td>
                <td>{{$book->book_time}}</td>
                <td>{{$book->vehicle_id}}</td>
                <td>{{$book->package_id}}</td>
                <td>{{$book->service_id}}</td>
                <td>{{$book->customer_id}}</td>
                <td>{{$book->status}}</td>
                <td>{{$book->washer_id}}</td>
                <td>
                    <form action="/pay/{{$book->id}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$book->id or ''}}"><br><br>
                        <button type="submit">Confirm Payment</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
