<table border="1">
    <thead>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>NIM</th>
        <th>NISN</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Tanggal Dibuat</th>
    </thead>
    @foreach ($mahasiswa as $m)
    <tr>
        <td>{{$m->id}}</td>
        <td>{{$m->Fullname}}</td>
        <td>{{$m->NIM}}</td>
        <td>{{$m->NIDN}}</td>
        <td>{{$m->Tempat_Lahir}}</td>
        <td>{{$m->Tanggal_Lahir}}</td>
        <td>{{$m->Alamat}}</td>
        <td>{{$m->created_at}}</td>
    </tr>
    @endforeach
</table>