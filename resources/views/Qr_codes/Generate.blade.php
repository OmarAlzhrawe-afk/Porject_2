<h1>Accept_Leave</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{ route('admin.process.Generate_QR_For_Specific_Class') }}" enctype="multipart/form-data">
    @csrf
    <label for="type">Type</label>
    <select name="type">
        <option value="colored">colored</option>
        <option value="normal">normal</option>
        <option value="circle">circle</option>
    </select>
    <label for="class_id">Enter Class ID</label>
    <input type="class_id" name="class_id" value="{{old('class_id')}}">
<br><br><hr>
    <button type="submit">Generate QR Code For Class</button>
</form>