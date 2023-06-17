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
    <link rel="stylesheet" href="{{ URL::asset('registration.css') }}" />
  </head>
  <body>
    <div class="container">
      @if (session('error') == "1")
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Xatolik!</strong> Parollar bir xil emas.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="forms">
        <div class="form login">
          <span class="title">Sizga parolingizni tiklash uchun sms xabar jo'natildi!</span>

          

          
        </div>

        
      </div>
    </div>

    <script src="{{ URL::asset('js/registr.js') }}"></script>
  </body>
</html>
