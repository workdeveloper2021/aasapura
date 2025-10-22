@section('title','Auditor - Repair Cycles')
@extends('auditor.common')
@section('content')

<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
        object-fit: contain;
    }

    .success_button {
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
    }

    span.danger {
        background-color: #e91414;
        color: #fff;
        padding: 4px 10px;
        border-radius: 3px;
    }
</style>

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Cycles Needing Repair</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Repair Requests</div>
                        </div>
                        <div class="card-body">
                            <div class="card-sub">
                                You can see cycles that need repair here
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Brands</th>
                                            <th>Category</th>
                                            <th>Service Days Count</th>
                                            <th>Added By</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($results as $key => $value) {
                                            if($value->usertype =="provider"){
                                                $added_by = "Renter";
                                            }else{
                                                $added_by = "Provider";
                                            }
                                        ?>
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>Rs.{{ $value->price }}</td>
                                            <td>{{ $value->brand_name }}</td>
                                            <td>{{ $value->category_name }}</td>
<td>
    <span class="danger"><?= $value->service_days_count ?> days</span>
</td>

                                            <td>
                                                <span class="badge <?php if($value->usertype =="provider"){ ?>bg-primary <?php }else{ ?> bg-warning <?php } ?>text-white">{{ $added_by }}</span>
                                            </td>
                                            <td>
                                                <img src="{{ url('') }}/products/{{ $value->image1 }}" alt="" loading="lazy" class="categoryimage">
                                            </td>
                                            <td>
                                                <a href="/auditor/cycle-view/{{ $value->id }}" class="btn btn-success btn-sm success_button">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.012C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="/auditor/mark-repaired/{{ $value->id }}" onclick="return confirm('Are you sure you want to mark this cycle as repaired?')" class="btn btn-primary btn-sm success_button ml-2">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M11.602 13.7599L13.014 15.1719L21.4795 6.7063L20.0675 5.2943L11.602 13.7599ZM11.602 17.8979L17.8895 11.6104L16.4775 10.1984L11.602 15.0739L8.14349 11.6154L6.73148 13.0274L11.602 17.8979ZM2.9835 21.0164H20.2195V19.0164H2.9835V21.0164Z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            @if ($results instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $results->links('bootstrap-5-custom') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

