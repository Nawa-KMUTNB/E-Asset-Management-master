<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการเบิกครุภัณฑ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
@extends('layouts.app')

<body>
    @section('content')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 text-center" id="brData2">
                    <h3>ข้อมูลการเบิกครุภัณฑ์</h3>
                </div>


                <form action="{{ route('web.search') }}" method="GET">

                    <div class="input-group" style="margin-bottom: 10px">
                        <div class="mt-2 mb-2 d-grid gap-2 d-md-flex justify-content-md-end ">
                            <a href="{{ route('bring.create') }}" class="btn btn-info ">เพิ่มการเบิกครุภัณฑ์</a>
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
                        <a href="{{ route('bring.index') }}" class="btn btn-outline-danger"
                            style="margin-top:10px;border-radius:10px; "id="height">ล้างการค้นหา </a>

                    </div>
                </form>
            </div>

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


            <table class="table table-hover table-bordered">
                <thead class="table-dark" style="text-align:center;font-size:16px;">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ - สกุลผู้เบิก</th>
                        <th>วันที่เบิก</th>
                        <th>รายละเอียด</th>
                        <th>หมายเลขครุภัณฑ์</th>
                        <th>ชื่อครุภัณฑ์</th>
                        <th>ราคา/หน่วย</th>
                        <th>เลขที่ใบส่งของ</th>
                        <th>วันที่รับเข้าคลัง</th>
                        <th>ฝ่ายที่เบิก</th>
                        <th>เลขประจำตำแหน่ง</th>
                        <th>สถานที่ตั้งครุภัณฑ์</th>
                        <th width="220px">Action</th>
                    </tr>
                </thead>
                @foreach ($brings as $bring)
                    <tr>
                        <td>{{ $bring->id }}</td>
                        <td>{{ $bring->FullName }}</td>
                        <td>{{ $bring->date_bring }}</td>
                        <td>{{ $bring->detail }}</td>
                        <td>{{ $bring->num_asset }}</td>
                        <td>{{ $bring->name_asset }}</td>
                        @php
                            $doubleValue = $bring->per_price;
                            $formattedValue = number_format($doubleValue, 2); // Output: "1,234.57"
                            
                        @endphp

                        <td>{{ $formattedValue }}</td>
                        <td>{{ $bring->num_sent }}</td>
                        <td>{{ $bring->Date_into }}</td>
                        <td>
                            {{ $bring->department == 'other' && isset($bring->other_department) ? $bring->other_department : $bring->department }}
                        </td>
                        <td>{{ $bring->num_department }}</td>
                        <td>{{ $bring->place }}</td>

                        <td>
                            <div class="delete-row">
                                <a href="{{ route('bring.edit', $bring->id) }}"
                                    class="btn btn-warning">แก้ไขการเบิกครุภัณฑ์</a>

                                <button class="delete-btn"
                                    data-target="#delete-alert-{{ $bring->id }}">ลบการเบิกครุภัณฑ์</button>
                                <form action="{{ route('companies.destroy', $bring->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete-alert hidden" id="delete-alert-{{ $bring->id }}">
                                        <p>คุณต้องการจะลบการเบิกครุภัณฑ์ใช่หรือไม่?</p>
                                        <button class="delete-confirm" data-form=".delete-form">ใช่,
                                            ต้องการลบการเบิกครุภัณฑ์</button>
                                        <button class="delete-cancel">ไม่</button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $bring->id }}">
                                </form>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $brings->links('pagination::bootstrap-5') !!}

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

            deleteCancels.forEach(deleteCancel => {
                deleteCancel.addEventListener('click', (e) => {
                    e.preventDefault();
                    const deleteAlert = e.target.closest('.delete-alert');
                    deleteAlert.classList.add('hidden');
                });
            });

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
