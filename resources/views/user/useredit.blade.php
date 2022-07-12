<html dir="rtl">
<head>
    <title>ویرایش اطلاعات کاربر</title>
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
        <form action="/users/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <lable class=" text-right">نوع کاربر</lable>
{{--            <div class="form-check-inline">--}}
{{--                <input type="radio" class="form-check-input" id="radio1" name="role_id" value="3" {{ ( $user->role_id == "3") ? "checked" : "" }}>--}}
{{--                <label class="form-check-label" for="radio1">اکانت</label>--}}
{{--            </div>--}}
            <div class="form-check-inline">
                <input type="radio" class="form-check-input" id="radio2" name="role_id" value="1" {{ ( $user->role_id == "1") ? "checked" : "" }}>
                <label class="form-check-label" for="radio2">کاربر عادی</label>
            </div><br><br>
            <label class="col-md text-right"><span class="error">*</span> نام و نام خانوادگی </label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}"><br>
            <label class="col-md text-right"><span class="error">*</span>ایمیل</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}"><br>
            <label class="col-md text-right"><span class="error">*</span>رمز عبور</label>
            <input type="password" name="password" class="form-control"><br>
            <label class="col-md text-right"><span class="error">*</span>تکرار رمز عبور</label>
            <input type="password" name="password-confirm" class="form-control"><br>
            <label class="col-md text-right">تصویر</label>
            <input type="file" name="image" class="form-control"><br>
            <button type="submit" name="submit" class="btn btn-info">ویرایش</button>
        </form>

    </div>

</div>

</body>

</html>
