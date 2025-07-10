<h1>Create New Class</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
{{-- --}}
<form method="POST" action="{{ route('admin.process.update_supervisor') }}">
    @csrf
 <input type="number" name="supervisor_id" value="{{$id}}" hidden>
   
     <label for="status">Enter status </label>
        <select name="status">
            <option value="active">active</option>
            <option value="on_leave">on_leave</option>
            <option value="resigned">resigned</option>
        </select>
 <br><br><hr>
    
    <button type="submit">Add Teacher</button>
</form>