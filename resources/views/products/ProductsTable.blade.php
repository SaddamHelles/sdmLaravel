<table class="table table-striped table-bordered table-hover align-middle">
            <thead>
                <tr class="table-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img width="80px" src="{{ asset('uploads/images/' . $product->image) }}"
                                    alt="{{ $product->name }}"></td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->category_id }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{route('products.destroy', $product->id)}}" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></a>
                                {{-- <form class="d-inline" action="{{ route('products.destroy', $product->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    {{ method_field('delete') }}
                                    <button onclick="return confirm('هل انت نتاكد من عملية الحذف؟')"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"> </i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No Data Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{ $products->appends($_GET)->links() }}