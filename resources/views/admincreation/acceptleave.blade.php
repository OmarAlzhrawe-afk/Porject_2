<h1>Accept_Leave</h1>
@if (session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif
<form method="POST" action="{{ route('admin.process.Accept_Leave') }}">
    @csrf
    <input type="leave_id" name="leave_id" value="{{$leave_id}}" hidden>
    <label for="amount">Enter amount </label>
    <input type="number" name="amount" value="{{old('amount')}}">
<br><br><hr>
    <label for="reason">Enter reason</label>
    <input type="text" name="reason" value="{{old('reason')}}" >
<br><br><hr>
    <button type="submit">Add Class</button>
</form>