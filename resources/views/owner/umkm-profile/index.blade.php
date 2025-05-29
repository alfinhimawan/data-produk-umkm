@extends('owner.layouts.app')

@section('title', 'Profil UMKM Saya')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 mb-4 mt-4 animated fadeIn">
                    <div class="card-body p-5">
                        @if (!$umkm)
                            <div class="text-center py-5">
                                <img src="{{ asset('img/default-umkm.png') }}" alt="Belum Ada UMKM" width="120"
                                    class="mb-4">
                                <h3 class="mb-3 text-secondary font-weight-bold">Anda belum memiliki profil UMKM</h3>
                                <p class="mb-4">Silakan lengkapi data UMKM Anda agar dapat menggunakan seluruh fitur
                                    sistem.</p>
                                <a href="#" class="btn btn-lg btn-primary px-5 py-2 shadow-sm"
                                    data-toggle="modal" data-target="#modalEditUMKM">
                                    <i class="fas fa-plus mr-2"></i>Tambah UMKM Saya
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center mb-4">
                                <div class="mr-4">
                                    <img src="{{ asset($umkm->logo ?? 'img/default-umkm.png') }}" alt="Logo UMKM"
                                        class="rounded-circle border border-primary" width="110" height="110"
                                        style="object-fit:cover;">
                                </div>
                                <div>
                                    <h2 class="font-weight-bold mb-1 text-primary">{{ $umkm->nama_umkm ?? '-' }}</h2>
                                    <span class="badge badge-success px-3 py-2"
                                        style="font-size:1rem;">{{ ($umkm->status ?? null) == 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-secondary font-weight-bold">Alamat</h5>
                                    <p class="mb-0">{{ $umkm->alamat ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-secondary font-weight-bold">Kontak</h5>
                                    <p class="mb-0"><i class="fas fa-phone-alt mr-2"></i>{{ $umkm->kontak ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-secondary font-weight-bold">Nama Pemilik</h5>
                                    <p class="mb-0"><i class="fas fa-user mr-2"></i>{{ $umkm->user->name ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5 class="text-secondary font-weight-bold">Email Pemilik</h5>
                                    <p class="mb-0"><i class="fas fa-envelope mr-2"></i>{{ $umkm->user->email ?? '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-lg btn-primary px-5 py-2 shadow-sm"
                                    data-toggle="modal" data-target="#modalEditUMKM"><i class="fas fa-edit mr-2"></i>Edit
                                    Profil UMKM</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('owner.umkm-profile.modal-edit')
@endsection

@push('styles')
    <style>
        .animated.fadeIn {
            animation: fadeIn 0.7s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
