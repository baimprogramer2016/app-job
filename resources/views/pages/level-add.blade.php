<form action="{{ route('level') }}" method="POST">
    @csrf

<div class="col-12">
    <label for="nama" class="form-label"
        >Nama Level</label
    >
    <input
        type="text"
        class="form-control"
        id="nama"
        name='nama'
        required
    />
</div>
<div class="col-12">
    <label for="seqno" class="form-label"
        >Kode</label
    >
    <select
    id="kode"
    class="form-select"
    name="kode"
    aria-label="Default select example"
>   
    <option value="">
        ---- Pilih Tingkatan ---
    </option>
    @foreach ($number as $no)

    <option value="{{ $no }}">{{ $no }}</option>
    @endforeach
    
    </select>
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
                checked
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
        Simpan
    </button>
</div>
</form>