<h1>Create New Class</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.process.update_teacher') }}" enctype="multipart/form-data">
    @csrf
 <input type="number" name="teacher_id" value="{{$teacher_id}}" hidden>
     
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