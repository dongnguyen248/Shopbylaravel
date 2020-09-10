@extends('layouts.master')

@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
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
  <div id="content" class="space-top-none">
    <div class="main-content">
      <div class="space60">&nbsp;</div>
      <div class="row">
        <div class="col-sm-3">
          <ul class="aside-menu">
          @foreach($listLoai as $loai)
            <li><a href="{{ route('loai-san-pham',$loai->id) }}">{{ $loai->name }}</a></li>
          @endforeach
          </ul>
        </div>
        <div class="col-sm-9">
          <div class="beta-products-list">
            <h4>{{ $tenLoai }}</h4>
            <div class="beta-products-details">
              <p class="pull-left">Tìm thấy {{$spTheoLoai->total()}} Sản phẩm</p>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              @foreach($spTheoLoai as $sp)
              <div class="col-sm-4">
                <div class="single-item">
                  <div class="single-item-header">
                    <a href="{{ route('chi-tiet-sp', $sp->id) }}"><img src="images/product/{{ $sp->image }}" alt="" height="250px"></a>
                  </div>
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
                  <div class="single-item-caption">
                    <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                    <a class="beta-btn primary" href="{{ route('chi-tiet-sp', $sp->id) }}">Details <i class="fa fa-chevron-right"></i></a>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          <div class="row">{{ $spTheoLoai->links() }}</div>
          </div> <!-- .beta-products-list -->

          <div class="space50">&nbsp;</div>
        </div>
      </div> <!-- end section with sidebar and main content -->


    </div> <!-- .main-content -->
  </div> <!-- #content -->
</div> <!-- .container -->

@endsection