<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้งาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
@extends('layouts.app')

<body>
    @section('content')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 text-center" id="brData">
                    <h1>จัดการผู้ใช้งาน</h1>
                </div>

                <div class="mt-2 mb-2 " style="margin-left:92%"><a href="{{ route('companies.index') }}"
                        class="btn btn-success">ย้อนกลับ</a>
                </div>

            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-hover table-bordered">
                <thead class="table-dark" style="text-align:center;font-size:16px;">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อผู้ใช้</th>
                        <th>อี-เมล ผู้ใช้งาน</th>
                        <th>เลขอัตรา (เลขประจำตำแหน่ง)</th>
                        <th>ตำแหน่ง</th>
                        <th>ชื่อฝ่าย</th>
                        <th>ชื่องาน</th>
                        <th width="220px">Action</th>
                    </tr>
                </thead>
                @foreach ($user as $users)
                    <tr>
                        <td>{{ $users->id }}</td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->num_position }}</td>
                        <td>{{ $users->position }}</td>
                        <td>
                            {{ $users->department == 'other' && isset($users->other_department) ? $users->other_department : $users->department }}
                        </td>
                        <td>{{ $users->task }}</td>
                        <td>
                            <form action="{{ route('user.destroy', $users->id) }}" method="POST">
                                <a href="{{ route('user.edit', $users->id) }}" class="btn btn-warning">แก้ไขผู้ใช้งาน</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('ยืนยันการลบผู้ใช้งาน?')">ลบผู้ใช้งาน</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $user->links('pagination::bootstrap-5') !!}

        </div>
    @endsection

</body>

</html>
