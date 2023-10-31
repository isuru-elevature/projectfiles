
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
                <h3 class="mainHeading">Merge Field Coding Tool</h3>
            </div>
            <div class="p-2 text-center">
                <p>Brought to you by</p>
                <img src="{{url('public/images/Logo.svg')}}" width="200px"/>
            </div>
            <div class="p-2 mt-4">
                <p class="heading mb-2">Register</p>
            </div>

            <div class="p-2 formSection">
                <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
               
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class='text-danger'>*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Enter name" name="name" :value="old('name')" required autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number<span class='text-danger'>*</span></label>

                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                            id="mobile_number" placeholder="Enter mobile number" 
                            name="mobile_number"
                             {{-- pattern="[0-9]{5}[-][0-9]{7}[-][0-9]{1}"  --}}
                             minlength="10"
                             maxlength="13"required >
                        @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class='text-danger'>*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Enter email" name="email" :value="old('email')" required >
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name<span class='text-danger'>*</span></label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                            id="company_name" placeholder="Enter company name" name="company_name" :value="old('company_name')" required >
                        @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password<span class='text-danger'>*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Enter password" name="password" :value="old('password')" required >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password<span class='text-danger'>*</span></label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" placeholder="Enter confirm password" name="password_confirmation" :value="old('password_confirmation')" required >
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                   
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary"> {{ __('Register') }}</button>
                       
                    </div>
                    <div class="text-center mt-2">
                    <a class="underline  text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
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
       


       
   