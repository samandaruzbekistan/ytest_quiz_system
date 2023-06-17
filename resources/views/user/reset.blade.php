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
      @if (session('error') == "1")
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Xatolik!</strong> Ushbu raqam tizimda ro'yhatdan o'tmagan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="forms">
        <div class="form login">
          <span class="title">Parolni tiklash</span>

          <form action="{{ route('reset') }}" method="POST">
            @csrf
            <div class="input-field">
              <input type="text" name="phone" placeholder="Telefon raqam (+998)" required />
              <i class="uil uil-phone icon"></i>
            </div>
           
            <div class="input-field button">

                <input type="submit" value="Tiklash" required/>
            
            </div>
          </form>

          
        </div>

        
      </div>
    </div>

    <script src="./js/registr.js"></script>
  </body>
</html>
