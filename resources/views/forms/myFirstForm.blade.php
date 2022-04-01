<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My Form</title>
</head>

<body>
    <div class="container">
        <h1>Basic Form</h1>
        <form action="{{ route('form1.submitAction') }}" target="_self" method="POST">
            @csrf
            <input class="form-control mt-2" placeholder="Name" type="text" name="txtName" />
            <input class="form-control mt-2" placeholder="Age" type="number" name="txtAge" />
            <input class="mt-2" type="radio" name="rdoAgree" /><label>Agree</label>
            <div class="text-center">
                <button class="btn btn-primary mt-2 w-25">Send</button>
            </div>
        </form>
    </div>
</body>

</html>
