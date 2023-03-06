<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดข้อมูลครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../layouts/user.blade.php">
</head>
@extends('layouts.user')

<body>
    @section('content')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 text-center" id="brData">
                    <h3>รายละเอียดข้อมูลครุภัณฑ์</h3>
                </div>

                <div style="text-align: right">
                    <a class="btn btn-warning" href="{{ url('admin/home') }}">
                        ย้อนกลับ
                    </a>
                </div>


            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <form action="{{ route('detail_companies.index', $company->id) }}" method="POST" enctype="multipart/form-data"
                style="margin-left:3%;">
                <div class="container my-3 mt-3 pt-3">
                    <div class="row">
                        <div class="col mt-1 text-center">
                            <h4>รูปภาพปก</h4><br>
                            <img src="{{ asset('/cover/' . $company->cover) }}" width="250px" class="border"
                                alt="Image">
                        </div>
                        <div class="col mt-1 text-center">
                            <h4>รูปภาพ</h4> <br>
                            @foreach ($images as $img)
                                <img src="/images/{{ $img->image }}" width="470px" class="border" alt="Image">
                            @endforeach
                        </div>

                        <div class="col" style="background-color:white;padding:15px">

                            <p><b>หมายเลขครุภัณฑ์</b> : {{ $company->num_asset }}</p>
                            <p><b>วันที่รับเข้าคลัง</b> : {{ $company->date_into }}</p>
                            <p><b>ชื่อครุภัณฑ์</b> : {{ $company->name_asset }} </p>
                            <p class="text-break"><b>รายละเอียด</b> : {{ $company->detail }}</p>
                            <p><b>หน่วยนับ</b> : {{ $company->unit }} </p>
                            <p><b>สถานที่ตั้ง</b> : {{ $company->place }} </p>
                            <p><b>ราคา/หน่วย</b> : {{ $company->per_price }} </p>
                            <p><b>สถานะ</b> : {{ $company->status_buy }} </p>
                        </div>
                        <div class="col" style="background-color:#000;color:white;padding:15px">
                            <p><b>หมายเลขครุภัณฑ์เก่า</b> : {{ $company->num_old_asset }} </p>
                            <p><b>ผู้ครอบครองครุภัณฑ์</b> : <br>{{ $company->fullname }} </p>
                            <p><b>ฝ่ายที่ครอบครองครุภัณฑ์</b> : {{ $company->department }} </p>
                            <p><b>เลขอัตรา (เลขประจำตำแหน่ง)</b> : {{ $company->num_department }} </p>
                            <p><b>ชื่อ - สกุล ผู้นำเข้าคลัง</b> : {{ $company->name_info }} </p>
                            @foreach ($cashes as $cash)
                                <p><b>เลขแหล่งเงิน</b> : {{ $cash->code_money }} </p>
                                <p><b>ชื่อแหล่งเงิน</b> : {{ $cash->name_money }} </p>
                                <p><b>ปีงบประมาณ</b> : {{ $cash->budget }} </p>
                            @endforeach
                        </div>


                    </div>

                </div>

            </form>

        </div>
    @endsection


</body>

</html>
