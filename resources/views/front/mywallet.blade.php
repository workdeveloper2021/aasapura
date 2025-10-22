@extends('front.common.layout')
@section('title', 'Aashapura - Wallet')
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">My Wallet</h1>
        </div>
    </div>

    <div class="page-content py-5">
        <div class="container">

            <!-- Wallet Balance Card -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="card shadow-sm text-center ">
                        <div class="card-body mt-2">
                            <h5 class="card-title text-success pb-2">Wallet Balance</h5>
                            <h2 class="text-primary">₹{{ number_format(Auth::user()->wallet, 2) }}</h2>
                            <p class="text-muted mb-0">Available balance in your wallet</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction History -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h4 class="mb-3">Transaction History</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Mode</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $txn)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($txn->created_at)->format('d M Y') }}</td>
                                        <td>₹{{ number_format($txn->amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $txn->mode == 'credit' ? 'success' : 'danger' }}">
                                                {{ ucfirst($txn->mode) }}
                                            </span>
                                        </td>
                                        <td>{{ ucwords(str_replace('_', ' ', $txn->type)) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $txn->status == 'completed' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($txn->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $txn->reason }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No transactions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-4">
    {{ $transactions->links('bootstrap-5-custom') }}
</div>

                    </div>
                </div>
            </div>

            <!-- Share Section -->
       

        </div>
    </div>
</main>

@endsection
