<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            size: 21cm 29.7cm landscape;
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";

        }

        img {
            display: block;
            margin-left: 47.5%;
        }

        td {
            border: 1px solid;
            padding: 10px;
        }
    </style>



</head>

<body>
    <img src="../public/ited.jpg" alt="ited" width="50" height="50" style="margin-bottom: 10px">

    <p style="text-align: center; font-size: 22px">
        สำนักพัฒนาเทคนิคศึกษา <br>
        ใบรายการค้นหาคุณภัณฑ์ของ
    </p>
    <table style="border-collapse: collapse; width: 100%; font-size: 18px">
        <tr>
            <td>ลำดับ</td>
            <td width:20%>ชื่อ - สกุลผู้เบิก</td>
            <td width:10%>วันที่เบิก</td>
            <td width:10%>รายละเอียด</td>
            <td width:10%>หมายเลขครุภัณฑ์</td>
            <td width:10%>ชื่อครุภัณฑ์</td>
            <td width:10%>ราคา/หน่วย</td>
            <td width:10%>เลขที่ใบส่งของ</td>
            <td width:10%>วันที่รับเข้าคลัง</td>
            <td width:10%>ฝ่ายที่เบิก</td>
            <td width:10%>เลขประจำตำแหน่ง</td>
            <td width:10%>สถานที่ตั้งครุภัณฑ์</td>
        </tr>

        @foreach ($brings as $bring)
            <tr>
                <td> @php
                    $count = DB::table('brings')
                        ->where('id', '<=', $bring->id)
                        ->count();
                @endphp
                    {{ $count }}
                </td>
                <td> {{ $bring->FullName }} </td>
                <td> {{ $bring->date_bring }} </td>
                <td> {{ $bring->detail }} </td>
                <td> {{ $bring->num_asset }} </td>
                <td> {{ $bring->name_asset }} </td>
                <td> {{ $bring->per_price }} </td>
                <td> {{ $bring->num_sent }} </td>
                <td> {{ $bring->Date_into }} </td>
                <td>
                    {{ $bring->department == 'other' && isset($bring->other_department) ? $bring->other_department : $bring->department }}
                </td>
                <td> {{ $bring->num_department }} </td>
                <td> {{ $bring->place }} </td>
            </tr>
        @endforeach

    </table>
</body>

</html>
