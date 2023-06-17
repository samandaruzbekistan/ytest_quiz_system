<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="./registration.css" />
  </head>
  <body>
    <div class="container">
      @if (session('phone_error') == "1")
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Xatolik!</strong> Bu telefon raqam avval ro'yhatdan o'tgan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @elseif (session('code_error') == "1")
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Xatolik!</strong> Parol notogri.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @elseif (session('reset') == "1")
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Tabriklaymiz!</strong> Parolingiz tiklandi
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="forms">
        <div class="form login">
          <span class="title">Kirish</span>

          <form action="{{ route('user_check') }}" method="POST">
            @csrf
            <div class="input-field">
              <input type="text" name="phone" placeholder="Telefon raqam" required />
              <i class="uil uil-phone icon"></i>
            </div>
            <div class="input-field">
              <input
              name="password"
                type="password"
                class="password"
                placeholder="Parol kiritish"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>

            <div class="checkbox-text">
              <div class="checkbox-content">
                <input type="checkbox" id="logCheck" required/>
                <label for="logCheck" class="text">Eslab qolish</label>
              </div>

              <a href="{{ route('reset_form') }}" class="text">Parolni unutdingizmi?</a>
            </div>

            <div class="input-field button">

                <input type="submit" value="Kirish" required/>
            
            </div>
          </form>

          <div class="login-signup">
            <span class="text"
              >A'zo emasmisiz?
              <a href="#" class="text signup-link">Ro'yxatdan o'tish</a>
            </span>
          </div>
        </div>

        <!-- Registration Form -->
        <div class="form signup">
          <span class="title">Ro'yxatdan o'tish</span>
          @if ($errors->any())
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
          @endif
          <form action="{{ route('sendSms') }}" method="POST">
            @csrf
            <div class="input-field">
              <input type="text" placeholder="Ism va familyangiz" required name="full_name" />
              <i class="uil uil-user"></i>
            </div>
            <div class="input-field">
              <input type="text" placeholder="Telefon raqam (+998)" required name="phone" />
              <i class="uil uil-phone icon"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                class="password"
                placeholder="Parol yaratish"
                required
                name="password"
              />
              <i class="uil uil-lock icon"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                class="password"
                placeholder="Parolni qayta kiritish"
                required
                name="confirm_password"
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>

            <div class="checkbox-text">
              <div class="checkbox-content">
                <input type="checkbox" id="termCon" />
                <label for="termCon" class="text"
                  >Foydalanish shartlariga rozi bo'lish</label
                >
              </div>
            </div>

            <div class="input-field button">
             
                <input type="submit" value="Ro'yhatdan o'tish" />
              
            </div>
          </form>

          <div class="login-signup">
            <span class="text"
              >Allaqachon a'zomisiz?
              <a href="#" class="text login-link">Kirish</a>
            </span>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/registr.js"></script>
  </body>
</html>
