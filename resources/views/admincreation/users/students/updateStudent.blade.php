<h1>Update Student</h1>
@if (session('error'))
    <div style="color: rgb(219, 247, 34);">
        {{ session('error') }}
    </div>
@endif
{{-- --}}
<form method="POST" action="{{ route('admin.process.update_Student') }}">
    @csrf
 <input type="number" name="student_id" value="{{$student_id}}" hidden>
    <label for="status">status</label>
    <select name="status">
        <option value="active">active</option>
        <option value="suspended">suspended</option>
        <option value="graduated">graduated</option>
        <option value="left">left</option>
    </select>
<br><br><hr>
    <button type="submit">Update Student</button>
</form>