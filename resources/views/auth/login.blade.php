@extends('app')
<h1>Login</h1>

<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="email">Email</label>
    <input type="text" name="email" id="">
    <label for="password">Password</label>
    <input type="password" name="password" id="" value="rahasia123">
    <button type="submit">Login</button>
    @error('email')
        <span>{{ $message }}</span>
    @enderror
</form>
