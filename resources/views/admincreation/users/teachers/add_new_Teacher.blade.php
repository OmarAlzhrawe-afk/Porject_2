<h1>Create New Class</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
{{-- --}}
<form method="POST" action="{{ route('admin.process.add_Teacher') }}" enctype="multipart/form-data">
    @csrf
 {{-- <input type="text" name="teacher" value="teacher" hidden> --}}
    <label for="name">Enter Teacher Name </label>
    <input type="text" name="name" value="{{old('name')}}">
<br><br><hr>
    <label for="email">Enter Email </label>
    <input type="email" name="email" value="{{old('email')}}" >
<br><br><hr>
    <label for="phone_number">Enter Phone_Number </label>
    <input type="text" name="phone_number" value="{{old('phone_number')}}">
<br><br><hr>
    <label for="birth_date">Enter Birth_Date </label>
    <input type="date" name="birth_date" value="{{old('birth_date')}}">
<br><br><hr>
    <label for="address">Enter Address </label>
    <input type="text" name="address" value="{{old('address')}}">
<br><br><hr>
    <label for="gender">Gender</label>
    <select name="gender">
        <option value="male">Male</option>
        <option value="Female">Female</option>
    </select>
<br><br><hr>
    <label>ID Father</label>
    <input type="file" name="ID_documents[father_id]"   accept="image/*"  value="{{old('ID_documents[father_id]')}}">
    <label>ID Mother</label>
    <input type="file" name="ID_documents[mother_id]"   accept="image/*"  value="{{old('ID_documents[mother_id]')}}">
    <label>Family Book</label>
    <input type="file" name="ID_documents[family_book]" accept="image/*" value="{{old('ID_documents[family_book]')}}">
<br><br><hr>
    <label for="subject_id">Enter subject_id </label>
    <input type="number" name="subject_id" value="{{old('subject_id')}}">
<br><br><hr>
    <label for="Academic_qualification">Enter Academic_qualification </label>
    <input type="text" name="Academic_qualification" value="{{old('Academic_qualification')}}">
<br><br><hr>
  <label for="Employment_status">select Employment_status</label>
    <select name="Employment_status">
        <option value="active">active</option>
        <option value="suspended">suspended</option>
        <option value="resigned">resigned</option>
    </select>
<br><br><hr>
<label for="Payment_type">select Payment_type</label>
    <select name="Payment_type">
        <option value="monthly">monthly</option>
        <option value="hourly">hourly</option>
    </select>
<br><br><hr>
<label for="Contract_type">select Contract_type</label>
    <select name="Contract_type">
        <option value="permanent">permanent</option>
        <option value="temporary">temporary</option>
        <option value="part_time">part_time</option>
    </select>
<br><br><hr>
    <label for="The_beginning_of_the_contract">Enter The_beginning_of_the_contract </label>
    <input type="date" name="The_beginning_of_the_contract" value="{{old('The_beginning_of_the_contract')}}">
<br><br><hr>
    <label for="End_of_contract">Enter End_of_contract </label>
    <input type="date" name="End_of_contract" value="{{old('End_of_contract')}}">
<br><br><hr>
    <label for="number_of_lesson_in_week">Enter number_of_lesson_in_week </label>
    <input type="number" name="number_of_lesson_in_week" value="{{old('number_of_lesson_in_week')}}">
<br><br><hr>
    <label for="wages_per_lesson">Enter wages_per_lesson </label>
    <input type="number" name="wages_per_lesson" value="{{old('wages_per_lesson')}}">
<br><br><hr>
    <button type="submit">Add Teacher</button>
</form>