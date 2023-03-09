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
                    <h1 style="font-size: 30px">จัดการผู้ใช้งาน</h1>
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
                            <div class="delete-row">
                                <a href="{{ route('user.edit', $users->id) }}" class="btn btn-warning">แก้ไขผู้ใช้งาน</a>

                                <button class="delete-btn"
                                    data-target="#delete-alert-{{ $users->id }}">ลบผู้ใช้งาน</button>
                                <form action="{{ route('user.destroy', $users->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete-alert hidden" id="delete-alert-{{ $users->id }}">
                                        <p>คุณต้องการจะลบข้อมูลผู้ใช้งานใช่หรือไม่?</p>
                                        <button class="delete-confirm" data-form=".delete-form">ใช่,
                                            ต้องการลบผู้ใช้งาน</button>
                                        <button class="delete-cancel">ไม่</button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $users->id }}">
                                </form>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $user->links('pagination::bootstrap-5') !!}

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
