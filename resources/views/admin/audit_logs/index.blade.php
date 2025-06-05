@extends('admin.layouts.app')

@section('title', 'Audit Log')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Audit Log</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Perubahan User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="auditLogTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                            <th>Target</th>
                            <th>Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $i => $log)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ optional($log->user)->name ?? '-' }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->target_table }} #{{ $log->target_id }}</td>
                                <td>
                                    @php
                                        $before = json_decode($log->before, true) ?: [];
                                        $after = json_decode($log->after, true) ?: [];
                                        $ignoreFields = ['updated_at', 'created_at', 'verification_token', 'id_users'];
                                        $diff = [];
                                        foreach ($after as $key => $val) {
                                            if (in_array($key, $ignoreFields)) continue;
                                            if (!array_key_exists($key, $before) || $before[$key] != $val) {
                                                $diff[$key] = [
                                                    'before' => $before[$key] ?? '-',
                                                    'after' => $val
                                                ];
                                            }
                                        }
                                    @endphp
                                    @if (count($diff))
                                        <div style="display:flex; flex-direction:column; gap:4px;">
                                            @foreach ($diff as $key => $change)
                                                @if($key === 'foto')
                                                    <div style="background:#f8f9fa; border-radius:6px; padding:6px 10px; font-size:0.97em; display:flex; align-items:center; gap:8px;">
                                                        <span class="badge badge-info text-capitalize" style="min-width:60px;">foto</span>
                                                        <span class="text-danger" style="font-weight:500;">Foto lama</span>
                                                        <i class="fas fa-arrow-right text-secondary mx-1" style="font-size:0.95em;"></i>
                                                        <span class="text-success" style="font-weight:500;">Foto baru</span>
                                                    </div>
                                                @else
                                                    <div style="background:#f8f9fa; border-radius:6px; padding:6px 10px; font-size:0.97em; display:flex; align-items:center; gap:6px;">
                                                        <span class="badge badge-info text-capitalize" style="min-width:60px;">{{ $key }}</span>
                                                        <span class="text-danger" style="font-weight:500;">{{ $change['before'] }}</span>
                                                        <i class="fas fa-arrow-right text-secondary mx-1" style="font-size:0.95em;"></i>
                                                        <span class="text-success" style="font-weight:500;">{{ $change['after'] }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#auditLogTable').DataTable();
        });
    </script>
@endpush
