<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukkan Data Article</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('article.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control  @error('judul') is-invalid @enderror" name="judul"
                            value="{{ old('judul') }}" placeholder="judul">
                        @error('judul')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Article</label>
                        <textarea name="isi" class="form-control  @error('isi') is-invalid @enderror" id="" cols="30"
                            rows="10" value="{{ old('isi') }}" placeholder="isi article"></textarea>
                        @error('isi')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pembuat Article</label>
                        <input type="text" class="form-control  @error('pembuat') is-invalid @enderror" name="pembuat"
                            value="{{ old('pembuat') }}" placeholder="nama pembuat">
                        @error('pembuat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal DIbuat Article</label>
                        <input type="date" class="form-control  @error('tanggal_dibuat') is-invalid @enderror"
                            name="tanggal_dibuat" value="{{ old('tanggal_dibuat') }}" placeholder="tanggal dibuat">
                        @error('tanggal_dibuat')
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