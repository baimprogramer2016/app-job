<form action="{{ route('proses-pekerjaan-store') }}" method="POST">
    @csrf

<div class="col-12">
    <label for="subject" class="form-label"
        >Subject</label
    >
    <input
        type="text"
        class="form-control"
        id="subject"
        name='subject'
        required
    />
</div>

<div class="col-12">
    <label class="col-sm-2 col-form-label">Deskripsi Pekerjaan</label>
                    <div class="col-sm-12">
                        <textarea
                        id='deskripsi'
                        name='deskripsi'
                        class="form-control"
                        placeholder="Tulis Deskripsi Pekerjaan"
                        id="floatingTextarea"
                        style="height: 100px"
                        required
                      ></textarea>
                    </div>
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

<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'deskripsi' );
</script>


