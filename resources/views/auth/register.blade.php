@extends('app')
<h1>Register</h1>

<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="name">Full Name</label>
    <input type="text" name="name" id="">
    <label for="email">Email</label>
    <input type="text" name="email" id="">
    <label for="password">Password</label>
    <input type="password" name="password" id="" value="rahasia123">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" value="rahasia123" id="">
    <label for="address">Address</label>
    <input type="text" name="address" id="">
    <button type="submit">Register</button>
    @error('name')
        <span>{{ $message }}</span>
    @enderror
    @error('password')
        <span>{{ $message }}</span>
    @enderror
    @error('email')
        <span>{{ $message }}</span>
    @enderror
    @error('name')
        <span>{{ $message }}</span>
    @enderror
    @error('name')
        <span>{{ $message }}</span>
    @enderror
</form>
