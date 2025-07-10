<!DOCTYPE html>
<html>
<head>
    <title>تسجيل دخول </title>
</head>
<body>
    <h2>تسجيل الدخول</h2>

    @if ($errors->any())
        <div style="color:hsl(0, 94%, 50%);">{{ $errors->first() }}</div>
    @endif

    <form method ="POST" action="{{ route('admin.login') }}">
        @csrf
        <input type="email" name="email" placeholder="الإيميل" required><br><br>
        <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
        <label for="role">Please Choose Your logintype</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="supervisor">Supervisor</option>
        </select>
        <button type="submit">Login</button>
    </form>
</body>
</html>