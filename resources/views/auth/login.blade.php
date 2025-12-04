<html>
<head>
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h3 class="mb-5 text-center">Iniciar sesión</h3>
            <form method="POST" action="/login">
            @csrf
              <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="email">Correo electrónico</label>
                  <input type="email" id="email" class="form-control form-control-lg" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="password">Contraseña</label>
                  <input type="password" id="password" class="form-control form-control-lg"  name="password" required autocomplete="current-password"/>
                  @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>

              <!-- Checkbox -->
              <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                <label class="form-check-label" for="form1Example3"> Recordar contraseña </label>
              </div>

              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block w-100" type="submit">Acceder</button>
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
