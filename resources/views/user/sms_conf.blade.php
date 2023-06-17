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
      @endif
      <div class="forms">
        <div class="form login">
          <span class="title">Kirish</span>

          <form action="{{ route('reg') }}" method="POST">
            @csrf
            <div class="input-field">
              <input type="text" name="code" placeholder="Code..." required />
              <i class="uil key-skeleton icon"></i>
            </div>
           
            <div class="input-field button">

                <input type="submit" value="Kirish" required/>
            
            </div>
          </form>

          
        </div>

        
      </div>
    </div>

    <script src="./js/registr.js"></script>
  </body>
</html>
