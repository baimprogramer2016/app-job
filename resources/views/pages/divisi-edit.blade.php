<form action="{{ route('divisi-update',$datadivisiedit->id) }}" method="POST">
    @csrf
<div class="col-12">
    <label for="kode" class="form-label"
        >Kode</label
    >
    <input
        type="text"
        readonly
        class="form-control"
        id="kode"
        name='kode'
        required
        value="{{ $datadivisiedit->kode }}"
        
    />
</div>
<div class="col-12">
    <label for="nama" class="form-label"
        >Nama Divisi</label
    >
    <input
        type="text"
        class="form-control"
        id="nama"
        name='nama'
        required
        value="{{ $datadivisiedit->nama }}"
    />
</div>
<div class="col-12">
    <label
        for="deskripsi"
        class="form-label"
        >Deskripsi</label
    >
    <input
        type="text"
        class="form-control"
        id="deskripsi"
        name='deskripsi'
        required
        value="{{ $datadivisiedit->deskripsi }}"
    />
</div>
<fieldset class="row mb-3 mt-2">
    <legend
        class="col-form-label col-sm-2 pt-0"
    >
        Radios
    </legend>
    <div class="col-sm-10">
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="allowed"
                id="aktif"
                value="1"
                {{ ($datadivisiedit->allowed == 1)?'checked': '' }}
            />
            <label
                class="form-check-label"
                for="aktif"
            >
                Aktif
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="allowed"
                id="tidakaktif"
                value="0"
                {{ ($datadivisiedit->allowed == 0)?'checked': '' }}
            />
            <label
                class="form-check-label"
                for="tidakaktif"
            >
                Tidak Aktif
            </label>
        </div>
    </div>
</fieldset>
<div class="modal-footer">
    <button
        type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal"
    >
        Keluar
    </button>
    <button
        type="submit"        
        class="btn btn-success"
    >
        Update
    </button>
</div>
</form>