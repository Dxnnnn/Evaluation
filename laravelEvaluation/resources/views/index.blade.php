<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login Form</title>

<style>
   body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('/images/benedicto-college.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

   .login-container {
  width: 400px;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(0,0,0,0.3);
  text-align: center;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  position: relative;
  backdrop-filter: blur(10px);
}

.login-container::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  opacity: 0.3;
  pointer-events: none;
  z-index: 1;
}


    .login-header {
      position: relative;
      height: 200px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .login-header::after {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(255,255,255,0.1);
    }

    .profile-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
      border: 4px solid #ffffff;
      z-index: 2;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .login-header h2 {
      position: absolute;
      top: 70%;
      left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      color: #ffffff;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .login-body {
      padding: 30px;
      position: relative;
      z-index: 2;
    }

    .input-group {
      position: relative;
      margin: 20px 0;
    }

      .password-input-container {
       position: relative;
       display: flex;
       align-items: center;
       gap: 8px;
      width: 100%;
    }

.input-group input {
  width: 100%;
  padding: 16px 12px 8px 12px;
  border: 2px solid rgba(255,255,255,0.3);
  border-radius: 8px;
  background: rgba(255,255,255,0.1);
  font-size: 16px;
  transition: all 0.3s ease;
  box-sizing: border-box;
  position: relative;
  z-index: 3;
  color: #ffffff;
}

.password-input-container input {
  width: 100%;
  flex-shrink: 0;

}


.password-input-container label {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: rgba(255,255,255,0.7);
  font-size: 16px;
  font-weight: 500;
  transition: all 0.3s ease;
  pointer-events: none;
  z-index: 4;
}

.password-input-container input:focus + label,
.password-input-container input:not(:placeholder-shown) + label {
  top: 8px;
  font-size: 12px;
  color: rgba(255,255,255,0.9);
  font-weight: 600;
  transform: translateY(0);
}

.password-input-container input:focus + label {
  color: #ffffff;
}

    .input-group input:focus {
      outline: none;
      border-color: rgba(255,255,255,0.8);
      background: rgba(255,255,255,0.15);
      box-shadow: 0 0 0 3px rgba(255,255,255,0.1);
    }

    .input-group input::placeholder {
      color: transparent;
    }

    .input-group label {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255,255,255,0.7);
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
      pointer-events: none;
      z-index: 4;
    }

    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label {
      top: 8px;
      font-size: 12px;
      color: rgba(255,255,255,0.9);
      font-weight: 600;
      transform: translateY(0);
    }

    .input-group input:focus + label {
      color: #ffffff;
    }

.eye-icon {
  width: 12px;
  height: 12px;
}

.toggle-password {
  background: none;
  border: none;
  color: rgba(255,255,255,0.4);
  cursor: pointer;
  padding: 2px;
  border-radius: 2px;
  transition: all 0.2s ease;
  z-index: 5;
  width: 10%;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  position: absolute;
  left:295px;
  top: 10px;
}






.login-body button[type="submit"] {
   width: 70%;
   padding: 12px;
   margin-top: 15px;
      background: #27D25A;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(39,210,90,0.3);
      position: relative;
      z-index: 3;
    }

    .login-body button[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(39,210,90,0.4);
    }

    .error-message {
      background: rgba(255, 0, 0, 0.1);
      border: 1px solid rgba(255, 0, 0, 0.3);
      color: #ff0000;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
      font-weight: 500;
    }
</style>

</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <div class="profile-icon"></div>
      <h2>User Account</h2>
    </div>
    <div class="login-body">
      <form id="loginForm">
        <div id="errorMessage" class="error-message" style="display: none;"></div>
                 <div class="input-group">
           <input type="text" id="username" name="username" placeholder=" " required>
           <label for="username">Username</label>
         </div>
                             <div class="input-group">
                 <div class="password-input-container">
                   <input type="password" id="password" name="password" placeholder=" " required>
                   <label for="password">Password</label>
                   <button type="button" id="togglePasswordVisibility" class="toggle-password">
                     <svg class="eye-icon" viewBox="0 0 24 24" fill="currentColor">
                       <path id="eyePath" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                     </svg>
                   </button>
                 </div>
               </div>
        <button type="submit">LOGIN</button>
      </form>
    </div>
     </div>

       <script>
      const passwordInput = document.getElementById('password');
      const toggleButton = document.getElementById('togglePasswordVisibility');
      const eyePath = document.getElementById('eyePath');
      const loginForm = document.getElementById('loginForm');
      const errorMessage = document.getElementById('errorMessage');

      toggleButton.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyePath.setAttribute('d', 'M13.359 11.238C15.06 9.72 16.8 8.5 18 8.5c1.5 0 3.5 2.5 3.5 3.5 0 1-2 3.5-3.5 3.5-1.2 0-2.94-1.22-4.641-2.738L13.359 11.238zM12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z');
          toggleButton.style.color = 'rgba(255,255,255,0.8)';
        } else {
          passwordInput.type = 'password';
          eyePath.setAttribute('d', 'M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z');
          toggleButton.style.color = 'rgba(255,255,255,0.4)';
        }
      });

      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted!');
        
        const formData = new FormData(loginForm);
        const username = formData.get('username');
        const password = formData.get('password');
        
        console.log('Username:', username);
        console.log('Password:', password);
        
        fetch('/auth/login', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
          body: JSON.stringify({
            username: username,
            password: password
          })
        })
        .then(response => {
          console.log('Response status:', response.status);
          return response.json();
        })
        .then(data => {
          console.log('Response data:', data);
          if (data.success) {
            errorMessage.style.display = 'none';
            // Redirect to dashboard or show success message
            window.location.href = '/dashboard';
          } else {
            errorMessage.textContent = data.message;
            errorMessage.style.display = 'block';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          errorMessage.textContent = 'An error occurred. Please try again.';
          errorMessage.style.display = 'block';
        });
      });
    </script>
 </body>
</html>

