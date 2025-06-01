<div class="col-xl-4 col-lg-5 d-flex align-items-stretch">
    <div class="card shadow mb-4 w-100" style="height:auto; min-height:370px; max-height:100%;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Top 3 Kategori dengan Produk Terbanyak</h6>
        </div>
        <div class="card-body d-flex flex-column justify-content-center" style="height:auto;">
            @if($topCategories->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($topCategories as $i => $cat)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-primary mr-3" style="font-size:1.1rem; min-width:2.2rem;">#{{ $i+1 }}</span>
                                <i class="fas fa-tags fa-fw text-info mr-2"></i>
                                <span class="font-weight-bold">{{ $cat->nama_kategori }}</span>
                            </div>
                            <span class="badge badge-pill badge-success" style="font-size:1.1rem;">{{ $cat->products_count }} produk</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center text-muted">Belum ada produk pada kategori manapun.</div>
            @endif
        </div>
    </div>
</div>
