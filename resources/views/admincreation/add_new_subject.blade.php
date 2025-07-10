<h1>Create New Class</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{ route('admin.process.add_subject') }}">
    @csrf
    <input type="number" name="level_id" value="{{$level_id}}" hidden>
    <label for="name">Enter subject Name </label>
    <input type="text" name="name" value="{{old('name')}}">
    <button type="submit">Add Name</button>
</form>