<form action="{{route('matakuliah.save')}}"  method="post">
    @csrf
    <table>
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td><input type="text" name="Jurusan_Id"></td>
        </tr>
        <tr>
            <td>Kode Mata Kuliah</td>
            <td>:</td>
            <td><input type="text" name="Kode_MK"></td>
        </tr>
        <tr>
            <td>Nama Mata Kuliah</td>
            <td>:</td>
            <td><input type="text" name="Nama_MK"></td>
        </tr>
        <tr>
            <td>SKS</td>
            <td>:</td>
            <td><input type="number" name="SKS"></td>
        </tr>
        <tr>
            <td>Dosen Id</td>
            <td>:</td>
            <td><input type="text" name="Dosen_Id"></td>
        </tr>
    </table>

<button type="Submit">Add</button>
<button type="reset"> Clear </button>
</form>