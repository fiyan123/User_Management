<div class="modal fade" id="modal-permissions">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Nama Permissions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('permission.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Permission</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
            </div>

            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" id="btnSimpan" data-bs-toggle="tooltip"
                    data-bs-placement="top">
                    <dt class="the-icon"><span class="fa-fw select-all fas"></span> Reset</dt>
                </button>
                <button type="submit" class="btn btn-primary" id="btnSimpan" data-bs-toggle="tooltip"
                    data-bs-placement="top">
                    <dt class="the-icon"><span class="fa-fw select-all fas"></span> Simpan</dt>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>