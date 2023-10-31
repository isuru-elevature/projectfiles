
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
        .para{
            color: #143b59;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column mb-3 justify-content-center align-items-center mt-5 w-100">
            <div class="p-2">
            <img src="{{url('public/images/actionstep_logo.svg')}}" alt="Logo" height="" width="200px">
            </div>
            <div class="p-2">
                <h3 class="mainHeading">Merge Field Coading Tool</h3>
            </div>
            <div class="p-2">
                <p>Brought to you by</p>
                <img src="{{url('public/images/Logo.svg')}}" width="200px"/>
            </div>
            <div class="p-2">
                <p class="heading">Reset Password</p>
            </div>

            <div class="p-2 formSection">
                <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="exampleInputEmail1" placeholder="Enter Email" name="email" :value="old('email')" required autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <p class="para">An email will be send to you with a link to create a new password</p>
                   
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
           


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
       