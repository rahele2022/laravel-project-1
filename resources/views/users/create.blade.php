<html dir="rtl">
<head>
    <title>صفحه ورود کاربران</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <h5 class="col-md text-center">صفحه ورود کاربران</h5><br>
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
        <form action="/create" method="post">
            @csrf
            <lable class="col-md-2 text-right">نوع کاربر</lable>
            <label class="col-md-2 text-right" >اکانت</label>
            <input type="checkbox" value="account">
            <label class="col-md-2 text-right">کاربر</label>
            <input type="checkbox" value="user"><br><br>
            <label class="col-md text-right"><span class="error">*</span>نام و نام خانوادگی</label>
            <input type="text" name="name" class="form-control"><br>
            <label class="col-md text-right"><span class="error">*</span>ایمیل</label>
            <input type="email" name="email" class="form-control"><br>
            <label class="col-md text-right"><span class="error">*</span>رمز عبور</label>
            <input type="password" name="password" class="form-control"><br>
            <label class="col-md text-right"><span class="error">*</span>تکرار رمز عبور</label>
            <input type="password" name="password-confirm" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-primary">ثبت نام</button>
        </form>

    </div>

</div>

</body>

</html>
