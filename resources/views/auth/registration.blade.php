<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0;
            border-color: #ccc;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #80bdff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-block {
            border-radius: 0;
        }

        .text-center a {
            color: #007bff;
        }

        .text-center a:hover {
            text-decoration: none;
            color: #0056b3;
        }

        .alert {
            border-radius: 0;
        }
    </style>

    <title>Registration</title>
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center mb-4">Registration</h4>
                    <hr>
                    <form action="{{ route('register-user') }}" method="post">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ old('name') }}">
                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" placeholder="Enter surname" name="surname" value="{{ old('surname') }}">
                            <span class="text-danger">@error('surname'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ old('email') }}" autocomplete="off" required>
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="{{ old('phone') }}">
                            <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" placeholder="Enter address" name="address" value="{{ old('address') }}">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" class="form-control" placeholder="Enter pincode" name="pincode" value="{{ old('pincode') }}">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select id="state-dropdown" class="form-control" name="state" value="{{ old('state') }}">
                                <option value="">-- Select State --</option>
                                @foreach ($states as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="city-dropdown" name="city" value="{{ old('city') }}">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="password" value="" autocomplete="off">
                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Enter confirm password" name="cpassword" value="">
                            <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="login">Already Registered? Login Here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#state-dropdown').on('change', function () {
            var idState = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{ url('get-cities-by-state') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $.each(res.cities, function (key, value) {
                        $("#city-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
</body>
</html>
