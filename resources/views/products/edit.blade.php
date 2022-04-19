<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
.imgProduct{
    padding-top: 6px;
}
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Update Product <span class="text-danger">{{ $product->name }}</span></h1>
            <a href="{{ route('products.index') }}" class="btn btn-dark px-5">Return Back</a>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('forms.errors')
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" placeholder="Name">
            </div>
            <div class="mb-3">
                <label>Image</label>
                <input type="file" class="form-control" name="image">
                <img class="img-thumbnail mt-1" width="120px" src="{{ asset('uploads/images/' . $product->image) }}"
                                    alt="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="desc" id="mytextarea" class="form-control" placeholder="Description"
                    rows="5">{{ old('desc', $product->desc) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Price</label>
                <input type="number" class="form-control" value="{{ old('price', $product->price) }}" name="price"
                    placeholder="Price">
            </div>
            <div class="mb-3">
                <label>Discount</label>
                <input type="number" class="form-control" value="{{ old('discount', $product->discount) }}" name="discount"
                    placeholder="Discount">
            </div>
            <select class="form-control" name="category_id" style="font-weight: bold">
                <option value="select" disabled selected> --Select-- </option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $category->id) == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>

            <button class="btn btn-success mt-2">Update</button>


        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('msg'))
            Swal.fire({
            icon: "{{ session('icon') }}",
            text: "{{ session('msg') }}",
            title: 'Oops...',
            })
        @endif

        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
</body>

</html>
