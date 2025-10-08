<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN FORM</title>

   <link rel="stylesheet" href="login.css">

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
