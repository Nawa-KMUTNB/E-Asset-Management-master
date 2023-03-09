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
    <img src="../public/ited.jpg" alt="ited" width="50" height="50">
    <p style="text-align: center; font-size: 22px">

        สำนักพัฒนาเทคนิคศึกษา <br>
        ใบรายการค้นหาคุณภัณฑ์ของ
    </p>
    <table style="border-collapse: collapse; width: 100%; font-size: 18px">
        <tr>
            <td width:20%>ลำดับ</td>
            <td width:20%>หมายเลขครุภัณฑ์</td>
            <td width:10%>ชื่อครุภัณฑ์</td>
            <td width:10%>ชื่อผู้ครอบครองครุภัณฑ์</td>
            <td width:10%>เลขประจำตำแหน่ง</td>
        </tr>

        @foreach ($companies as $company)
            <tr>
                <td>
                    @php
                        $count = DB::table('companies')
                            ->where('id', '<=', $company->id)
                            ->count();
                    @endphp
                    {{ $count }}
                </td>

                <td> {{ $company->num_asset }} </td>
                <td> {{ $company->name_asset }} </td>
                <td> {{ $company->fullname }} </td>
                <td> {{ $company->num_department }} </td>
            </tr>
        @endforeach

    </table>
</body>

</html>
