<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
@extends('layouts.app')

<body style="background-color:#f2f2f2;">
    @section('content')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>ข้อมูลครุภัณฑ์</h1>
                </div>


                <form action="{{ route('web.find') }}" method="GET">

                    <div class="input-group" style="margin-bottom:10px;">

                        <div class="mt-2 mb-2 d-grid gap-2 d-md-flex justify-content-md-end "><a
                                href="{{ route('money.create') }}" class="btn btn-primary">เพิ่มครุภัณฑ์</a>

                            <a href="{{ url('pdfCompany') }}" class="btn btn-danger">PDF</a>

                        </div>


                        <input type="text" style=" border-radius: 10px;margin-top:10px;" class="form-control"
                            name="query" placeholder="ค้นหาครุภัณฑ์" value="{{ request()->input('query') }}"
                            id="search">
                        <span class="text-danger">
                            @error('query')
                                {{ $message }}
                            @enderror
                        </span>
                        <button type="submit" class="btn btn-outline-primary"
                            style="margin-left: 5px;margin-top:10px;margin-right: 5px; border-radius :10px;"
                            id="height">ค้นหา</button>
                        <a href="{{ route('companies.index') }}" class="btn btn-outline-danger"
                            style="margin-top:10px;border-radius:10px; "id="height">ล้างการค้นหา </a>


                    </div>
                </form>


            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-hover table-bordered ">
                <thead class="table-dark" style="text-align:center;font-size:16px;">
                    <tr>
                        <th width="90px"></th>
                        <th>ลำดับ</th>
                        <th>หมายเลขครุภัณฑ์</th>
                        <th>วันที่รับเข้าคลัง</th>
                        <th>ชื่อครุภัณฑ์</th>
                        <th>รายละเอียด</th>
                        <th>หน่วยนับ</th>
                        <th>สถานที่ตั้ง</th>
                        <th>ราคา/หน่วย</th>
                        <th>สถานะ</th>
                        <th>หมายเลขครุภัณฑ์เก่า</th>
                        <th>รูปภาพปก</th>
                        <th width="220px">Action</th>
                    </tr>
                </thead>
                @foreach ($companies as $company)
                    <tr style="text-align: center">
                        <td>
                            <a href="{{ route('detail_companies.edit', $company->id) }}" class="text-primary">รายละเอียด</a>
                        </td>
                        <td>{{ $company->id }} </td>
                        <td>{{ $company->num_asset }}</td>
                        <td>{{ $company->date_into }}</td>
                        <td>{{ $company->name_asset }}</td>
                        <td>{{ $company->detail }}</td>
                        <td>{{ $company->unit }}</td>
                        <td>{{ $company->place }}</td>
                        <td>{{ $company->per_price }}</td>
                        <td>{{ $company->status_buy }}</td>
                        <td>{{ $company->num_old_asset }}</td>
                        <td>
                            <img src="/cover/{{ $company->cover }}" class="img-responsive"
                                style="max-height: 150px; max-width:150px" alt="">
                        </td>
                        <td>

                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST">

                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="btn btn-warning">แก้ไขครุภัณฑ์</a>
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('ยืนยันการลบข้อมูลครุภัณฑ์?')">ลบครุภัณฑ์</button>

                            </form>

                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $companies->links('pagination::bootstrap-5') !!}

        </div>
    @endsection


</body>

</html>
