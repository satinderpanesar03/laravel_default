<form action="{{ route('customer.login') }}" method="post">
    @csrf
<input type="text" name="email"> <br>
<input type="text" name="password"><br>
<button type="submit">Submit</button>
</form>