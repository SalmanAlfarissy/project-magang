
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Siswa Magang</title>
    <style>
        .body{
            /* background-image: url(../public/images/logo.png); */
            background-size: 40%;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
            padding: 0%;
        }
        .title{
            text-align: center;
            font-size: 2.5em;
            color: #000;
        }

    </style>
</head>
<body class="body">

    <div>
        <div>
            <div style="text-align: center">
                <h1>List Kegiatan Siswa</h1>
                <h4>Nama : {{ $dataMagang->nama }}</h4>
            </div>
        </div>
        <div style="align-content: center;"><br/>
            <table style="margin-left:auto;margin-right:auto" border="1" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $index=>$item )
                    <tr style="text-align: center">
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


