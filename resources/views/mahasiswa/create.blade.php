<form action="{{route('mahasiswa.save')}}"  method="post">
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
            <td>Nomor Induk Siswa Nasional</td>
            <td>:</td>
            <td><input type="text" name="NISN"></td>
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
    </table>

<button type="Submit">Add</button>
<button type="reset"> Clear </button>
</form>