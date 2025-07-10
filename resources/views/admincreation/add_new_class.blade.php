<h1>Create New Class</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{ route('admin.process.add_class') }}">
    @csrf
    <input type="number" name="level_id" value="{{$level_id}}" hidden>
    <label for="name">Enter class Name </label>
    <input type="text" name="name" value="{{old('name')}}">
<br><br><hr>
    <label for="capacity">Enter capacity Name</label>
    <input type="number" name="capacity" value="{{old('capacity')}}" >
<br><br><hr>
    <label for="current_count">Enter current_count Name</label>
    <input type="number" name="current_count" value="{{old('current_count')}}">
<br><br><hr>
    <label for="floor">Enter floor Name</label>
    <input type="number" name="floor" value="{{old('floor')}}">
<br><br><hr>
    <button type="submit">Add Class</button>
</form>