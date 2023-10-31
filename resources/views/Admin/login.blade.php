<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Merge Field</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .btn-primary {
            background-color: #143b59 !important;
            padding: 5px 20px !important;
        }

        .heading {
            color: #143b59;
            font-weight: bold;
            font-size: 20px;
        }

        .mainHeading {
            color: #143b59;
            font-weight: bold;
        }

        .formSection {
            width: 40%;
        }

      

        @media only screen and (max-width: 768px) {
            .formSection {
                width: 100%;
            }
        }

        @media only (min-width: 768px) and (max-width: 992px) {
            .formSection {
                width: 50%;
            }
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column mb-3 justify-content-center align-items-center mt-3 w-100">
            <div class="p-2">
            <img src="{{url('public/images/actionstep_logo.svg')}}" alt="Logo" height="" width="200px">
            </div>
            <div class="p-2">
                <h3 class="mainHeading">Merge Field Coding Tool</h3>
            </div>
            <div class="p-2 text-center">
                <p>Brought to you by</p>
                <img src="{{url('public/images/Logo.svg')}}" width="200px"/>
            </div>
            <div class="p-2 mt-4">
                <p class="heading mb-2">Welcome</p>
            </div>

            <div class="p-2 formSection">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail1" placeholder="Email" name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="exampleInputPassword1" name="password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-start mt-2">
                @if (Route::has('password.request'))
                    <a class=" text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Create an account?') }}
                    </a>
                @endif

                
            </div>
            <div class="d-flex justify-content-start mt-2">
                @if (Route::has('password.request'))
                    <a class=" text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                
            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>