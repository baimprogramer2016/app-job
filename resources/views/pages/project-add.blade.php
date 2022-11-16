<form action="{{ route('proses-project-store') }}" method="POST">
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
    />
</div>

<div class="col-12">
    <label
        for="alias"
        class="form-label"
        >Alias</label
    >
    <input
        type="text"
        class="form-control"
        id="alias"
        name='alias'
        required
    />
</div>

<div class="col-12">
    <label
        for="nama"
        class="form-label"
        >Nama Project</label
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