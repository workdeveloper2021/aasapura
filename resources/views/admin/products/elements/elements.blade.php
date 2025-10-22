@extends('admin.layout.layout')
@section('title','Dashboard - Products Elements')

@section('content')


@section('header')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
@endsection



<style>
.modern-card {
  border: none;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}
.modern-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
.element-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    margin-top: 1rem;
}
.element-item {
  background: #fff;
  border: 1px solid #f1f1f1;
  border-radius: 12px;
  padding: 12px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: all 0.3s ease;
  text-decoration: none;
  color: #333;
      width: 48%;
}

@media(max-width: 767px) {
    .element-item {
        width: 100%;
    }
}

.element-item:hover {
  background: linear-gradient(90deg, #f9fafb, #eef2ff);
  transform: translateX(5px);
  box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}
.element-item span {
  font-weight: 500;
  font-size: 15px;
  flex-grow: 1;
  margin-left: 10px;
}
.element-item i {
  font-size: 1.2rem;
}
.element-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 1.3rem;
}
.bg-gradient-primary {
  background: linear-gradient(135deg, #007bff, #00c6ff);
}
.bg-gradient-secondary {
  background: linear-gradient(135deg, #6c757d, #adb5bd);
}
.bg-gradient-success {
  background: linear-gradient(135deg, #28a745, #6cc070);
}
.bg-gradient-warning {
  background: linear-gradient(135deg, #ffc107, #ffcd39);
  color: #000;
}
.bg-gradient-danger {
  background: linear-gradient(135deg, #dc3545, #ff6b6b);
}
.bg-gradient-info {
  background: linear-gradient(135deg, #17a2b8, #63cdda);
}
.bg-gradient-dark {
  background: linear-gradient(135deg, #343a40, #495057);
}
.bg-gradient-light {
  background: linear-gradient(135deg, #ced4da, #dee2e6);
  color: #000;
}</style>

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Products Elements</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Products Elements</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
       <div class="row">
  <div class="col-md-12">
    <div class="card modern-card">
      <div class="card-header d-flex justify-content-between align-items-center border-0">
        <h5 class="mb-0 fw-bold text-primary">⚙️ Product Elements</h5>
        <small class="text-muted">Manage product specifications easily</small>
      </div>
      <div class="card-body pt-0">
        <div class="element-list">
          <a href="{{ url('/admin/product-element-list?type=size') }}" class="element-item">
            <div class="element-icon bg-gradient-primary"><i class="bi bi-box-seam"></i></div>
            <span>Product Size</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=frame_material') }}" class="element-item">
            <div class="element-icon bg-gradient-secondary"><i class="bi bi-tools"></i></div>
            <span>Frame Material</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=frame_size') }}" class="element-item">
            <div class="element-icon bg-gradient-success"><i class="bi bi-rulers"></i></div>
            <span>Frame Size</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=color') }}" class="element-item">
            <div class="element-icon bg-gradient-warning"><i class="bi bi-palette"></i></div>
            <span>Color</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=fork') }}" class="element-item">
            <div class="element-icon bg-gradient-danger"><i class="bi bi-diagram-3"></i></div>
            <span>Fork</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=brake') }}" class="element-item">
            <div class="element-icon bg-gradient-info"><i class="bi bi-stoplights"></i></div>
            <span>Brake</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=front_gear') }}" class="element-item">
            <div class="element-icon bg-gradient-dark"><i class="bi bi-gear-wide-connected"></i></div>
            <span>Front Gear</span>
            <i class="bi bi-chevron-right"></i>
          </a>

          <a href="{{ url('/admin/product-element-list?type=rear_gear') }}" class="element-item">
            <div class="element-icon bg-gradient-light"><i class="bi bi-gear-fill"></i></div>
            <span>Rear Gear</span>
            <i class="bi bi-chevron-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


        <!-- [ Main Content ] end -->
    </div>
</section>



@endsection
