<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <link rel="stylesheet" href="{{URL::to('/')}}/resources/css/invoice_style.css">
        <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
        <script src="invoice_script.js"></script>
    </head>
    <body>
        <header>
            <h1>Reservation Detail</h1>
            <address >
                @foreach($about as $item => $value)
                <p>{{ $value->Name }}</p>
                <p>{{ $value->Address }}</p>
                <p>{{ $value->Telephone}}</p>
                @endforeach
            </address>
            <span><img alt="" src="{{ URL::to('/')}}/resources/images/hotel/aboutus/{{$value->Logo}}"></span>
        </header>
        <article>

            @foreach($booking as $item1 => $book )

            <address>
                <p>Name : {{$book->First_name}} {{$book->Last_name}}</p> <br/>
                Address <br/>
                {{$book->Address }} <br/>
                {{$book->Country }}

             </address>
            @endforeach

            <table class="meta">
                <tr>
                    <th><span >Booking Code</span></th>
                    <td><span >{{ $book->Booking_code }}</span></td>
                </tr>
                <tr>
                    <th><span >Transaction Date</span></th>
                    <td><span >January 1, 2012</span></td>
                </tr>
                <tr>
                    <th><span >Arrive Date</span></th>
                    <td><span >{{ $book->Arrive }}</span></td>
                </tr>
                <tr>
                    <th><span >Depart Date</span></th>
                    <td><span >{{ $book->Depart }}</span></td>
                </tr>
            </table>
            <table class="inventory">
                <thead>
                    <tr>
                        <th><span >Room</span></th>
                        <th><span >Description</span></th>
                        <th><span >Number Nights</span></th>
                        <th><span >No of Room</span></th>
                        <th><span >Rate</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span >{{ $book->RoomType_Name }}</span></td>
                        <td><span >{{ substr($book->Description,0,50) }}</span></td>
                        <td><span >{{ $book->Number_nights }} Nights</span></td>
                        <td><span >{{ $book->Quantity }} Rooms</span></td>
                        <td><span data-prefix>Rp. </span><span >{{ $book->Price }}</span></td>

                    </tr>
                </tbody>
            </table>


            <table class="balance">
                <tr>
                    <th><span >Total Room Prices</span></th>
                    <td><span data-prefix>Rp. </span><span>{{$totalRoom}}</span></td>
                </tr>
                <tr>
                    <th><span >Total Additional Prices</span></th>
                    <td><span data-prefix>Rp. </span><span >{{$totalAdditional}}</span></td>
                </tr>
                @foreach($tax as $item4 => $taxx)
                <tr>
                    <th><span >{{$taxx->Tax_Name}}</span></th>
                    <td><span data-prefix>Rp. </span><span >{{ ($totalRoom+$totalAdditional)*$taxx->Tax }}</span></td>
                </tr>
                @endforeach
                <tr>
                    <th><span >Grand Total</span></th>
                    <td><span data-prefix>Rp </span><span>{{$grandTotal }}</span></td>
                </tr>
            </table>
        </article>
        <aside>
            <h1 style="text-align: left;"><span>Additional Service</span></h1>
            <div>
                @foreach($detailAdd as $key => $value4)
                <p>{{$value4->Additional_Name}} @ {{ $value4->Quantity }}</p>
                @endforeach
            </div>
            <br/>
            <h1 style="text-align: left;"><span>Extra Information</span></h1>
            <div>
                <p>Arrival Time : {{ $book->Arrival_time }}</p>
                <p>Flight Detail : {{ $book->Flight_detail }}</p>
                <p>Comment <br/> {{ $book->Comment }}</p>
            </div>
            <br/>
            <h1><span >Booking Policy</span></h1>
            <div >
                <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
            </div>
        </aside>
    </body>
</html>