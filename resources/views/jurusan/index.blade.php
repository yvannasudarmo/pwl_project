<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <a href="{{route('jurusan.index')}}">
        <input type="button" value="Create">
    </a>
    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th>Nama Jurusan</th>
            <th>Kode Jurusan</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </thead>
        @foreach ($jurusan as $j)
        <tr>
            <td>{{$j->id}}</td>
            <td>{{$j->Nama_Jurusan}}</td>
            <td>{{$j->Kode_Jurusan}}</td>
            <td>{{$j->created_at}}</td>
            <td>{{$j->updated_at}}</td>
            <td>
                <a href="{{route('jurusan.update', $j->id)}}">
                    <input type="button" value="Edit">
                </a>
                <form action="{{route('jurusan.delete', $j->id)}}"  method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$j->id}}">
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