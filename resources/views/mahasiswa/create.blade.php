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
            <td><input type="text" name="NIDN"></td>
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
                <input type="submit" value="Add">
                <input type="reset" value="Clear">
            </td>
        </tr>
    </table>
</form>

<div>
    <ul>
    <li>Buatlah sebuah View dengan nama mahasiswa/create</li>
    <li>Return View tersebut pada MahasiswaController fungsi create()</li>
    <li>Tambahkan Route mahasiswa-create ke fungsi create tersebut</li>
    <li>Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.save'); Tambah di route</li>
    <li>Tambah Action dan Method di Form ini<br>action="{route('mahasiswa.save')}"  method="post"</li>
    <li>Fungsi Di MahasiswaController -> Store <br>
        $data = $request->except('_token');<br>
        Mahasiswa::create($data);<br>
        return redirect()->action([MahasiswaController::class, 'index']);
    </li>
    </ul>
</div>
