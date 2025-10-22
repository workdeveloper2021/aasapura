@extends('admin.layout.layout')
@section('title', 'Product Elements List')

@section('header')
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection

<style>

.page-header-custom h4 {
    margin: 0;
    font-weight: 600;
}
.btn-add-new {
    background: #fff;
    color: #007bff;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s;
}
.btn-add-new:hover {
    background: #007bff;
    color: #fff;
}
.table-custom {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
}
.table thead {
    background-color: #f8f9fa;
}
.table thead th {
    font-weight: 600;
    color: #555;
}
.table tbody tr:hover {
    background-color: #f9fbff;
}
.action-btns i {
    font-size: 1.2rem;
    cursor: pointer;
    margin: 0 6px;
    transition: all 0.3s;
}
.action-btns i:hover {
    transform: scale(1.15);
}
.action-btns .edit { color: #17a2b8; }
.action-btns .delete { color: #dc3545; }
.action-btns .view { color: #28a745; }
</style>

@section('content')
<section class="pcoded-main-container">
  <div class="pcoded-content">
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Product Element List</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/product-elements') }}">Products Elements</a></li>
              <li class="breadcrumb-item active">List</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    @php
      $type = request()->get('type');
      $title = ucfirst(str_replace('_', ' ', $type));
    @endphp

    

    <div class="card mt-4 table-custom">
  <div class="card-body table-border-style">

       <div class="d-flex justify-content-start align-items-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-3">
                                        <i class="feather icon-arrow-left"></i> Back
                                    </a>
        </div>
    
    <div class="page-header-custom mt-3 mb-3 d-flex justify-content-between align-items-center">
      <h5 class="d-flex align-items-center"><i class="bi bi-list-ul mr-2"></i> {{ $title }} List</h5>
      <a href="{{ url('/admin/product-elements/create?type=' . $type) }}" class="btn btn-add-new btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Add New
      </a>
    </div>

                        <div class="table-responsive">
                      <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ $title }} Name</th>
                <th>Created Date</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($elements as $index => $element)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $element->element_name }} @if($element->element_type == "color") <span class="badge bg-info text-white">{{ $element->options }}</span> @endif </td>
                <td>{{ $element->created_at->format('d M Y') }}</td>
                 <td>
                                            <a href="{{ route('deleterow', ['table' => 'product_elements', 'id' => $element->id, 'image' => "no_image"]) }}"
                                                onclick="return confirm('Are you sure !')"
                                                class="btn btn-danger btn-sm px-3 py-2">
                                                <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
                                                    </path>
                                                </svg></a>

                                            <a href="{{ route('productselement.edit', ['id' => $element->id, 'type' => $element->element_type]) }}"
                                              class="btn btn-success btn-sm px-3 py-2">
                                              <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                  d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z">
                                                </path>
                                              </svg>
                                            </a>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $elements->appends(['type' => request('type')])->links('bootstrap-5-custom') }}

      </div>
    </div>
  </div>
</section>
@endsection
