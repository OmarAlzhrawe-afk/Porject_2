<h1>Create New Level</h1>
<form method="POST" action="{{ route('admin.process.create_education_level') }}">
    @csrf
    <label for="name">Enter Education level Name </label>
    <input type="text" name="name" value="{{old('name')}}">
    <label for="description">Enter Education level Name</label>
    <input type="text" name="description" required>
    <button type="submit">Save Education Level</button>
</form>
