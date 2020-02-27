<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/bootstraprtl-v4.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('links')
    <script src="{{asset('js/app.js')}}"></script>
    <title>@yield('title' , 'Laravel')</title>


    <script type="application/javascript">
        function getDataLikeBtn(id) {
            var url = "http://localhost:8000/countLike/" + id; //use any url that have json data  
            var request;

            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest(); //for Chrome, mozilla etc  
            } else if (window.ActiveXObject) {
                request = new ActiveXObject("Microsoft.XMLHTTP"); //for IE only  
            }
            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    var jsonObj = JSON.parse(request.responseText); //JSON.parse() returns JSON object  
                    var elem = document.getElementById('btn-' + id);

                    elem.innerHTML = jsonObj.point;
                }
            }
            request.open("GET", url, true);
            request.send();
        }

        function like(reply_id) {

            var url = "http://localhost:8000/addlike/" + reply_id; //use any url that have json data  
            var request;

            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest(); //for Chrome, mozilla etc  
            } else if (window.ActiveXObject) {
                request = new ActiveXObject("Microsoft.XMLHTTP"); //for IE only  
            }
            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    var jsonObj = JSON.parse(request.responseText); //JSON.parse() returns JSON object

                    if (request.readyState == 4) {
                        var jsonObj = JSON.parse(request.responseText); //JSON.parse() returns JSON object
                        //check sucess dislike or not ...
                        if (jsonObj.status) {
                            console.log('liked');
                        } else {
                            console.log('error');
                        }
                    }

                }
            }

            request.open("GET", url, true);
            request.send();
            getDataLikeBtn(reply_id);

        }

        function disLike(reply_id) {
            var url = "http://localhost:8000/dislike/" + reply_id; //use any url that have json data  
            var request;

            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest(); //for Chrome, mozilla etc  
            } else if (window.ActiveXObject) {
                request = new ActiveXObject("Microsoft.XMLHTTP"); //for IE only  
            }
            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    var jsonObj = JSON.parse(request.responseText); //JSON.parse() returns JSON object
                    //check sucess dislike or not ...
                    if (jsonObj.status) {
                        console.log('dislied');
                    } else {
                        console.log('error');
                    }
                }
            }
            request.open("GET", url, true);
            request.send();
            getDataLikeBtn(reply_id);
        }




        function check(reply_id) {
            var url = "http://localhost:8000/checkStatus/" + reply_id; //use any url that have json data  
            var request;

            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest(); //for Chrome, mozilla etc  
            } else if (window.ActiveXObject) {
                request = new ActiveXObject("Microsoft.XMLHTTP"); //for IE only  
            }

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    var jsonObj = JSON.parse(request.responseText); //JSON.parse() returns JSON object
                    if (jsonObj.status == true) {
                        disLike(reply_id);

                    } else {
                        like(reply_id);

                    }


                }
            }
            request.open("GET", url, true);
            request.send();
        }
    </script>


</head>

<body>
    <!-- Nav Menu -->
    @include('partials.navbar')
    <div class="container">
        @yield('content')
    </div>
</body>

</html>