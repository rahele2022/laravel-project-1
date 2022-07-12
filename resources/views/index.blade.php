@extends('user.header')

<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        .button {
            background-color: green;
            border: none;
            color: white;
            padding: 5px 15px;
            font-size: 16px;
            border-radius: 4px;
            text-align: center;
        }

        .button1 {
            float: left;
        }

        .button2 {
            background-color: dodgerblue;
            padding: 3px 8px;
        }

        .button3 {
            background-color: red;
            padding: 3px 15px;
        }

        .button4 {
            background-color: #6f42c1;
            padding: 3px 15px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="page-header">
                <h2>لیست کاربران</h2>
                @can('create' , $user)

                    <button class="button button1" onclick="document . location = '/users/create'">افزودن کاربر جدید
                    </button>
                @endcan
            </div>
            <table class="table">

                <thead>
                <tr>
                    <th scope="col">نام</th>
                    <th scope="col">ایمیل</th>
                    <th scope="col">اقدامات</th>
                </tr>
                </thead>


                <tbody>
                @foreach($user as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            <button class="button button4" onclick="document . location = '/users/{{ $user->id }}'">
                                نمایش اطلاعات
                            </button>
                        </td>


                        <td>

                            @can('edit', $user)
                                <button class="button button2"
                                        onclick="document . location = '/users/{{ $user->id }}/edit'">ویرایش
                                </button>
                            @endcan

                        </td>

                        <td>
                            <form action="/users/{{$user->id}}" method="post">
                                @csrf
                                @method('delete')


                                @can('destroy' , $user)
                                    <button class="button button3">حذف</button>
                                @endcan

                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
