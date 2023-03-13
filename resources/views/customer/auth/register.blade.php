<form action="{{ route('customer.register') }}" method="post">
    @csrf
<input type="text" name="name"> <br>
<input type="text" name="email"><br>
<input type="text" name="password"><br>
<button type="submit">Register</button>
</form>