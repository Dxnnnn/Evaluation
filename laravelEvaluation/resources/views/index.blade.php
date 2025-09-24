<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN FORM</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f7fb url('{{ asset('background.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0px 6px 12px rgba(0,0,0,0.15);
      width: 300px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-container input {
      width: 95%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .login-container button {
      width: 103%;
      padding: 10px;
      background: #2563eb;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    .login-container button:hover {
      background: #1d4ed8;
    }

    .login-container p {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-container a {
      color: #2563eb;
      text-decoration: none;
    }

    .alert {
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      text-align: center;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

  </style>



</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-error">
        <ul style="margin: 0; padding-left: 20px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ url('/Login') }}" method="POST"> 
      @csrf
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">Login</button> 
      </form>
    
    <p>Don't have an account? <a href="#">Register</a></p>

    
  </div>
</body>
</html>
