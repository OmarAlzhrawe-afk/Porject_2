<h1>add_new_PublicContent</h1>
@if (session('error'))
<div style="color: red;">
    {{ session('error') }}
</div>
@endif
{{-- 
'content_type', array('about', 'vision', 'Frequently_asked_questions'));
			$table->longText('content'); --}}
<form method="POST" action="{{ route('admin.process.add_PublicContent') }}" enctype="multipart/form-data">
    @csrf
    <label for="content_type"> select content_type type</label>
    <select name="content_type">
        <option value="about">about</option>
        <option value="vision">vision</option>
        <option value="Frequently_asked_questions">Frequently_asked_questions</option>
    </select>
    <br><br>
    <hr>
    <label for="content">content</label>
    <input type="text" name="content" value="{{old('content')}}">
    <br><br>
    <hr>
    <button type="submit">Add Content</button>
</form>