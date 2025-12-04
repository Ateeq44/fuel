<section>
    <header class="mb-3">
        <h2 class="h5 text-dark">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="text-muted small">
            {{ __("Actualice la información del perfil de su cuenta y la dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Email Verification --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-dark">
                        {{ __('Su dirección de correo electrónico no ha sido verificada.') }}

                        <button form="send-verification" class="btn btn-link p-0 small">
                            {{ __('Haga clic aquí para re-enviar el correo de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success py-1 small mt-2 mb-1">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su correo electrónico.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Save Button --}}
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary">{{ __('Guardar') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success small mb-0">{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
