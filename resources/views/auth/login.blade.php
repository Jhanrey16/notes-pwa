<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Notes - Login</title>

  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#0f172a">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" />

  @vite('resources/css/app.css')

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

    .page-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 18px;
      width: 100%;
      max-width: 430px;
    }

    .form-card {
      background: #3f3f3f;
      border: 1px solid #4b4b4b;
      box-shadow: 0 15px 40px rgba(0,0,0,0.45);
      border-radius: 20px;
      width: 100%;
      padding: 30px;
    }

    .glass-card {
      background: rgba(63, 63, 63, 0.96);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 15px 40px rgba(0,0,0,0.35);
      border-radius: 20px;
      width: 100%;
      padding: 24px;
    }

    #weather {
      color: #ffffff;
    }

    #weather h5 {
      font-size: 1.05rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .weather-temp {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .weather-desc {
      color: #d1d1d1;
      text-transform: capitalize;
      font-size: 0.95rem;
    }

    .icon-circle {
      background: #e5e5e5;
      width: 52px;
      height: 52px;
      margin: 0 auto 12px;
      border-radius: 50%;
    }

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

    label {
      color: #d1d1d1;
      font-size: 13px;
      margin-bottom: 6px;
      display: block;
    }

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
      opacity: 0.4;
    }

    .input-field:focus {
      border-color: #d4b24c;
      box-shadow: 0 0 0 3px rgba(212,178,76,0.25);
      outline: none;
    }

    .submit-btn,
    #installBtn {
      width: 100%;
      background: #8a7a2f;
      border: 1px solid #d4b24c;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 600;
      padding: 10px;
      margin-top: 10px;
      cursor: pointer;
      color: white;
    }

    .submit-btn:hover,
    #installBtn:hover {
      background: #a8913a;
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
      padding-left: 38px;
    }
  </style>
</head>

<body>
  <div class="page-wrapper">

    <div class="glass-card shadow-lg">
      <div class="card-body text-center" id="weather">
        @if(isset($weather))
          <h5>{{ $weather['city'] }}</h5>
          <div class="weather-temp">{{ $weather['temp'] }}°C</div>
          <div class="weather-desc">{{ $weather['description'] }}</div>
        @else
          <div class="weather-desc">Loading weather...</div>
        @endif
      </div>
    </div>

    <div class="form-card p-6">

      <div class="flex justify-center mb-6">
        <div class="icon-circle w-14 h-14 flex items-center justify-center">
          <i class="fa-solid fa-circle-user login-icon"></i>
        </div>
      </div>

      <h1 class="text-2xl font-semibold text-center mb-2">
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
          <label>Email Address</label>
          <div class="input-wrapper">
            <i class="fa-regular fa-envelope input-icon"></i>
            <input
              type="email"
              name="email"
              value="{{ old('email') }}"
              required
              placeholder="you@example.com"
              class="input-field">
          </div>
        </div>

        <div>
          <label>Password</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock input-icon"></i>
            <input
              type="password"
              name="password"
              required
              placeholder="Enter your password"
              class="input-field">
          </div>
        </div>

        <button type="submit" class="submit-btn">
          Login
        </button>
      </form>

      <p class="text-center text-gray-300 text-sm mt-6">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-white font-medium hover:underline">
          Register
        </a>
      </p>

      <button id="installBtn" style="display:none;">
        Install App
      </button>

    </div>
  </div>

  <script>
    async function loadWeather() {
      try {
        const res = await fetch('/weather');
        const data = await res.json();

        document.getElementById('weather').innerHTML = `
          <h5>${data.name}</h5>
          <div style="font-size:1.8rem;font-weight:bold;">
            ${data.main.temp}°C
          </div>
          <div style="text-transform: capitalize;">
            ${data.weather[0].description}
          </div>
        `;
      } catch (error) {
        console.error("Weather load failed", error);
      }
    }

    loadWeather();
    setInterval(loadWeather, 60000);
  </script>

  <script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js')
        .then(() => console.log('Service Worker Registered'))
        .catch(error => console.log('Service Worker Failed', error));
    }
  </script>

  <script>
    let deferredPrompt;
    const installBtn = document.getElementById('installBtn');

    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
      installBtn.style.display = 'block';
    });

    installBtn.addEventListener('click', async () => {
      if (!deferredPrompt) return;

      deferredPrompt.prompt();

      const choiceResult = await deferredPrompt.userChoice;

      if (choiceResult.outcome === 'accepted') {
        installBtn.style.display = 'none';
      }

      deferredPrompt = null;
    });
  </script>
</body>
</html>