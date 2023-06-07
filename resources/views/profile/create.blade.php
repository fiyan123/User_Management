<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Data Profile Anda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Edukasi / Pendidikan</label>
                        <input type="text" class="form-control  @error('edukasi') is-invalid @enderror" name="edukasi"
                            value="{{ old('edukasi') }}" placeholder="edukasi">

                        @error('edukasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Anda</label>
                        <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror" id=""
                            cols="" rows="" value="{{ old('alamat') }}" placeholder="alamat anda"></textarea>

                        @error('alamat')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="notes" class="form-control  @error('notes') is-invalid @enderror" id="" cols=""
                            rows="" value="{{ old('notes') }}" placeholder="catatan anda"></textarea>

                        @error('notes')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="number" class="form-control  @error('no_telepon') is-invalid @enderror"
                            name="no_telepon" value="{{ old('no_telepon') }}" placeholder="no telepon anda">

                        @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" id="btnReset" data-bs-toggle="tooltip"
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