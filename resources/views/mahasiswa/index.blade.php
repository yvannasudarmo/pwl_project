<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <a href="{{route('mahasiswa.add')}}">
        <input type="button" value="Create">
    </a>
    <table class="table table-striped">
        <thead>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>NISN</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        @foreach ($mahasiswa as $m)
        <tr>
            <td>{{$m->id}}</td>
            <td>{{$m->Fullname}}</td>
            <td>{{$m->NIM}}</td>
            <td>{{$m->NISN}}</td>
            <td>{{$m->Tempat_Lahir}}</td>
            <td>{{$m->Tanggal_Lahir}}</td>
            <td>{{$m->Alamat}}</td>
            <td>{{$m->created_at}}</td>
            <td>{{$m->updated_at}}</td>
            <td>
                <a href="{{route('mahasiswa.update', $m->id)}}">
                    <input type="button" value="Edit">
                </a>
                <form action="{{route('mahasiswa.delete', $m->id)}}"  method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$m->id}}">
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