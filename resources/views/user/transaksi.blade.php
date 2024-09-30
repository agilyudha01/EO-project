@extends('user.layout.main')

@section('main')
<div class="container mt-4">
    <h2 class="mb-4">Riwayat Transaksi</h2>

    @if ($orders->isEmpty())
        <div class="alert alert-info" role="alert">
            Belum ada order.
        </div>
    @else
        <div class="table-responsive">
            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                <thead class="table-light text-truncate">
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Acara</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <img src="{{ asset('storage/' . $order->eventPackage->image) }}" alt="{{ $order->eventPackage->name }}" class="img-fluid rounded me-2" style="width: 100px; height: 100px; object-fit: cover;" />
                                    </div>
                                    <div class="col-lg-6 col-cm-12">
                                        <span>{{ $order->eventPackage->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->event_date->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ 'Rp ' . number_format($order->price, 0, ',', '.') }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $order->id }}">
                                    Lihat Detail
                                </button>
                                <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">Detail Pemesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <img src="{{ asset('storage/' . $order->eventPackage->image) }}" alt="" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;" />
                                                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                                                <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at }}</p>
                                                <p><strong>Tanggal Acara:</strong> {{ $order->event_date }}</p>
                                                <p><strong>Lokasi Acara:</strong> {{ $order->address }}</p>
                                                <p><strong>Username:</strong> {{ $order->user->name }}</p>
                                                <p><strong>Harga:</strong> {{ 'Rp ' . number_format($order->eventPackage->price, 0, ',', '.') }}</p>
                                                <p><strong>Diskon Membership:</strong> {{ $order->user->badges->discount ?? 0 }}%</p>
                                                <p><strong>Harga Akhir:</strong> {{ 'Rp ' . number_format($order->price, 0, ',', '.') }}</p>
                                                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                                                <p><strong>Additional Info:</strong> {{ $order->additional_info ?? 'N/A' }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
