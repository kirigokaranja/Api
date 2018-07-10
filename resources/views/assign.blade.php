<?php
/**
 * Created by PhpStorm.
 * User: kirigo karanja
 * Date: 10/07/2018
 * Time: 15:33
 */
?>
<p>Select Washer</p>

<form action="/assign/{{$book->id}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" name="id" value="{{$book->id or ''}}"><br><br>
    <input type="text" name="book_date" value="{{$book->book_date or ''}}"><br><br>
    <input type="text" name="book_time" value="{{$book->book_time or ''}}"><br><br>
    <input type="text" name="vehicle_id" value="{{$book->vehicle_id or ''}}"><br><br>
    <input type="text" name="package_id" value="{{$book->package_id or ''}}"><br><br>
    <input type="text" name="service_id" value="{{$book->service_id or ''}}"><br><br>
    <input type="text" name="customer_id" value="{{$book->customer_id or ''}}"><br><br>
@foreach($washer as $wash)


        <select name="washer">
            <option value="{{$wash->id}}">{{$wash->washer_name}}</option>
        </select> @endforeach
    <button type="submit">Submit Washer</button>
</form>
