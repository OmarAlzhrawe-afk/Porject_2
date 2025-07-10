<form method="POST" action="{{ route('supervisor.login.entercode') }}">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <label>we send Code For {{$email}} Enter it Here</label>
    <input type="text" name="code" required>
    <button type="submit">تأكيد الدخول</button>
</form><br><br>
<form method="POST" action="{{ route('supervisor.login.resendcode') }}">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    
    <button type="submit">Resend</button>
</form>
