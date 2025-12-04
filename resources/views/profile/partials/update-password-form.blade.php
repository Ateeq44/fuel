<section class="py-3">

    <header>
        <h2 class="h5 text-dark">Actualizar Contraseña</h2>
        <p class="text-muted small mt-1">
            Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Contraseña Actual</label>
            <input type="password"
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                   id="update_password_current_password"
                   name="current_password"
                   autocomplete="current-password">

            @error('current_password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">Nueva Contraseña</label>
            <input type="password"
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                   id="update_password_password"
                   name="password"
                   autocomplete="new-password">

            @error('password', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password"
                   class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                   id="update_password_password_confirmation"
                   name="password_confirmation"
                   autocomplete="new-password">

            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Buttons + Success Message -->
        <div class="d-flex align-items-center gap-3">

            <button class="btn btn-primary" type="submit">Guardar</button>

            @if (session('status') === 'password-updated')
                <span class="text-success small" id="savedMessage">Guardado.</span>
            @endif

        </div>
    </form>
</section>

<!-- Auto hide success message -->
@if (session('status') === 'password-updated')
<script>
    setTimeout(() => {
        let msg = document.getElementById('savedMessage');
        if (msg) msg.style.display = 'none';
    }, 2000);
</script>
@endif
