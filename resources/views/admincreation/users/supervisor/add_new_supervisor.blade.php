<h1>Create New SuperVisor</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
{{-- --}}
<form method="POST" action="{{ route('admin.process.add_Supervisor') }}"   enctype="multipart/form-data">
    @csrf
 {{-- <input type="text" name="teacher" value="teacher" hidden> --}}
    <label for="name">Enter Teacher Name </label>
    <input type="text" name="name" value="{{old('name')}}">
<br><br><hr>
    <label for="email">Enter Email </label>
    <input type="email" name="email" value="{{old('email')}}" >
<br><br><hr>
    <label for="phone_number">Enter Phone_Number </label>
    <input type="text" name="phone_number">
<br><br><hr>
    <label for="birth_date">Enter Birth_Date </label>
    <input type="date" name="birth_date">
<br><br><hr>
    <label for="address">Enter Address </label>
    <input type="text" name="address" >
<br><br><hr>
    <label for="gender">Gender</label>
    <select name="gender">
        <option value="male">Male</option>
        <option value="Female">Female</option>
    </select>
<br><br><hr>
    <label>ID Father</label>
    <input type="file" name="ID_documents[father_id]" value="{{old('ID_documents[father_id]')}}">
    <label>ID Mother</label>
    <input type="file" name="ID_documents[mother_id]" value="{{old('ID_documents[mother_id]')}}">
    <label>Family Book</label>
    <input type="file" name="ID_documents[family_book]" value="{{old('ID_documents[family_book]')}}">
<br><br><hr>
    <label for="status">status</label>
    <select name="status">
        <option value="active">active</option>
        <option value="on_leave">on_leave</option>
        <option value="resigned">resigned</option>
    </select>
    <button type="submit">Add Teacher</button>
</form>