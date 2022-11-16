<form action="{{ route('role-access-store') }}" method="POST">
    @csrf
    
<div class="col-12">
    <input type="hidden" value="{{ $koderole }}" name="koderole">
    <legend class="col-form-label col-sm-12 pt-0">
        Daftar Akses 
      </legend>
      <div class="col-sm-10">
        @foreach ($dataaccess as $item_access)
            <div class="form-check">
            <input
                class="form-check-input"
                type="checkbox"
                name="kodeakses[]"
                value="{{ $item_access->kode }}"
                {{ checkAccess($roleakses, $item_access->kode) }} 
            />
            <label class="form-check-label" for="gridCheck1">
               <strong> {{ $item_access->kode }}</strong> - {{ $item_access->nama }}
            </label>
            </div>
        @endforeach
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