<h1>update_Post</h1>
@if (session('error'))
<div style="color: red;">
    {{ session('error') }}
</div>
@endif
<form method="POST" action="{{ route('admin.process.update_Post') }}" enctype="multipart/form-data">
    @csrf
    <input type="number" name="post_id" value="{{$post_id}}" hidden>
    <label for="title">Enter class title </label>
    <input type="text" name="title" value="{{old('title')}}">
    <br><br>
    <hr>
    <label for="description">Enter description Name</label>
    <input type="text" name="description" value="{{old('description')}}">
    <br><br>
    <hr>
    <label for="post_type"> select post type</label>
    <select name="post_type"> select post type
        <option value="lesson">lesson</option>
        <option value="news">news</option>
        <option value="event">event</option>
    </select>
    <br><br>
    <hr>
    <label for="file_url">upload file</label>
    <input type="file" name="file_url" value="{{old('file')}}">
    <br><br>
    <hr>
    <label for="is_public"> select if public</label>
    <select name="is_public">
        <option value="true">public</option>
        <option value="false">private</option>
    </select>
    <br><br>
    <hr>
    <button type="submit">Add Post</button>
</form>