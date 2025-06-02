@extends('owner.layouts.app')

@section('title', 'Profil UMKM Saya')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7 d-flex align-items-center justify-content-center" style="min-height:80vh;">
                <div class="glass-card-umkm my-auto" style="width:100%;">
                    <div class="card-body p-0">
                        @if (!$umkm)
                            <div class="text-center py-5">
                                <h3 class="mb-3 text-secondary font-weight-bold">Anda belum memiliki profil UMKM</h3>
                                <p class="mb-4">Silakan lengkapi data UMKM Anda agar dapat menggunakan seluruh fitur
                                    sistem.
                                </p>
                                <a href="#" class="btn btn-primary btn-lg px-4" data-toggle="modal"
                                    data-target="#modalEditUMKM">
                                    <i class="fas fa-plus mr-2"></i>Tambah UMKM Saya
                                </a>
                            </div>
                        @else
                            <div class="text-center mb-4">
                                <span class="glass-avatar-umkm mb-2">
                                    <img src="{{ $umkm && $umkm->logo && file_exists(public_path($umkm->logo)) ? asset($umkm->logo) . '?t=' . now()->timestamp : asset('img/default-umkm.png') }}"
                                        alt="Logo UMKM"
                                        class="rounded-circle border border-primary"
                                        style="width:110px; height:110px; object-fit:cover; background:#f8f9fa;">
                                </span>
                                <h2 class="font-weight-bold mb-1 mt-2">{{ $umkm->nama_umkm ?? 'UMKM Anda' }}</h2>
                                <span
                                    class="badge glass-badge-status badge-{{ ($umkm->status ?? null) == 'aktif' ? 'success' : 'danger' }} px-3 py-2 mb-2"
                                    style="font-size:1rem; letter-spacing:1px;"><i
                                        class="fas fa-circle mr-1"></i>{{ ($umkm->status ?? null) == 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-primary mr-3" style="font-size:1.5rem;"><i
                                                class="fas fa-map-marker-alt"></i></span>
                                        <div>
                                            <div class="glass-info-label">Alamat</div>
                                            <div class="glass-info-value">{{ $umkm->alamat ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-success mr-3" style="font-size:1.5rem;"><i
                                                class="fas fa-phone-alt"></i>
                                        </span>
                                        <div>
                                            <div class="glass-info-label">Kontak</div>
                                            <div class="glass-info-value">{{ $umkm->kontak ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-info mr-3" style="font-size:1.5rem;"><i class="fas fa-user"></i>
                                        </span>
                                        <div>
                                            <div class="glass-info-label">Nama Pemilik</div>
                                            <div class="glass-info-value">{{ $umkm->user->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning mr-3" style="font-size:1.5rem;"><i
                                                class="fas fa-envelope"></i>
                                        </span>
                                        <div>
                                            <div class="glass-info-label">Email Pemilik</div>
                                            <div class="glass-info-value">{{ $umkm->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-info px-4" data-toggle="modal"
                                    data-target="#modalEditUMKM">
                                    <i class="fas fa-edit mr-2"></i>Edit Profil UMKM
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('owner.umkm-profile.modal-edit')

    @if (session('success'))
        <div id="auth-alert" data-type="success" data-message="{{ session('success') }}" style="display:none;"></div>
    @endif

    @if (session('warning'))
        <div id="auth-alert" data-type="warning" data-message="{{ session('warning') }}" style="display:none;"></div>
    @endif

    @if (session('error'))
        <div id="auth-alert" data-type="error" data-message="{{ session('error') }}" style="display:none;"></div>
    @endif
@endsection

@push('styles')
    <style>
        .glass-card-umkm {
            border-radius: 1.5rem;
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            padding: 2.5rem 2rem;
            transition: box-shadow 0.2s;
        }

        .glass-card-umkm:hover {
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.22);
        }

        .glass-avatar-umkm {
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.10);
            border-radius: 50%;
            padding: 0.5rem;
            display: inline-block;
        }

        .glass-badge-status {
            box-shadow: 0 2px 8px 0 rgba(40, 167, 69, 0.10);
            font-weight: 600;
            letter-spacing: 1px;
        }

        .glass-info-label {
            color: #6c757d;
            font-weight: 500;
        }

        .glass-info-value {
            font-weight: 600;
            color: #343a40;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/owner/owner-umkm-profile.js') }}"></script>
@endpush
