<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <form action="{{ action([App\Http\Controllers\DosenController::class, 'store']) }}"  method="post">
        @csrf
        <table class="table table-light table-striped">
            <tr>
                <td>Kode Kelas</td>
                <td>:</td>
                <td><input type="text" name="kode_kelas" class="form-control"></td>
            </tr>
            <tr>
                <td>Mata Kuliah</td>
                <td>:</td>
                <td><select name="kode_mata_kuliah" class="form-control">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach ($mataKuliah as $mk)
                        <option value="{{ $mk->id }}">{{ $mk->Nama_Mata_Kuliah }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Dosen Pengajar</td>
                <td>:</td>
                <td><select name="kode_dosen" class="form-control">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach ($dosen as $d)
                        <option value="{{ $d->id }}">{{ $d->Fullname }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td><select name="hari" class="form-control">
                    <option value="">-- Pilih Hari --</option>
                    @foreach ($hari as $h)
                        <option value="{{ $h }}">{{ $h }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>:</td>
                <td><select name="jam" class="form-control">
                    <option value="">-- Pilih Jam --</option>
                    @foreach ($jam as $j)
                        <option value="{{ $j }}">{{ $j }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td><input type="text" name="tahun_ajaran" class="form-control"></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td><select name="semester" class="form-control">
                    <option value="">-- Pilih Semester --</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select></td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td><input type="text" name="ruang_kelas" class="form-control"></td>
            </tr>
            <tr>
                <td>Jumlah Mahasiswa</td>
                <td>:</td>
                <td><input type="number" name="jumlah_max" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Add" class="form-control"><br>
                    <input type="reset" value="Clear" class="form-control">
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>