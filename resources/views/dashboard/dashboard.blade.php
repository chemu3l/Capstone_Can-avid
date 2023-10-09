@extends('layouts.app')

@section('sidenav')
    @if (View::hasSection('menu'))
        @yield('menu')
    @endif
    @if (View::hasSection('content'))
        @yield('content')
    @endif
    @if (View::hasSection('settings'))
        @yield('settings')
    @endif
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
@endsection
