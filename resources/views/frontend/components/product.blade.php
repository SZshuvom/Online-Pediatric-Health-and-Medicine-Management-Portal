
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>BUY ANYTHING FOR YOUR BABY</h2>
                </div>
                <div class="featured__controls">

                </div>
            </div>
        </div>
        <div class="row featured__filter">

            @foreach ($products as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">

                <div class="featured__item">
                    <div class="featured__item__pic">
                        <a href="{{url('/product-details',$item->id)}}"> <img src="{{ asset('/public/uploads/' . $item->image) }}" alt="Product Image"></a>
                        <ul class="featured__item__pic__hover">
                       @auth
                        <li>
                            @php
                            $inWishlist = Auth::check() && Auth::user()->wishlistProducts->contains('id', $item->id);
                            @endphp

                            <form method="POST" action="{{ route('add.to.wishlist', ['id' => $item->id]) }}">
                                @csrf
                                <button type="submit" class="wishlist-button{{ $inWishlist ? ' in-wishlist' : '' }}">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </form>
                            </li>
                          @endauth
                            <li><a href="{{url('/product-details',$item->id)}}"><i class="fa fa-eye"></i></a></li>
                            <li><a href="{{route('add.to.cart',$item->id)}}"><i class="fa fa-shopping-cart"></i></a></li>

                        </ul>
                             </div>

                        {{-- <div>
                            <a href="{{route('add.to.cart',$item->id)}}" class="primary-btn">ADD TO CART</a>
                        </div> --}}

                        <div class="featured__item__text">

                            @if($item->discount)
                            <div class="discount-badge">
                                <span>-{{ $item->discount }}% OFF</span>
                            </div>
                            @endif

                            <h6><a href="#">{{ $item->name }}</a></h6>
                            <div class="star-rating">
                                @php
                                    // Retrieve the product ratings for the current product
                                    $productRatings = App\Models\ProductRating::where('product_id', $item->id)->get();

                                    // Calculate the average rating and limit it to a maximum of 5
                                    $averageRating = min($productRatings->avg('rating'), 5);

                                    // Calculate the number of full stars
                                    $fullStars = floor($averageRating);

                                    // Calculate the presence of a half star
                                    $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <span class="star" style="font-size: 24px; color: gold;">&#9733;</span>
                                    @elseif ($hasHalfStar)
                                        <span class="star half" style="font-size: 24px; color: gold;">&#9733;</span>
                                        @php $hasHalfStar = false; @endphp
                                    @else
                                        <span class="star" style="font-size: 24px; color: gray;">&#9733;</span>
                                    @endif
                                @endfor
                            </div>



                            @if ($item->discount)
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <h5 style="color: rgb(214, 57, 17); margin-right: 10px;"><del>{{ $item->price }} Tk.</del></h5>
                                <h5 style="color: rgb(214, 57, 17;">{{ $item->discounted_price }} Tk.</h5>
                            </div>
                            @else
                            <h5 style="color: rgb(214, 57, 17)">{{ $item->price }} Tk.</h5>
                            @endif
                        </div>



                        <br>

                </div>
            </div>
            @endforeach
        </div >
        <div class="pagination justify-content-end">
            {{ $products->links() }}
        </div>

    </div>
</section>
<!-- Featured Section End -->
