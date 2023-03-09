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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
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

            <!-- แจ้งเตือน Alert -->

            <!-- jQuery and SweetAlert JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

            @if (Session::has('success'))
                <script>
                    $(function() {
                        swal({
                            title: "สำเร็จ!",
                            text: "{{ Session::get('success') }}",
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        });
                    });
                </script>
            @endif

            @if (Session::has('delete'))
                <script>
                    $(function() {
                        swal({
                            title: "สำเร็จ!",
                            text: "{{ Session::get('delete') }}",
                            icon: "success",
                            timer: 2000,
                            buttons: false,
                        });
                    });
                </script>
            @endif

            {{-- --------------------------------------------------------------------------------------------------------------------------- --}}

            <table class="table table-hover table-bordered ">
                <thead class="table-dark" style="text-align:center;font-size:16px;">
                    <tr>
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
                        <td>{{ $company->id }} </td>
                        <td>{{ $company->num_asset }}</td>
                        <td>{{ $company->date_into }}</td>
                        <td>{{ $company->name_asset }}</td>
                        {{-- <td>{{ $company->detail }}</td> --}}
                        <td>
                            <a href="{{ route('detail_companies.edit', $company->id) }}"
                                class="text-primary">รายละเอียด</a>
                        </td>
                        <td>{{ $company->unit }}</td>
                        <td>{{ $company->place }}</td>

                        @php
                            $doubleValue = $company->per_price;
                            $formattedValue = number_format($doubleValue, 2); // Output: "1,234.57"
                            
                        @endphp

                        <td>{{ $formattedValue }}</td>
                        {{-- <td>{{ $company->per_price }}</td> --}}
                        <td>{{ $company->status_buy }}</td>
                        <td>{{ $company->num_old_asset }}</td>
                        <td>
                            <img src="/cover/{{ $company->cover }}" class="img-responsive"
                                style="max-height: 150px; max-width:150px" alt="">
                        </td>
                        <td>

                            {{-- <form action="{{ route('companies.destroy', $company->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger mt-1"
                                onclick="return confirm('ยืนยันการลบครุภัณฑ์?');">ลบครุภัณฑ์</button>
                            </form> --}}
                            <div class="delete-row">
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="btn btn-warning">แก้ไขครุภัณฑ์</a>

                                <button class="delete-btn"
                                    data-target="#delete-alert-{{ $company->id }}">ลบครุภัณฑ์</button>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete-alert hidden" id="delete-alert-{{ $company->id }}">
                                        <p>คุณต้องการจะลบข้อมูลครุภัณฑ์ใช่หรือไม่?</p>
                                        <button class="delete-confirm" data-form=".delete-form">ใช่,
                                            ต้องการลบครุภัณฑ์</button>
                                        <button class="delete-cancel">ไม่</button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $company->id }}">
                                </form>
                            </div>



                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $companies->links('pagination::bootstrap-5') !!}

        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteBtns = document.querySelectorAll('.delete-btn');
            const deleteAlerts = document.querySelectorAll('.delete-alert');
            const deleteConfirms = document.querySelectorAll('.delete-confirm');
            const deleteCancels = document.querySelectorAll('.delete-cancel');

            deleteBtns.forEach(deleteBtn => {
                deleteBtn.addEventListener('click', (e) => {
                    const target = e.target.dataset.target;
                    const deleteAlert = document.querySelector(target);
                    deleteAlert.classList.remove('hidden');
                    centerDeleteAlert(deleteAlert);
                });
            });

            // deleteCancels.forEach(deleteCancel => {
            //     deleteCancel.addEventListener('click', (e) => {
            //         console.log('Button clicked');
            //         const deleteAlert = e.target.closest('.delete-alert');
            //         console.log(deleteAlert);
            //         deleteAlert.classList.add('hidden');
            //     });
            // });


            deleteCancels.forEach(deleteCancel => {
                deleteCancel.addEventListener('click', (e) => {
                    e.preventDefault();
                    const deleteAlert = e.target.closest('.delete-alert');
                    deleteAlert.classList.add('hidden');
                });
            });



            // deleteConfirms.forEach(deleteConfirm => {
            //     deleteConfirm.addEventListener('click', (e) => {
            //         const targetForm = e.target.dataset.form;
            //         const deleteForm = document.querySelector(targetForm);
            //         fetch(deleteForm.action, {
            //                 method: 'DELETE',
            //                 headers: {
            //                     'X-CSRF-TOKEN': document.querySelector(
            //                         'meta[name="csrf-token"]').getAttribute('content'),
            //                     'Content-Type': 'application/json'
            //                 }
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.success) {
            //                     const targetRow = e.target.closest('.delete-row');
            //                     targetRow.remove();
            //                 }
            //                 const deleteAlert = e.target.closest('.delete-alert');
            //                 deleteAlert.classList.add('hidden');
            //             })
            //             .catch(error => {
            //                 console.error(error);
            //             });
            //     });
            // });


            deleteConfirms.forEach(deleteConfirm => {
                deleteConfirm.addEventListener('click', (e) => {
                    const targetForm = e.target.dataset.form;
                    const deleteForm = document.querySelector(targetForm);
                    const id = deleteForm.querySelector('input[name="id"]')
                        .value; // Get the ID from the input field
                    fetch(deleteForm.action + '/' + id, { // Append the ID to the URL
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const targetRow = e.target.closest('.delete-row');
                                targetRow.remove();
                            }
                            const deleteAlert = e.target.closest('.delete-alert');
                            deleteAlert.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error(error);
                        });
                });
            });


            function centerDeleteAlert(deleteAlert) {
                const alertWidth = deleteAlert.offsetWidth;
                const alertHeight = deleteAlert.offsetHeight;
                const screenWidth = window.innerWidth;
                const screenHeight = window.innerHeight;
                const alertLeft = (screenWidth - alertWidth) / 2;
                const alertTop = (screenHeight - alertHeight) / 2;
                deleteAlert.style.left = alertLeft + 'px';
                deleteAlert.style.top = alertTop + 'px';
            }

            window.addEventListener('resize', () => {
                deleteAlerts.forEach(deleteAlert => {
                    if (!deleteAlert.classList.contains('hidden')) {
                        centerDeleteAlert(deleteAlert);
                    }
                });
            });
        });
    </script>


</body>

</html>
