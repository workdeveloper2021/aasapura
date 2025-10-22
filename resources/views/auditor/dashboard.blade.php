@section('title','Auditor - Dashboard')
@extends('auditor.common')
@section('content')
<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard</h4>
						<div class="row">
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center icon-warning">
													<img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Total Cycles</p>
													<h4 class="card-title">{{ $total_cycles }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Verfied Cycles</p>
													<h4 class="card-title">{{ $verified_cycles }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Renter Cycles</p>
													<h4 class="card-title">{{ $renter_cycles }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Provider Cycles</p>
													<h4 class="card-title">{{ $provider_cycles }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>



                            <div class="col-md-3">
                                <a href="/auditor/my-profile">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/user.png" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">My Profile</p>
													<h4 class="card-title">{{ $provider_cycles }}</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </a>
							</div>




                            <div class="col-md-3">
                                <a href="/auditor/cycles">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">View All Cycles</p>
													<h4 class="card-title">
                                                        <svg  width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                                                    </h4>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </a>
							</div>

							<!-- Add this after the other cards in the dashboard -->
<div class="col-md-3">
    <a href="/auditor/repair-cycles">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <img src="{{ url('') }}/images/cycle.jpg" style="width: 50px;margin: auto;" alt="">
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Cycles Need Repair</p>
                            <h4 class="card-title">{{ $repair_cycles }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>




                            <div class="col-md-3">
                                <a href="/auditor/logout" onclick="return confirm('Are you sure ! Logout')">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<img src="{{ url('') }}/images/5844.jpg" style="width: 50px;margin: auto;" alt="">
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Logout</p>
													<h4 class="card-title">
                                                        <svg  width="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                                                    </h4>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </a>
							</div>




						</div>
					</div>
				</div>

			</div>

            @endsection
