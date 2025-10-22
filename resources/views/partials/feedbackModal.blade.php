
<div class="modal fade" id="feedbackmodel{{ $key }}" tabindex="-1" aria-labelledby="feedbackmodel{{ $key }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                   <div class="col-12">
                            <form action="/submit-rating" method="post" class="mt-2 pb-3 px-3">
                                @csrf
                                <h5 class="mb-0">Give Review</h5>
                                <input type="text" name="product_id" value="{{ $product->id ?? "" }}" id=""  hidden>
                                <div class="star-rating">
                                    <input type="radio" name="rating" id="5-stars" value="5">
                                    <label for="5-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="4-stars" value="4">
                                    <label for="4-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="3-stars" value="3">
                                    <label for="3-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="2-stars" value="2">
                                    <label for="2-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="1-star" value="1">
                                    <label for="1-star">&#9733;</label>
                                </div>

                                <div class="review_descritpiton">
                                    <label for="">Feedback</label>
                                    <textarea name="feedback" id="" cols="30" rows="3"
                                        style="height:auto;min-height:auto;" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Submit Rating</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>