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
        <h1>Send Mail</h1>

        <form action="{{ route('sendemailHandle') }}" method="POST" enctype="multipart/form-data">
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
                <label>Age</label>
                <input type="number" name="txtAge" class="form-control @error('txtAge') is-invalid
                @enderror" placeholder="Age" autocomplete='off' />
                @error('txtAge')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="fileImage" class="form-control @error('fileImage') is-invalid
                @enderror" />
                @error('fileImage')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Send</button>
        </form>
    </div>
</body>

</html>
