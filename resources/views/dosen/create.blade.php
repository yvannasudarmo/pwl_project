<form action="{{route('dosen.edit', $dosen->id)}}"  method="post">
    @csrf
<table>
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td><input type="text" name="Fullname"></td>
        </tr>
        <tr>
            <td>Nomor Induk Mahasiswa</td>
            <td>:</td>
            <td><input type="text" name="NIM"></td>
        </tr>
        <tr>
            <td>Nomor Induk Dosen Nasional</td>
            <td>:</td>
            <td><input type="text" name="NIDN"></td>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td><input type="text" name="Pendidikan_Terakhir"></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><input type="text" name="Jurusan_id"></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><input type="text" name="Tempat_Lahir"></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input type="text" name="Tanggal_Lahir"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="Alamat"></textarea></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Update">
                <input type="reset" value="Clear">
            </td>
        </tr>
    </table>
</form>