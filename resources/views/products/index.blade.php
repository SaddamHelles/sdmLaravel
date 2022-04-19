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
</head>

<body>
    {{-- @dump(session('msg')) --}}
    @if (session('msg'))
        <div class="alert alert-success">
            <p class="m-0">{{ session('msg') }}</p>
        </div>
    @endif

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>All Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-dark px-5">Add New Product</a>
        </div>
        <div class="my-3 row">
            <div class="col-md-9">
                <form id="form-search" action="{{ route('products.index') }}" method="get">
                    <input type="hidden" name="sort" id="sort-field" value="{{ request()->sort ?? 'asc' }}" />
                    <input type="hidden" name="perpage" id="perpage-field" value="{{ request()->perpage ?? 5 }}" />
                    <div class="input-group mb-3">
                        <select name="searchBy" id="ddlSelector">
                            <option value="name" {{ request()->searchBy == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ request()->searchBy == 'price' ? 'selected' : '' }}>Price
                            </option>
                            <option value="discount" {{ request()->searchBy == 'discount' ? 'selected' : '' }}>
                                Discount
                            </option>
                        </select>
                        <input type="text" class="form-control" placeholder="Search" name="txtSearch"
                            value="{{ request()->txtSearch }}" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="ddlSortId">
                    <option value="asc" {{ request()->sort == 'asc' ? 'selected' : '' }}>
                        Ascending
                    </option>
                    <option value="desc" {{ request()->sort == 'desc' ? 'selected' : '' }}>Descending
                    </option>
                </select>
            </div>
            <div class="col-md-1">
                <select class="form-select" id="PagesId">
                    <option value="5" {{ request()->perpage == '5' ? 'selected' : '' }}> 5
                    </option>
                    <option value="10" {{ request()->perpage == '10' ? 'selected' : '' }}>10
                    </option>
                    <option value="15" {{ request()->perpage == '15' ? 'selected' : '' }}>15
                    </option>
                    <option value="20" {{ request()->perpage == '20' ? 'selected' : '' }}>20
                    </option>
                </select>
            </div>
        </div>
        <div class="table-content">
            @include('products.ProductsTable');
        </div>
        <a href="#" id="btnMsg">Get Value Form Server Side</a>
        <p id="LableMsg">Msg</p>
    </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>


        $('#btnMsg').click(function(event){
            event.preventDefault();

            $.ajax({
                type: "GET",
                url: "{{ route('showmsg') }}",
                success: function(data){
                    $('#LableMsg').text(data);
                }
            })
        });
        $('input[name = txtSearch]').keyup(function(event){
            event.preventDefault();
            let myurl = $(this).parents('form').serialize();
            
            $.ajax({
                type: "GET",
                url: "{{ route('products.index') }}",
                data: myurl,
                success: function(res){
                    console.log(res);
                    $('.table-content').html(res);
                }
            })
            
        });
        $(document).ready(function() {


            $('.btn-delete').click(function(e){
                e.preventDefault();
                let delete_url = $(this).attr('href');
                let myObject = this;
                let emptyTbody = `<tr>
                                 <td colspan="6" class="text-center">No Data Found</td>
                                 </tr>`;

                // console.log($('table tbody tr').length);
                
                if(confirm('Are you sure??')){
                    $.ajax({
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "delete"
                        },
                        url: delete_url,
                        success: function(res){
                            $(myObject).parent().parent().remove();
                            console.log('SDM ' + res);
                            if($('table tbody tr').length == 0){
                                $('table tbody').append(emptyTbody);
                            }
                            // Toast.fire({
                            //     icons: 'success',
                            //     title: res
                            // });
                            //console.log(res);
                            $('#LableMsg').text(res);
                        }
                })}
                // console.log(delete_url);
                //alert('Delete Btn');
            })
        
            // $('table').DataTable();
            $('#ddlSortId').change(function() {
                var sortValue = $(this).val();
                $('#sort-field').val(sortValue);
                $('#form-search').submit();
            })
            $('#PagesId').change(function() {
                var pageValue = $(this).val();
                $('#perpage-field').val(pageValue);
                $('#form-search').submit();
            })
        });
    </script>
</body>

</html>

 <!-- <tr>
            <td>1</td>
            <td>ABC</td>
            <td>hello.jpg</td>
            <td>54 $</td>
            <td>2%</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>BAN</td>
            <td>Bay.jpg</td>
            <td>78 $</td>
            <td>2%</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Saeed</td>
            <td>Hi.jpg</td>
            <td>92 $</td>
            <td>2%</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Ali</td>
            <td>Welcome.jpg</td>
            <td>30 $</td>
            <td>5%</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Ali</td>
            <td>Welcome.jpg</td>
            <td>30 $</td>
            <td>5%</td>
            <td>
                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr> 
         -->
