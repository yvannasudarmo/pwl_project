{{$matakuliah}}
<form action="{{route('matakuliah.update', $matakuliah->id)}}"  method="post">
    @csrf
    <input type="hidden" name="id" value="{{$matakuliah->id}}">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <table>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><input type="text" name="Jurusan_Id" value="{{$matakuliah->Jurusan_Id}}"></td>
        </tr>
        <tr>
            <td>Kode Mata Kuliah</td>
            <td>:</td>
            <td><input type="text" name="Kode_MK" value="{{$matakuliah->Kode_MK}}"></td>
        </tr>
        <tr>
            <td>Nama Mata Kuliah</td>
            <td>:</td>
            <td><input type="text" name="Nama_MK" value="{{$matakuliah->Nama_MK}}"></td>
        </tr>
        <tr>
            <td>SKS</td>
            <td>:</td>
            <td><input type="number" name="SKS" value="{{$matakuliah->SKS}}"></td>
        </tr>
        <tr>
            <td>Kode Dosen</td>
            <td>:</td>
            <td><input type="text" name="Kode_Dosen" value="{{$matakuliah->Kode_Dosen}}"></td>
        </tr>
<button type="Submit">Add</button>
<button type="reset"> Clear </button>
    </table>
</form>