<html dir="rtl">
<head>
    <title>صفحه ورود کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .error {
           color: red;
            text-align: left;
        }
        .form {
            text-align: center;
            margin-left: 35%;
            margin-right: 35%;
            width: 30%;
        }
    </style>

</head>
<body>
    <div class="container mt-3">
        <div class="form">
            <div class="page-header">
                <h5 class="col-md text-center">ویرایش اطلاعات کاربران</h5><br>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/admin/{{ $user->id }}/edit" method="post">
                @csrf
                @method('put')
                <label class="col-md text-right"><span class="error">*</span>نام</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}"><br>
                <label class="col-md text-right"><span class="error">*</span>نام خانوادگی</label>
{{--                <input type="text" name="family" class="form-control" value="{{ $customer->family }}"><br>--}}
{{--                <label class="col-md text-right"><span class="error">*</span>ایمیل</label>--}}
                <input type="text" name="email" class="form-control" value="{{ $user->email }}"><br>
{{--                <label class="col-md text-right"><span class="error">*</span>سن</label>--}}
{{--                <input type="text" name="age" class="form-control" value="{{ $customer->age }}"><br>--}}
                <button type="submit" name="submit" class="btn btn-info">ویرایش</button>
            </form>

        </div>

    </div>

</body>

</html>
