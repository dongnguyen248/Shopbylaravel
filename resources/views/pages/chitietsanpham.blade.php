
@extends('layouts.master')

@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{ $sp->name }}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('trang-chu') }}">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="images/product/{{ $sp->image }}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{ $sp->name }}</p>
								<p class="single-item-price">
									@if($sp->promotion_price > 0)
									<span class="flash-del">{{ number_format($sp->unit_price) }} đ</span>
									<span class="flash-sale">{{ number_format($sp->promotion_price) }} đ</span>
									@else
									<span class="">{{ number_format($sp->unit_price) }} đ</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p></p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<!-- <select class="wc-select" name="size">
									<option>Size</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								<select class="wc-select" name="color">
									<option>Color</option>
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Yellow">Yellow</option>
									<option value="Black">Black</option>
									<option value="White">White</option>
								</select> -->
								<select class="wc-select" name="color">
									<option>Số lượng</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{ $sp->description }}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm liên quan</h4>

						<div class="row">
						@foreach($spLienQuan as $splq)
              <div class="col-sm-4">
                <div class="single-item">
                  <div class="single-item-header">
                    <a href="{{ route('chi-tiet-sp', $splq->id) }}"><img src="images/product/{{ $splq->image }}" alt="" height="250px"></a>
                  </div>
                  <div class="single-item-body">
                    <p class="single-item-title">{{ $splq->name }}</p>
                    <p class="single-item-price">
                        @if($splq->promotion_price > 0)
												<span class="flash-del">{{ number_format($splq->unit_price) }} đ</span>
												<span class="flash-sale">{{ number_format($splq->promotion_price) }} đ</span>
												@else
												<span class="">{{ number_format($splq->unit_price) }} đ</span>
												@endif
                    </p>
                  </div>
                  <div class="single-item-caption">
                    <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <a class="beta-btn primary" href="{{ route('chi-tiet-sp', $sp->id) }}">Details <i class="fa fa-chevron-right"></i></a>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              @endforeach
						</div>
						<div class="row">{{ $spLienQuan->links() }}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Best Sellers</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title"><b>Sản phẩm mới</b></h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
							@foreach($newProducts as $new)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('chi-tiet-sp',$new->id) }}"><img src="images/product/{{ $new->image }}" alt=""></a>
									<div class="media-body">
										<b>{{ $new->name }}</b>
										@if($new->promotion_price == 0)
										<span class="beta-sales-price" style="font-size:16px ;display:block; margin-top:2px">{{ number_format($new->unit_price) }}</span>
										@else
										<span class="beta-sales-price" style="font-size:16px ;display:block; margin-top:2px">{{ number_format($new->promotion_price) }}</span>
										@endif
									</div>
								</div>
							@endforeach	
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
  </div> <!-- .container -->
  
  @endsection