@extends('front.common.layout')
@section('content')
<main class="main">
    <div
      class="page-header text-center"
      style="
        background-image: url('{{ url('website') }}/assets/images/breadcum.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      "
    >
      <div class="container">
        <h1 class="page-title">Blog</h1>
      </div>
      <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
      <div class="container">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Blogs
          </li>
        </ol>
      </div>
      <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="row">
            @foreach ($blogs as $key => $value)


                <div class="col-lg-6 col-12">
                <article
                  class="entry"
                  style="border: 1px dotted #000; padding: 10px"
                >
                  <figure class="entry-media">
                    <a href="/blog/{{ $value->slug }}">
                      <img
                        src="{{ url('uploads') }}/{{ $value->image }}"
                        alt="{{ $value->title }}"
                      />
                    </a>
                  </figure>
                  <!-- End .entry-media -->

                  <div class="entry-body">
                    <div class="entry-meta">
                      <span class="entry-author">
                        by <a href="/blog/{{ $value->slug }}">{{ $value->writer_name }}</a>
                      </span>
                      <span class="meta-separator">|</span>
                      <a href="/blog/{{ $value->slug }}">{{ $value->created_at->format('M d, Y') }}</a>
                    </div>
                    <!-- End .entry-meta -->

                    <h2 class="entry-title">
                      <a href="/blog/{{ $value->slug }}"
                        >{{ $value->title }}</a
                      >
                    </h2>
                    <!-- End .entry-title -->

                    <div class="entry-content">
                      <p>
                        {{$value->short_description}}
                      </p>
                      <a href="/blog/{{ $value->slug }}" class="read-more"
                        >Continue Reading</a
                      >
                    </div>
                    <!-- End .entry-content -->
                  </div>
                  <!-- End .entry-body -->
                </article>
              </div>
              @endforeach
            </div>
            <!-- End .entry -->

            {{-- <nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item disabled">
                  <a
                    class="page-link page-link-prev"
                    href="#"
                    aria-label="Previous"
                    tabindex="-1"
                    aria-disabled="true"
                  >
                    <span aria-hidden="true"
                      ><i class="icon-long-arrow-left"></i></span
                    >Prev
                  </a>
                </li>
                <li class="page-item active" aria-current="page">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a
                    class="page-link page-link-next"
                    href="#"
                    aria-label="Next"
                  >
                    Next
                    <span aria-hidden="true"
                      ><i class="icon-long-arrow-right"></i
                    ></span>
                  </a>
                </li>
              </ul>
            </nav> --}}
          </div>

          <!-- End .col-lg-9 -->

          <aside class="col-lg-3">
            <div class="sidebar">
              {{-- <div class="widget widget-search">
                <h3 class="widget-title">Search</h3>
                <!-- End .widget-title -->

                <form action="#">
                  <label for="ws" class="sr-only">Search in blog</label>
                  <input
                    type="search"
                    class="form-control"
                    name="ws"
                    id="ws"
                    placeholder="Search in blog"
                    required
                  />
                  <button type="submit" class="btn">
                    <i class="icon-search"></i
                    ><span class="sr-only">Search</span>
                  </button>
                </form>
              </div> --}}
              <!-- End .widget -->

              <div class="widget widget-cats">
                <h3 class="widget-title">Categories</h3>
                <!-- End .widget-title -->

                <ul>
                    <?php foreach ($categories_all as $key => $value) {

                        ?>
                                                       <li>
                                                           <a href="/blogs?type=<?= $value->id ?>">{{ $value->name }}<span></span></a>
                                                       </li>
                                                       <?php } ?>
                </ul>
              </div>
              <!-- End .widget -->

              <div class="widget">
                <h3 class="widget-title">Recent Posts</h3>
                <!-- End .widget-title -->

                <ul class="posts-list">
                    @foreach ($recent as $val)

                    <li>
                        <figure>
                            <a href="/blog/{{ $val->slug }}">
                                <img src="{{ url('uploads')}}/{{ $val->image }}" alt="post" />
                            </a>
                        </figure>

                        <div>
                            <span>{{ $val->created_at->format('M d, Y') }}</span>
                            <h4>
                                <a href="/blog/{{ $val->slug }}">{{ $val->title }}</a>
                            </h4>
                        </div>
                    </li>

                    @endforeach
                </ul>
                <!-- End .posts-list -->
              </div>
              <!-- End .widget -->
              <!-- End .widget -->
            </div>
            <!-- End .sidebar -->
          </aside>
          <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
      </div>
      <!-- End .container -->
    </div>
    <!-- End .page-content -->
  </main>
  <!-- End .main -->

@endsection
