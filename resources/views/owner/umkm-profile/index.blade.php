@extends('owner.layouts.app')

@section('title', 'Profil UMKM Saya')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm mt-5 mb-4">
                    <div class="card-body">
                        @if (!$umkm)
                            <div class="text-center py-5">
                                <h3 class="mb-3 text-secondary font-weight-bold">Anda belum memiliki profil UMKM</h3>
                                <p class="mb-4">Silakan lengkapi data UMKM Anda agar dapat menggunakan seluruh fitur sistem.
                                </p>
                                <a href="#" class="btn btn-primary btn-lg px-4" data-toggle="modal" data-target="#modalEditUMKM">
                                    <i class="fas fa-plus mr-2"></i>Tambah UMKM Saya
                                </a>
                            </div>
                        @else
                            <div class="text-center mb-4">
                                <img src="{{ asset($umkm->logo ?? 'img/default-umkm.png') }}" alt="Logo UMKM"
                                    class="rounded-circle border border-primary mb-2"
                                    style="width:110px; height:110px; object-fit:cover; background:#f8f9fa;">
                                <h2 class="font-weight-bold mb-1 mt-2">{{ $umkm->nama_umkm ?? 'UMKM Anda' }}</h2>
                                <span
                                    class="badge badge-{{ ($umkm->status ?? null) == 'aktif' ? 'success' : 'danger' }} px-3 py-2 mb-2"
                                    style="font-size:1rem; letter-spacing:1px;"><i
                                        class="fas fa-circle mr-1"></i>{{ ($umkm->status ?? null) == 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-primary mr-3" style="font-size:1.5rem;"><i
                                                class="fas fa-map-marker-alt"></i></span>
                                        <div>
                                            <div class="font-weight-bold text-secondary">Alamat</div>
                                            <div>{{ $umkm->alamat ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-success mr-3" style="font-size:1.5rem;"><i class="fas fa-phone-alt"></i>
                                        </span>
                                        <div>
                                            <div class="font-weight-bold text-secondary">Kontak</div>
                                            <div>{{ $umkm->kontak ?? '-' }}</div>
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
                                            <div class="font-weight-bold text-secondary">Nama Pemilik</div>
                                            <div>{{ $umkm->user->name ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="text-warning mr-3" style="font-size:1.5rem;"><i class="fas fa-envelope"></i>
                                        </span>
                                        <div>
                                            <div class="font-weight-bold text-secondary">Email Pemilik</div>
                                            <div>{{ $umkm->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="#" class="btn btn-info px-4" data-toggle="modal" data-target="#modalEditUMKM">
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
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 1rem;
        }

        .card-body {
            padding: 2.5rem 2rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('js/owner/owner-umkm-profile.js') }}"></script>
@endpush
