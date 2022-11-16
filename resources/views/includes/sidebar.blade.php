<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->
        @if (Auth::user()->koderole == 'admin')
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#pengaturan-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-gear"></i><span>Pengaturan</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="pengaturan-nav"
                class="nav-content collapse {{ (request()->is('pengaturan*')) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="{{ route('divisi') }}" class="{{ (request()->is('pengaturan/divisi*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Divisi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('unit') }}" class="{{ (request()->is('pengaturan/unit*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Unit</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('akses') }}" class="{{ (request()->is('pengaturan/akses*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Akses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('role') }}" class="{{ (request()->is('pengaturan/role*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Role</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('level') }}" class="{{ (request()->is('pengaturan/level*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Level</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}" class="{{ (request()->is('pengaturan/pengguna*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i
                        ><span>Pengguna</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <!-- End Components Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#project-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-diagram-3"></i><span>Project</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="project-nav"
                class="nav-content collapse  {{ (request()->is('project*')) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="{{ route('project') }}" class="{{ (request()->is('project/project*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i
                        ><span>Project</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-project') }}" class="{{ (request()->is('project/my-project*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i
                        ><span>Project Ku</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Forms Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#perkerjaan-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-list-check"></i
                ><span>Pekerjaan Harian</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="perkerjaan-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="{{ route('pekerjaan') }}" class="{{ (request()->is('pekerjaan/pekerjaan*')) ? 'active' : '' }}">
                        <i class="bi bi-circle"></i
                        ><span>Pekerjaan</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Tables Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#dokumen-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-folder"></i><span>Dokumen</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="dokumen-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="dokumen.html">
                        <i class="bi bi-circle"></i
                        ><span>Daftar Dokument</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Charts Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#eoffice-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-envelope-open"></i><span>E-Office</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="eoffice-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="buat_surat.html">
                        <i class="bi bi-circle"></i
                        ><span>Buat Surat</span>
                    </a>
                </li>
                <li>
                    <a href="surat_masuk.html">
                        <i class="bi bi-circle"></i
                        ><span>Surat Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="surat_keluar.html">
                        <i class="bi bi-circle"></i
                        ><span>Surat Keluar</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Icons Nav -->
        <!-- End Charts Nav -->

        <li class="nav-item">
            <a
                class="nav-link collapsed"
                data-bs-target="#helpdesk-nav"
                data-bs-toggle="collapse"
                href="#"
            >
                <i class="bi bi-telephone"></i><span>Helpdesk</span
                ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="helpdesk-nav"
                class="nav-content collapse"
                data-bs-parent="#sidebar-nav"
            >
                <li>
                    <a href="buat_surat.html">
                        <i class="bi bi-circle"></i><span>Tiket</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Icons Nav -->

        <li class="nav-heading">Lainnya</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="info.html">
                <i class="bi bi-info-square"></i>
                <span>Info</span>
            </a>
        </li>
        <!-- End Blank Page Nav -->
    </ul>
</aside>