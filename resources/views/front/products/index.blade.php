@extends('front.layouts.main')

@section('body')

<div class="breadcrumb parallax-container">
  <div class="parallax"><img src="front_assets/image/prlx.jpg" alt="#"></div>
  <h1 class="category-title">Products</h1>
  <ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="category.html">Products</a></li>
  </ul>
</div>
<div class="container">
  <div class="row">
    <div id="column-left" class="col-sm-3 hidden-xs column-left">
      <div class="Categories left-sidebar-widget">
        <div class="columnblock-title">Categories</div>
        <div class="category_block">
          <ul class="box-category treeview">
            @foreach ($productTypes as $type)
              <li><a href="{{route('front.products.index').'?searchFields=type.id&search='.$type->id}}">{{$type->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="special left-sidebar-widget">
        <div class="columnblock-title">Special Product</div>
        <ul class="row ">
          <li class="product-layout">
            <div class="product-list col-xs-4">
              <div class="product-thumb">
                <div class="image product-imageblock">
                  <a href="product.html">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-06.jpg">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-06-1.jpg">
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xs-8">
              <div class="caption product-detail">
                <h4 class="product-name"><a title="Casual Shirt With Ruffle Hem" href="#">Casual Shirt With Ruffle
                    Hem</a></h4>
                <p class="price product-price"> <span class="price-new">$254.00</span> <span
                    class="price-old">$272.00</span> </p>
                <div class="addto-cart"><a href="#">Add to Cart</a></div>
              </div>
            </div>
          </li>
          <li class="product-layout">
            <div class="product-list col-xs-4">
              <div class="product-thumb">
                <div class="image product-imageblock"> <a href="product.html">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-02.jpg">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-02-1.jpg">
                  </a> </div>
              </div>
            </div>
            <div class="col-xs-8">
              <div class="caption product-detail">
                <h4 class="product-name"><a title="Casual Shirt With Ruffle Hem" href="#">Casual Shirt With Ruffle
                    Hem</a></h4>
                <p class="price product-price"> <span class="price-new">$254.00</span> <span
                    class="price-old">$272.00</span> </p>
                <div class="addto-cart"><a href="#">Add to Cart</a></div>
              </div>
            </div>
          </li>
          <li class="product-layout">
            <div class="product-list col-xs-4">
              <div class="product-thumb">
                <div class="image product-imageblock"> <a href="product.html">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-03.jpg">
                    <img class="img-responsive" title="iPod Classic" alt="iPod Classic"
                      src="front_assets/image/product/Pro-03-1.jpg">
                  </a> </div>
              </div>
            </div>
            <div class="col-xs-8">
              <div class="caption product-detail">
                <h4 class="product-name"><a title="Casual Shirt With Ruffle Hem" href="#">Casual Shirt With Ruffle
                    Hem</a></h4>
                <p class="price product-price"> <span class="price-new">$254.00</span> <span
                    class="price-old">$272.00</span> </p>
                <div class="addto-cart"><a href="#">Add to Cart</a></div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class=" content col-sm-9">
      <div class="category-page-wrapper">
        <div class="col-md-2 text-right sort-wrapper">
          <label class="control-label" for="input-sort">Sort By :</label>
          <div class="sort-inner">
            <select id="input-sort" class="form-control">
              <option value="ASC" selected="selected">Default</option>
              <option value="ASC">Name (A - Z)</option>
              <option value="DESC">Name (Z - A)</option>
              <option value="ASC">Price (Low &gt; High)</option>
              <option value="DESC">Price (High &gt; Low)</option>
              <option value="DESC">Rating (Highest)</option>
              <option value="ASC">Rating (Lowest)</option>
              <option value="ASC">Model (A - Z)</option>
              <option value="DESC">Model (Z - A)</option>
            </select>
          </div>
        </div>
        <div class="col-md-1 text-right page-wrapper">
          <label class="control-label" for="input-limit">Show :</label>
          <div class="limit">
            <select id="input-limit" class="form-control">
              <option value="8" selected="selected">08</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="75">75</option>
              <option value="100">100</option>
            </select>
          </div>
        </div>
        <div class="col-md-6 list-grid-wrapper"> <a href="#" id="compare-total">Product Compare (0)</a>
          <div class="btn-group btn-list-grid">
            <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip"
              title="List"></button>
            <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip"
              title="Grid"></button>
          </div>
        </div>
      </div>
      <br />
      <div class="grid-list-wrapper">
        @foreach ($products as $product)
            @include('front.products.item', $product)
        @endforeach
        </div>
      </div>
      <div class="category-page-wrapper">
        <div class="result-inner">Showing 1 to 8 of 10 (2 Pages)</div>
        <div class="pagination-inner">
          <ul class="pagination">
            <li class="active"><span>1</span></li>
            <li><a href="category.html">2</a></li>
            <li><a href="category.html">&gt;</a></li>
            <li><a href="category.html">&gt;|</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection