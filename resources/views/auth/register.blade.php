<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notes - Sign Up</title>

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
  <script src="https://kit.fontawesome.com/9311b9b068.js" crossorigin="anonymous"></script>
  

  <style>
    body {
      background: linear-gradient(180deg, #3a3a3a, #2b2b2b);
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    /* Card */
    .form-card {
      background: #3f3f3f;
      border: 1px solid #4b4b4b;
      box-shadow: 0 15px 40px rgba(0,0,0,0.45);
      border-radius: 14px;
      max-width: 430px;
      width: 100%;
      padding: 30px;
    }

    /* Icon */
    .icon-circle {
      background: #e5e5e5;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
    }

    .icon-circle svg {
      width: 26px;
      height: 26px;
      color: #2b2b2b;
    }

    h1 {
      color: #ffffff;
      font-size: 22px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
    }

    /* Labels */
    label {
      color: #d1d1d1;
      font-size: 13px;
      margin-bottom: 6px;
      display: block;
    }

    /* Inputs */
    .input-field {
      width: 100%;
      background: #6a6a6a;
      border: 1px solid #7a7a7a;
      border-radius: 10px;
      color: #ffffff;
      font-size: 14px;
      padding: 10px 12px;
    }

    .input-field::placeholder {
      color: #e0e0e0;
      opacity: 0.4;        /* lower = more faded */
      
    }

    .input-field:focus {
      border-color: #d4b24c;
      box-shadow: 0 0 0 3px rgba(212,178,76,0.25);
      outline: none;
    }

    /* Button */
    .submit-btn {
      width: 100%;
      background: #8a7a2f;
      border: 1px solid #d4b24c;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 600;
      padding: 10px;
      margin-top: 10px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background: #a8913a;
    }

    /* Footer */
    .footer-text {
      text-align: center;
      margin-top: 24px;
      font-size: 13px;
      color: #cccccc;
    }

    .footer-text a {
      color: #d4b24c;
      font-weight: 600;
      text-decoration: none;
    }

    .footer-text a:hover {
      color: #f1d774;
    }

    .form-group {
      margin-bottom: 18px;
    }
    .input-wrapper {
  position: relative;
}

.input-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #e0e0e0;
  font-size: 14px;
}

.input-wrapper .input-field {
  padding-left: 38px; /* makes space for icon */
}
  </style>

  @vite('resources/css/app.css')
</head>

<body>

  <div class="form-card">

    <!-- Icon -->
    <div class="icon-circle">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
      </svg>
    </div>

    <h1>Registration</h1>

    <!-- Error -->
    @if ($errors->any())
      <div style="background:#5a1f1f; padding:12px; border-radius:8px; color:#ffb4b4; font-size:13px; margin-bottom:20px;">
        {{ $errors->first() }}
      </div>
    @endif

    <!-- Form -->
    <form action="{{ route('register.perform') }}" method="POST">
      @csrf

      <div class="form-group">
        <label>Full Name</label>

        <div class="input-wrapper">
          <i class="fa-regular fa-user input-icon"></i>
          <input type="text" name="name" value="{{ old('name') }}" required
            class="input-field" placeholder="John Doe">
        </div>
      </div>

      <div class="form-group">
          <label>Email Address</label>

      <div class="input-wrapper">
        <i class="fa-regular fa-envelope input-icon"></i>
        <input type="email" name="email" value="{{ old('email') }}" required
          class="input-field" placeholder="you@example.com">
      </div>
    </div>

      <div class="form-group">
        <label>Password</label>
        <div class="input-wrapper">
          <i class="fa-solid fa-lock input-icon"></i>
        <input type="password" name="password" required placeholder="Your password"
          class="input-field" >
      </div>
      </div>

      <div class="form-group">
       
        <label>Confirm Password</label>
         <div class="input-wrapper">
          <i class="fa-solid fa-lock input-icon"></i>
          <input type="password" name="password_confirmation" required
            class="input-field" placeholder="Confirm your password">
        </div>
      </div>

      <button type="submit" class="submit-btn">
        Create Account
      </button>
    </form>

    <div class="footer-text">
      Already have an account?
      <a href="{{ route('login') }}">Log In</a>
    </div>

  </div>

</body>
</html>
