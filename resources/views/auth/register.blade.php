<!doctype html>
<html lang="en">
  <head>
    <title>Register</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @vite('resources/scss/auth.scss')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="form-container" >
      <div class="form-container">
        <form action="{{route('user.register-post')}}" method="post">
            @csrf
          <h1 class="h3 mb-3 font-weight-normal text-center">Register</h1>
          <div class="form-group">
            <label for="registerName">Full Name</label>
            <input type="text" name="name" id="registerName" class="form-control" placeholder="Full Name" required>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
           @endif
          </div>
          <div class="form-group">
            <label for="registerEmail">Email address</label>
            <input type="email" name="email" id="registerEmail" class="form-control" placeholder="Email address" required>
          </div>
          <div class="form-group">
            <label for="registerPassword">Password</label>
            <input type="password" name="password" id="registerPassword" class="form-control" placeholder="Password" required>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="registerRePassword">Confirm Password</label>
            <input type="password" name="password_confirmation" id="registerRePassword" class="form-control" placeholder="Confirm Password" required>
            @if ($errors->has('password_confirmation'))
            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif 
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
          <a href="" class="login-link">Go to Login</a>
          <p class="mt-5 mb-3 text-muted text-center">&copy; 2024</p>
        </form>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>