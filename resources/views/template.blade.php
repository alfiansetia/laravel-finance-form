<!DOCTYPE html>
<html>
<head>
    <title>Finance Form</title>

	<link rel="icon" type="image/png" href="{{ asset('logo-tab.png') }}"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
 
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

{{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark sidebarNavigation" data-sidebarClass="navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">TITLE WEB</a>
    <button class="navbar-toggler leftNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('payment_request') }}">Payment Request
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('debit_note') }}">Debit Note
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('logout-action') }}">Logout
                    <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
    </div>
</div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
   <a class="navbar-brand" href="#">
    <img src="https://esrassets.s3.ap-southeast-1.amazonaws.com/esr_dev/uploads/2022/10/30033145/esr-logo.png" width="90" height="40" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('payment_request') }}">Payment Request
                    <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('debit_note') }}">Debit Note
                    <span class="sr-only">(current)</span>
            </a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
            <a class="nav-link" href="{{ route('logout-action') }}"><img src="{{ asset('icon') }}/logout.png" alt="edit" height="20" style="filter: brightness(0) invert(1);">
                <span class="sr-only">(current)</span>
            </a>
    </form>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>


</body>
</html>