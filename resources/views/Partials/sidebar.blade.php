<!-- ======= Sidebar ======= -->
@php
    $userRole = auth()->user()->jobdesks->role;
    $userKlmpk = auth()->user()->kelompok;
@endphp


<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Start Dashboard Nav -->
        @if ($userRole != 'Penanggung Jawab')
            <li class="nav-item">
                <a class="nav-link {{ $judul === 'Dashboard' ? '' : 'collapsed' }}" href="/">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endif
        @if (str_contains('IRBAN|DALNIS|Anggota|SEKRETARIS|INSPEKTUR|Admin|SuperAdmin', $userRole))
            <!-- Start LHP Nav -->
            <li class="nav-item">
                <a class="nav-link {{ in_array($judul, ['Draft LHP', 'Review Draft LHP', 'LHP']) ? '' : 'collapsed' }}"
                    data-bs-target="#lhp-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>LHP</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="lhp-nav"
                    class="nav-content collapse {{ in_array($judul, ['Draft LHP', 'Review Draft LHP', 'LHP']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @if (str_contains('IRBAN|DALNIS|Anggota|Admin|SuperAdmin', $userRole))
                        <li>
                            <a href="/draft-lhp" class="{{ $judul === 'Draft LHP' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Draft LHP</span>
                            </a>
                        </li>
                    @endif
                    @if (str_contains('IRBAN|DALNIS|SEKRETARIS|INSPEKTUR|Admin|SuperAdmin', $userRole))
                        <li>
                            <a href="/review-draft-lhp" class="{{ $judul === 'Review Draft LHP' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Review Draft LHP</span>
                            </a>
                        </li>
                    @endif
                    @if (str_contains('IRBAN|DALNIS|Anggota|SEKRETARIS|INSPEKTUR|Admin|SuperAdmin', $userRole) ||
                            $userKlmpk === 'Sub. Evaluasi & Pelaporan')
                        <li>
                            <a href="/lhp" class="{{ $judul === 'LHP' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>LHP</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <!-- End LHP Nav -->
        @endif
        @if (str_contains('SEKRETARIS|Admin|SuperAdmin', $userRole) || $userKlmpk === 'Sub. Evaluasi & Pelaporan')
            <!-- Start Tindak Lanjut Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ $judul === 'Tindak Lanjut' ? '' : 'collapsed' }}" href="/tindak-lanjut">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Tindak Lanjut</span>
                </a>
            </li>
            <!-- End Tindak Lanjut Page Nav -->
        @endif
        @if (str_contains('Penanggung Jawab|SEKRETARIS|Admin|SuperAdmin', $userRole) ||
                $userKlmpk === 'Sub. Evaluasi & Pelaporan')
            <!-- Start Penanggung Jawab Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ in_array($judul, ['Penanggung Jawab', 'Pengembalian Dana']) ? '' : 'collapsed' }}"
                    data-bs-target="#penanggung-jawab-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Penanggung Jawab</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="penanggung-jawab-nav"
                    class="nav-content collapse {{ in_array($judul, ['Penanggung Jawab', 'Pengembalian Dana']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @if ($userRole != 'Penanggung Jawab')
                        <li>
                            <a href="/penanggung-jawab" class="{{ $judul === 'Penanggung Jawab' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Penanggung Jawab</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="/pengembalian-dana" class="{{ $judul === 'Pengembalian Dana' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Pengembalian Dana</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- End Penanggung Jawab Page Nav -->
        @endif
        @if ($userRole != 'Penanggung Jawab')
            <!-- Start Laporan Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ $judul === 'Laporan' ? '' : 'collapsed' }}" href="/laporan">
                    <i class="bi bi-card-list"></i>
                    <span>Laporan</span>
                </a>
            </li><!-- End Laporan Page Nav -->
        @endif

        <!-- Start Settings Page Nav -->
        <li class="nav-item">
            <a class="nav-link {{ $judul === 'Settings' ? '' : 'collapsed' }}" href="/settings">
                <i class="bx bx-cog"></i>
                <span>Settings</span>
            </a>
        </li><!-- End Settings Page Nav -->
        @if ($userRole === 'SuperAdmin')
            <!-- Start Account Center Page Nav -->
            <li class="nav-item">
                <a class="nav-link {{ $judul === 'Account Center' ? '' : 'collapsed' }}" href="/account-center">
                    <i class="bi bi-person"></i>
                    <span>Account Center</span>
                </a>
            </li><!-- End Account Center Page Nav -->
        @endif

        <!-- Start Logout Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li><!-- End Logout Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
