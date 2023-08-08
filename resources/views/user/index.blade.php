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
                <h1 class="nav-link text-light" href="">{{Auth::user()->name}}</h1>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-expand-sm bg-primary">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand text-light ms-4" href="/user/index">Shop</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand text-light ms-4" href="/shoplist">สินค้าที่สั่ง</a>
            </li>
            <li class="nav-item">
                <a class="navbar-brand text-light ms-4" href="/dashboard">กลับหน้า Dashboar</a>
            </li>
        </ul>
    </nav>



    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>
            {{$message}}
        </strong>
    </div>
    @endif





    <div class="container mt-5 center">
        <div class="row">
            @foreach($products as $product)
            <div class="card mt-2 ms-4" style="width: 18rem; ">
                <img src="{{ ('/images/'.$product->image) }}" width="150" height="150">
                <div class="card-body">
                    <h5 class="card-title">ชื่อ :: {{$product->name}}</h5>
                    <hr noshade>
                    <p class="card-text">รายละเอียดสินค้า :: <br>{{$product->title}}</p>
                    <hr noshade>
                    <p class="card-text">จำนวนที่มี :: {{$product->total}}</p>
                    <hr noshade>
                    <p class="card-text">ราคาสินค้า :: {{$product->price}}</p>

                    <form action="/add_to_cart" method="POST" >
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <button class="btn btn-primary">สั่งซื้อสินค้า</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>