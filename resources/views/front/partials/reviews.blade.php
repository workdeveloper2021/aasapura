@foreach ($productreviews as $key => $value)
<div class="col-12 col-sm-6">
    <div class="review">
        <div class="row no-gutters">
            <div class="col-auto">
                <h4><a href="javascript:void(0)">
                        <?= $value->name ?>
                    </a></h4>
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 80%"></div>
                        <!-- End .ratings-val -->
                    </div>
                    <!-- End .ratings -->
                </div>
                <!-- End .rating-container -->
                <?php if ($value->created_at->diffInDays(now(), false) == 0) {  ?>
                <span class="review-date">Today</span>
                <?php } else{ ?>
                <span class="review-date">{{ $value->created_at->diffInDays(now(), false)
                    }} Days Ago</span>
                <?php } ?>
            </div>
            <!-- End .col -->
            <div class="col">
                <div class="review-content">
                    <p>
                        <?= $value->feedback ?>
                    </p>
                </div>
                <!-- End .review-content -->
            </div>
            <!-- End .col-auto -->
        </div>
        <!-- End .row -->
    </div>
</div>
@endforeach
