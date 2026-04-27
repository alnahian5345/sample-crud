<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25 red(13, 110, 253, 0.1); }
        .input-group-text { background-color: white; border-right: none; }
        .form-control { border-left: none; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card p-4">
                <div class="card-body">
                    <h3 class="card-title fw-bold text-center mb-4">Inventory Entry</h3>

                    <form id="product_create_from" action="{{Route('createProduct.create')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Wireless Mouse" value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">SKU / Code</label>
                                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" placeholder="PROD-101" value="{{ old('sku') }}">
                                @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Opening Stock</label>
                                <input type="number" name="current_stock" class="form-control @error('current_stock') is-invalid @enderror" value="{{ old('current_stock', 0) }}">
                                @error('current_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-danger">Purchase Price</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                                    <input type="number" step="0.01" name="cost_price" class="form-control @error('cost_price') is-invalid @enderror" placeholder="0.00" value="{{ old('cost_price') }}">
                                </div>
                                @error('cost_price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold text-success">Selling Price</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price') }}">
                                </div>
                                @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                            <i class="bi bi-plus-lg me-1"></i> Save Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
    <tr class="  text-center ">
        <th>SL</th>
        <th>Name</th>
        <th>SKU</th>
        <th>Stock</th>
        <th>Cost Price</th>
        <th>Selling Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->current_stock }}</td>
            <td>{{ $product->cost_price }}</td>
            <td>{{ $product->price }}</td>
            <td class="text-center">

                <!-- ✏️ Edit Button -->
                <a href="javascript:void(0)"
                   class="text-primary editBtn"
                   data-id="{{ $product->id }}"
                   data-name="{{ $product->name }}"
                   data-sku="{{ $product->sku }}"
                   data-stock="{{ $product->current_stock }}"
                   data-cost="{{ $product->cost_price }}"
                   data-price="{{ $product->price }}"
                   data-bs-toggle="modal"
                   data-bs-target="#editModal">

                    <i class="bi bi-pencil-square"></i>
                </a>

                <!-- ❌ Delete Button -->
                <form action="{{Route('product.delete',$product->id)}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-transparent text-danger"
                            onclick="return confirm('Are you sure?')">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{--Eeeeediiit ------------------------------------------}}

<div class="modal fade" id="editModal">
    <div class="modal-dialog">

        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="text" name="name" id="name" class="form-control mb-2">
                    <input type="text" name="sku" id="sku" class="form-control mb-2">
                    <input type="number" name="current_stock" id="stock" class="form-control mb-2">
                    <input type="number" name="cost_price" id="cost" class="form-control mb-2">
                    <input type="number" name="price" id="price" class="form-control mb-2">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>

    </div>
</div>
{{--Eeeeediiit ------------------------------------------}}
<script>
    // document.getElementById('product_create_from').reset();


    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.getAttribute('data-id');

            document.getElementById('name').value = this.getAttribute('data-name');
            document.getElementById('sku').value = this.getAttribute('data-sku');
            document.getElementById('stock').value = this.getAttribute('data-stock');
            document.getElementById('cost').value = this.getAttribute('data-cost');
            document.getElementById('price').value = this.getAttribute('data-price');

            // form action set (important)
            document.getElementById('editForm').action = "/product/update/" + id;
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
