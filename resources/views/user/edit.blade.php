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
        <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <h1 class="nav-link text-light" href="">Edit User</h1>
                </li>
            </ul>
        </div>
    </nav>



    @if($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>
            {{$message}}
        </strong>
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <h3>แก้ไขสมาชิก{{$users->id}}</h3>
                    <form method="POST" action="{{route('user.update',$users->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label>ชื่อสมาชิก</label>
                            <input type="text" name="name" class="form-control"
                            value="{{old('name',$users->name)}}">
                            @if($errors->has('name'))
                            <span class="text-danger">กรุณาใส่ชื่อสมาชิก</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>email สมาชิก</label>
                            <input type="text" name="email" class="form-control"
                            value="{{old('total',$users->email)}}">
                            @if($errors->has('email'))
                            <span class="text-danger">กรุณาใส่ email </span>
                            @endif
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-2">
                            <button type="submit" class="btn btn-primary me-md-2">บันทึก</button>
                            <a href="/admin/user" class="btn btn-primary me-md-2">ยกเลิก</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>