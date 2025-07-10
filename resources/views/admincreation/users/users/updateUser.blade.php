<h1>Update User</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
{{-- --}}
<form method="POST" action="{{ route('admin.process.update_User') }}" enctype="multipart/form-data">
    @csrf
 <input type="text" name="user_id" value="{{$user_id}}" hidden>
    <label for="email">Enter Email </label>
    <input type="email" name="email" value="{{old('email')}}" >
<br><br><hr>
    <label for="phone_number">Enter Phone_Number </label>
    <input type="text" name="phone_number" value="{{old('phone_number')}}">
<br><br><hr>
    <label for="address">Enter Address </label>
    <input type="text" name="address" value="{{old('address')}}">
<br><br><hr>
<br><br><hr>
    <label>ID Father</label>
    <input type="file" name="ID_documents[father_id]"   accept="image/*"  value="{{old('ID_documents[father_id]')}}">
    <label>ID Mother</label>
    <input type="file" name="ID_documents[mother_id]"   accept="image/*"  value="{{old('ID_documents[mother_id]')}}">
    <label>Family Book</label>
    <input type="file" name="ID_documents[family_book]" accept="image/*" value="{{old('ID_documents[family_book]')}}">
    <button type="submit">Update User</button>
</form>