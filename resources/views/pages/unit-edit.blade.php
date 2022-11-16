<form action="{{ route('unit-update',$dataunitedit->id) }}" method="POST">
    @csrf
<div class="col-12">
    <label for="kode" class="form-label"
        >Kode</label
    >
    <input
        type="text"
        class="form-control"
        id="kode"
        name='kode'
        required
        readonly
        value="{{ $dataunitedit->kode }}"
    />
</div>
<div class="col-12">
    <label for="nama" class="form-label"
        >Nama unit</label
    >
    <input
        type="text"
        class="form-control"
        id="nama"
        name='nama'
        required
        value="{{ $dataunitedit->nama }}"
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
        value="{{ $dataunitedit->deskripsi }}"
    />
</div>
<div class="col-12">
    <label for="divisi" class="form-label"
        >Divisi</label
    >
    <select
        id="divisi"
        class="form-select"
        name="kodedivisi"
        aria-label="Default select example"
    >
        <option value="{{ $dataunitedit->kodedivisi }}">{{ $dataunitedit->divisi->nama }}</option>
        @foreach ($datadivisi as $item_divisi)
        <option value="{{ $item_divisi->kode }}">{{ $item_divisi->nama }}</option>
        @endforeach
        
    </select>
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
                {{ ($dataunitedit->allowed == 1)?'checked': '' }}
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
                {{ ($dataunitedit->allowed == 0)?'checked': '' }}
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