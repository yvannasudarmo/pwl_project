<a href="{{route('matakuliah.index')}}"> 
    <input type="button" value="Create">
</a>
<table border="1">
    <thead>
        <th>No</th>
        <th>Jurusan Id</th>
        <th>Kode Mata Kuliah</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Dosen Id</th>
        <th>Tanggal Dibuat</th>
        <th>Aksi</th>
    </thead>
    @foreach ($matakuliah as $mk)
    <tr>
        <td>{{$mk->id}}</td>
        <td>{{$mk->Jurusan_Id}}</td>
        <td>{{$mk->Kode_MK}}</td>
        <td>{{$mk->Nama_MK}}</td>
        <td>{{$mk->SKS}}</td>
        <td>{{$mk->Dosen_Id}}</td>
        <td>{{$mk->created_at}}</td>
        <td>
            <a href="{{route('matakuliah.update', $mk->id)}}"> 
                <input type="button" value="Edit">
            </a>
            <form action="{{route('matakuliah.delete', $mk->id)}}"  method="post">
            @csrf
            <input type="hidden" name="id" value="{{$mk->id}}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Delete">
        </td>
    </tr>
    @endforeach
</table>