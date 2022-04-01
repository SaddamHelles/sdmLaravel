<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Mail Form</title>
</head>

<body>
    <div class="container">
        <h1>Register Form</h1>

        <form action="{{ route('formInfo_Submit') }}" method="POST" enctype="">
            @csrf
            {{-- @dump($errors->any())
            @dump($errors->all()) --}}

            @include('forms.errors')
            <div class="mb-3">
                <label>Your Full Name</label>
                <input type="text" name="txtFullName" class="form-control @error('txtFullName') is-invalid
                @enderror" placeholder="Name" />
                @error('txtFullName')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="txtEmail" class="form-control @error('txtEmail') is-invalid
                @enderror" placeholder="Email" autocomplete='off' />
                @error('txtEmail')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="txtPassword" class="form-control @error('txtPassword') is-invalid
                @enderror" placeholder="Password"
                    autocomplete="new-password" />
                    @error('txtPassword')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Confirm</label>
                <input type="password" name="txtPassword_confirmation" class="form-control" placeholder="Confirm" />
            </div>

            <div class="mb-3">
                <label>Biography</label>
                <textarea style="resize: none; margin-top: 5px;" rows="5" name="txtBiography" class="form-control @error('txtBiography') is-invalid
                @enderror"
                    placeholder="Biography"></textarea>
                @error('txtBiography')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary">Register</button>
        </form>
    </div>
</body>

</html>
