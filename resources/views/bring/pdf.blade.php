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
    </style>



</head>

<body>
    <img src="../public/ited.jpg" alt="ited" width="50" height="50" style="margin-bottom: 10px">

    @foreach ($users as $user)
        <p style="text-align: center; font-size: 22px">

            สำนักพัฒนาเทคนิคศึกษา <br>
            ใบรายการค้นหาคุณภัณฑ์ของ : {{ $user->name }} <br>
            เลขประจำตำแหน่ง : {{ $user->num_position }}
        </p>
    @endforeach

    @foreach ($brings as $bring)
        <p style="text-align: center; font-size: 22px">

            สำนักพัฒนาเทคนิคศึกษา <br>
            ใบรายการค้นหาคุณภัณฑ์ของ : {{ $bring->FullName }} <br>
            เลขประจำตำแหน่ง : {{ $bring->num_department }}
        </p>
    @endforeach
    <table style="border-collapse: collapse; width: 100%; font-size: 18px">
        <tr>
            <td style="border: 1px solid; padding:10px;" width:20%>ชื่อ - สกุลผู้เบิก</td>
            <td style="border: 1px solid; padding:10px;" width:10%>วันที่เบิก</td>
            <td style="border: 1px solid; padding:10px;" width:10%>รายละเอียด</td>
            <td style="border: 1px solid; padding:10px;" width:10%>หมายเลขครุภัณฑ์</td>
            <td style="border: 1px solid; padding:10px;" width:10%>ชื่อครุภัณฑ์</td>
            <td style="border: 1px solid; padding:10px;" width:10%>ราคา/หน่วย</td>
            <td style="border: 1px solid; padding:10px;" width:10%>เลขที่ใบส่งของ</td>
            <td style="border: 1px solid; padding:10px;" width:10%>วันที่รับเข้าคลัง</td>
            <td style="border: 1px solid; padding:10px;" width:10%>ฝ่ายที่เบิก</td>
            <td style="border: 1px solid; padding:10px;" width:10%>เลขประจำตำแหน่ง</td>
            <td style="border: 1px solid; padding:10px;" width:10%>สถานที่ตั้งครุภัณฑ์</td>
        </tr>

        @foreach ($brings as $bring)
            <tr>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->FullName }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->date_bring }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->detail }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->num_asset }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->name_asset }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->per_price }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->num_sent }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->Date_into }} </td>
                <td style="border: 1px solid; padding:10px;">
                    {{ $bring->department == 'other' && isset($bring->other_department) ? $bring->other_department : $bring->department }}
                </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->num_department }} </td>
                <td style="border: 1px solid; padding:10px;"> {{ $bring->place }} </td>
            </tr>
        @endforeach

    </table>
</body>

</html>
