<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Test_image</title>
</head>

<body>


    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light ms-5 fs-1" href="/admin/home">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light ms-5 fs-1" href="/admin/user">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light ms-5 fs-1" href="/dashboard">Dashboard</a>
            </li>
        </ul>
    </nav>



    <div class="row">

        <div class="d-grid gap-2  justify-content-md-end">
            <a href="/product/create" class="btn btn-dark mt-2">NewProduct</a>
        </div>
    </div>




    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>
            {{$message}}
        </strong>
    </div>
    @endif

    <div class="container mt-3">
        <h2>สินค้าทั้งหมด</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รูปสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ราคาสินค้า</th>
                    <th>จำนวนสินค้า</th>
                    <th>แก้ไข/ลบ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td><img src="{{ ('/images/'.$product->image) }}" class="rounded-circle" width="50" height="50"></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->total}}</td>
                    <td>
                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-info btn-sm">แก้ไข</a>
                        <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>