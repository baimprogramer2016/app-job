<form action="{{ route('pengguna-update', $datapengguna->id) }}" method="POST">
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
        value="{{ $datapengguna->kode }}"
        
    />
</div>
<div class="col-12">
    <label for="nama" class="form-label"
        >Nama Pengguna</label
    >
    <input
        type="text"
        class="form-control"
        id="nama"
        name='nama'
        required
        value="{{ $datapengguna->nama }}"
    />
</div>
<div class="col-12">
    <label for="email" class="form-label"
        >Email</label
    >
    <input
        type="email"
        class="form-control"
        id="email"
        name='email'
        required
        value="{{ $datapengguna->email }}"
    />
</div>
<div class="col-12">
    <label for="password" class="form-label"
        >Password</label
    >
    <input
        type="hidden"
        class="form-control"
        id="password_old"
        name='password_old'
        required
        value="{{ $datapengguna->password }}"
    />
    <input
        type="password"
        class="form-control"
        id="password"
        name='password'
        required
        value="{{ $datapengguna->password }}"
    />
</div>

<div class="col-12">
    <label for="kodeunit" class="form-label"
        >Unit</label
    >
    <select
        id="kodeunit"
        class="form-select"
        name="kodeunit"
        aria-label="Default select example"
    >
        <option value="{{ $datapengguna->kodeunit }}">
            {{ $datapengguna->unit->nama }}
        </option>
        @foreach ($dataunit as $item_unit)
        <option value="{{ $item_unit->kode }}">{{ $item_unit->nama }}</option>
        @endforeach
        
    </select>
</div>
<div class="col-12">
    <label for="koderole" class="form-label"
        >Role</label
    >
    <select
        id="koderole"
        class="form-select"
        name="koderole"
        aria-label="Default select example"
    >
        <option value="{{ $datapengguna->koderole }}">
            {{ $datapengguna->role->nama }}
        </option>
        @foreach ($datarole as $item_role)
        <option value="{{ $item_role->kode }}">{{ $item_role->nama }}</option>
        @endforeach
        
    </select>
</div>
<div class="col-12">
    <label for="kodelevel" class="form-label"
        >Level</label
    >
    <select
        id="kodelevel"
        class="form-select"
        name="kodelevel"
        aria-label="Default select example"
    >
        <option value="{{ $datapengguna->kodelevel }}">
            {{ $datapengguna->level->nama }}
        </option>
        @foreach ($datalevel as $item_level)
        <option value="{{ $item_level->kode }}">{{ $item_level->nama }}</option>
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
                {{ ($datapengguna->allowed == 1)?'checked': '' }}
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
                {{ ($datapengguna->allowed == 0)?'checked': '' }}
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