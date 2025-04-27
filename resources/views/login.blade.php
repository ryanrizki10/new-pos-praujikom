@extends('layouts.main')

@section('page-title', 'Login')
@section('content-layout')
<main>
  <style>
    body {
      background: #121212;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #e0e0e0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .login-card {
      background: #1f1f1f;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.7);
      width: 360px;
    }
    .login-card h2 {
      text-align: center;
      margin-bottom: 0.5rem;
      color: #00b894;
      font-weight: 700;
    }
    .login-card p {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #aaa;
    }
    label {
      display: block;
      margin-bottom: 0.3rem;
      font-weight: 600;
      color: #ccc;
    }
    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 0.6rem 0.8rem;
      margin-bottom: 1.2rem;
      border: none;
      border-radius: 8px;
      background: #2c2c2c;
      color: #eee;
      font-size: 1rem;
      transition: box-shadow 0.3s ease;
    }
    input[type="email"]:focus,
    input[type="password"]:focus,
    select:focus {
      outline: none;
      box-shadow: 0 0 8px #00b894;
      background: #383838;
    }
    .btn-login {
      width: 100%;
      padding: 0.75rem;
      background: #00b894;
      border: none;
      border-radius: 8px;
      color: #121212;
      font-weight: 700;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .btn-login:hover {
      background: #019875;
    }
    .text-danger {
      color: #ff6b6b;
      font-size: 0.85rem;
    }
  </style>

  <div class="login-card">
    <h2>Point of Sales</h2>
    <p>Enter your Email and Password</p>

    <form method="post" action="/action-login" novalidate>
      @csrf
      <label for="email">Email <span class="text-danger">*</span></label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

      <label for="password">Password <span class="text-danger">*</span></label>
      <input type="password" id="password" name="password" required>

      <label for="role">Role <span class="text-danger">*</span></label>
      <select id="role" name="role" required>
        <option value="" disabled selected>Select Role</option>
        @foreach ($roles as $role)
          <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
      </select>

      <button type="submit" class="btn-login">Login</button>
    </form>
  </div>
</main>
@endsection
