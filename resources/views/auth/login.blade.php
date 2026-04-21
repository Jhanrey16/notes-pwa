<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./output.css" rel="stylesheet" />
  <title>Notes - Login</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  crossorigin="anonymous"
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
    width: 52px;
    height: 52px;
    margin: 0 auto 12px;
    border-radius: 50%;
  }

  .icon-circle svg {
    color: #2b2b2b;
    width: 24px;
    height: 24px;
  }

  /* Titles */
  h1 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 4px;
    color: #ffffff;
  }

  p {
    font-size: 12px;
    color: #cccccc;
    margin-bottom: 14px;
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
    font-size: 11px;
    margin-top: 14px;
    color: #cccccc;
  }

  .footer-text a {
    color: #d4b24c;
    display: block;
    margin-top: 4px;
  }

  .footer-text a:hover {
    color: #f1d774;
  }
  .login-icon {
  font-size: 60px;
  color: #2b2b2b;
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

<body class="flex items-center justify-center min-h-screen px-4">
  <div class="gradient-glow glow-1"></div>
  <div class="gradient-glow glow-2"></div>

  <div class="form-card p-6">
    <!-- Icon -->
    <div class="flex justify-center mb-6">
      <div class="icon-circle w-14 h-14 flex items-center justify-center">
        <i class="fa-solid fa-circle-user login-icon"></i>

      </div>
    </div>

    <h1 class="text-2xl font-semibold text-center mb-2 heading-gradient">
      Login
    </h1>
    <p class="text-center text-gray-300 text-sm mb-6">
      Sign in to your account
    </p>

    <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
      @csrf

      @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm p-3 rounded-[5px]">
          {{ $errors->first() }}
        </div>
      @endif

      <div>
        <label class="text-sm text-gray-200 block mb-2">Email Address</label>
        <div class="input-wrapper">
        <i class="fa-regular fa-envelope input-icon"></i>
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          placeholder="you@example.com"
          class="input-field w-85% px-4 py-2.5"
        >
        </div>
      </div>

      <div>
        <label class="text-sm text-gray-200 block mb-2">Password</label>
        <div class="input-wrapper">
          <i class="fa-solid fa-lock input-icon"></i>
        <input
          type="password" name="password" required placeholder="Enter your password"class="input-field w-85% px-4 py-2.5">
        </div>
      </div>

      <button type="submit" class="submit-btn w-85% py-2.5 text-white">
        Login
      </button>
    </form>

    <p class="text-center text-gray-300 text-sm mt-6">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-white font-medium hover:underline">
        Register
      </a>
    </p>
  </div>
</body>
</html>
