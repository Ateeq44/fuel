<section class="py-3">
    <header>
        <h2 class="h5 text-dark">
            Eliminar Cuenta
        </h2>

        <p class="text-muted small mt-1">
            Una vez que su cuenta sea eliminada, todos sus recursos y datos se eliminarán de forma permanente.
            Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.
        </p>
    </header>

    <!-- Delete Button -->
    <button type="button" class="btn btn-danger"
        data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Eliminar Cuenta
    </button>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">¿Está seguro de que desea eliminar su cuenta?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">
                            Una vez que su cuenta sea eliminada, todos sus recursos y datos se eliminarán de forma permanente.
                            Ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Contraseña"
                            >
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Eliminar Cuenta
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>
