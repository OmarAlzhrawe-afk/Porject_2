<h1>Create New Class</h1>
@if (session('conflicts'))
    <div style="color: red  ,background_color:red;">
        {{ session('conflicts') }}
    </div>
@endif
<form method="POST" action="{{ route('admin.process.add_session') }}">
    @csrf
    <label for="teacher_id">Enter teacher</label>
    <input type="number" name="teacher_id" value="{{old('teacher_id')}}">
    <label for="class_id">Enter class_id</label>
    <input type="number" name="class_id" value="{{old('class_id')}}">

    <label for="day">select day</label>
    <select name="day">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        {{-- <option value="Thursday">Thursday</option> --}}
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
    </select>

    <label for="start_time">Enter start_time</label>
    <input type="time" name="start_time" value="{{old('start_time')}}">
    <label for="end_time">Enter end_time</label>
    <input type="time" name="end_time" value="{{old('end_time')}}">
    <button type="submit">Add Name</button>
</form>