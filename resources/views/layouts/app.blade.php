<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CNHS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_class.css') }}">
    <style>
        .container_management {
            background-color: #1e7e34;
            width: 100%;
            height: 70px;
            margin-top: 20px;
            margin-left: 15px;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
            border-radius: 10px;
        }

        .heading_management {
            margin-left: 50px;
            width: 1000px;
            height: 50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .sec1 {
            flex-grow: 7;
            margin-top: 35px;
        }

        .bi bi-megaphone,
        .bi-person-circle,
        .bi-gear-fill,
        .bi-people-fill,
        .bi-123,
        .bi-box-fill,
        .bi-receipt,
        .bi-house-fill {
            color: white;
            font-weight: bold;
            height: 20px;
            width: 30px;
            margin-right: 20px;
            font-size: 12px;
        }

        .main_management {
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .sub1 {
            position: absolute;
            top: 18%;
            left: 0;
            bottom: 0;
            height: 80%;
        }

        .ul_management {
            list-style-type: none;
            border-top-right-radius: 20px;
            border-top-left-radius: 20px;
            height: 100%;
            width: 300px;
            background-color: rgb(0, 60, 8);
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            margin-left: 10px;
        }

        .ul_management li a {
            background-image: linear-gradient(to right,
                    rgba(248, 0, 0, 0.894),
                    rgb(116, 232, 108) 50%,
                    #f1f1f1 50%);
            background-size: 200% 100%;
            background-position: -100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease-in-out;
            text-decoration: none;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        .ul_management li a:before {
            content: '';
            background: #f7f7f7;
            display: block;
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 3px;
        }

        .ul_management li a:hover {
            background-position: 0;
        }

        .ul_management li a:hover::before {
            width: 100%;
        }


        /*

        .ul_management li a {
            text-decoration: none;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        } */

        .item1 {
            background-color: #285430;
            width: 280px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            box-shadow: 2px 3px 5px black;

        }

        .heading2 {
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 20px;

        }

        .value_management {
            color: white;
            font-weight: bold;
            font-size: 30px;
            letter-spacing: 5px;
        }

        .item2 {
            background-color: rgb(8, 88, 12);
            width: 280px;
            height: 150px;
            margin-left: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            box-shadow: 2px 3px 5px black;

        }

        .item3 {
            background-color: #379237;
            width: 280px;
            height: 150px;
            margin-left: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            box-shadow: 2px 3px 5px black;
        }

        .item4 {
            background-color: #82CD47;
            width: 280px;
            height: 150px;
            margin-left: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            box-shadow: 2px 3px 5px black;
        }

        .sub2 {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-top: 30px;
            margin-bottom: 20px;

        }

        .sub3 {
            position: absolute;
            margin-top: 30px;
            width: 80%;
            left: 22%;

        }

        .user-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin-right: 20px;
        }

        .user-icon-svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
            vertical-align: middle;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            margin-left: -200%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .user-dropdown a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .user-dropdown a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div id="app">
        @yield('content')
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</body>

</html>
