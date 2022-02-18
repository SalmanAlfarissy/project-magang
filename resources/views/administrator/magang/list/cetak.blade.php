
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
                <h1>Daftar Siswa Magang</h1>
            </div>
        </div>
        <div style="align-content: center;"><br/>
            <table style="margin-left:auto;margin-right:auto" border="1" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Awal Magang</th>
                        <th>Selesai Magang</th>
                        <th>Alamat</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $index=>$item )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->awal_magang }}</td>
                        <td>{{ $item->selesai_magang }}</td>
                        <td>{{ $item->alamat }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>


