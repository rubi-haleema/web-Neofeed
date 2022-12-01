<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}} ">
    <link rel="stylesheet" href="{!! asset('publicassets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>
    <div class="flex h-screen">
        <div class="m-auto">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <h3 class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Select Dates To Get Astroid By Date</h3>
                        <br><br>
                        <form method="post" action="/getapidata">
                        @csrf
                            <div class="font-medium text-black">
                                FromDate <input type="text" class="border-black ml-3" style="border:1px solid #000" name="fromDate" id="fromDate">
                                Todate <input type="text" class="border-black ml-3" style="border:1px solid #000" name="toDate" id="toDate">
                                <input value="filter" name="filter" id="filter" type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded mt-5">
                                <p>Please Note:  The Feed date limit is only 7 Days</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}} "></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{!! asset('publicassets/js/bootstrap.min.js') !!}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
                $.datepicker.setDefaults({
                    dateFormat:'yy-mm-dd',
                    changeMonth: true,
                      changeYear: true,
                      yearRange: "2012:2020"
                });
                $("#fromDate").datepicker();
                $("#toDate").datepicker();
                $("#filter").click(function(){
                //var a=10; alert(a);
                // alert($("#fromDate").val());exit;
                var fromDate = $('#fromDate').val();
                // alert(from_date);exit;
                var toDate = $('#toDate').val();
                // alert(to_date);exit;
    
               
            });
        });
    </script>
</body>

</html>