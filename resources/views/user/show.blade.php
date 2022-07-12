<html dir="rtl">
<head>
    <title>نمایش اطلاعات کاربر</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
<div class="container mt-3">

    <h5 class="col-md text-center">نمایش اطلاعات </h5><br>
    <table class="table">
        <thead>
        <tr>
            <th>نام و نام خانوادگی</th>
            <th>ایمیل</th>
            <th>نوع کاربر</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
{{--            <td>{{ ( $user->role_id == "1") ? "کاربر عادی" : "اکانت "}} </td>--}}
            <td>{{ ( $user->role_id == "1") ? "کاربر عادی" : ""}} {{ ( $user->role_id == "3") ? "اکانت" : ""}} {{ ( $user->role_id == "2") ? "ادمین" : ""}} </td>

            <td><img src="{{ $user->image }}" height="50" width="50"/></td>

        </tr>

        </tbody>

    </table>


</div>

</body>

</html>
