<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <a href="{{route('dosen.add')}}">
        <input type="button" value="Create">
    </a>
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIP</th>
            <th>NIDN</th>
            <th>Pendidikan Terakhir</th>
            <th>Jurusan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        @foreach ($dosen as $d)
        <tr>
            <td>{{$d->id}}</td>
            <td>{{$d->Fullname}}</td>
            <td>{{$d->NIP}}</td>
            <td>{{$d->NIDN}}</td>
            <td>{{$d->Pendidikan_Terakhir}}</td>
            <td>{{$d->Jurusan_Id}}</td>
            <td>{{$d->Tempat_Lahir}}</td>
            <td>{{$d->Tanggal_Lahir}}</td>
            <td>{{$d->Alamat}}</td>
            <td>{{$d->created_at}}</td>
            <td>{{$d->updated_at}}</td>
            <td>
                <a href="{{route('dosen.update', $d->id)}}">
                    <input type="button" value="Edit">
                </a>
                <form action="{{route('dosen.delete', $d->id)}}"  method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$d->id}}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>