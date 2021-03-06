
@extends('frontEnd.layouts.master')
@section('title','Detial Page')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('frontEnd.layouts.category_menu')
            </div>
            <div class="col-sm-9 padding-right">
                @if(Session::has('message'))
                    <div class="alert alert-success text-center" role="alert">
                        {{Session::get('message')}}
                    </div>
                @endif
        <div class="product-details"><!---details des produits-->

            <div class="col-sm-5">
                <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                    <a href="{{url('products/large',$detail_product->image)}}">
                        <img src="{{url('products/small',$detail_product->image)}}" alt="" id="dynamicImage"/>
                    </a>
                </div>

                <ul class="thumbnails" style="margin-left: -10px;">
                    <li>
                        @foreach($imagesGalleries as $imagesGallery)
                            <a href="{{url('products/large',$imagesGallery->image)}}" data-standard="{{url('products/small',$imagesGallery->image)}}">
                                <img src="{{url('products/small',$imagesGallery->image)}}" alt="" width="75" style="padding: 8px;">
                            </a>
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-sm-7">
                <form action="{{route('addToCart')}}" method="post" role="form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="products_id" value="{{$detail_product->id}}">
                    <input type="hidden" name="product_name" value="{{$detail_product->p_name}}">
                    <input type="hidden" name="product_code" value="{{$detail_product->p_code}}">
                    <input type="hidden" name="product_color" value="{{$detail_product->p_color}}">
                   <input type="hidden" name="price" value="{{$detail_product->price}}" id="dynamicPriceInput">
                    <div class="product-information"><!--informations des articles-->
                        <img src="{{asset('frontEnd/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                        <h2>{{$detail_product->p_name}}</h2>
                        <p>Code ID: {{$detail_product->p_code}}</p>
                       <span>
                            <select name="size" id="idSize" class="form-control">
                        	<option value="">Choisir la taille</option>
                          @foreach($detail_product->attributes as $attrs)
                              <option value="{{$detail_product->id}}-{{$attrs->size}}">{{$attrs->size}}</option>
                          @endforeach
                        </select>
                        </span><br>
                        <span>
                            <label>Quantit??:</label>
                            <input type="text" name="quantity" value="{{$totalStock}}" id="inputStock"/>
                            @if($totalStock>1)
                            <button type="submit" class="btn btn-fefault cart" id="buttonAddToCart">
                                <i class="fa fa-shopping-cart"></i>
                                Commander
                            </button>
                            @endif
                        </span>
                        <p><b>Disponible:</b>
                            @if($totalStock>0)
                                <span id="availableStock">En stock</span>
                            @else
                                <span id="availableStock">Hors stock</span>
                            @endif
                        </p>
                        <p><b>Condition:</b> Nouveau</p>
                        <a href=""><img src="{{asset('frontEnd/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                    </div><!--information des articles-->
                </form>

            </div>
        </div>

        <div class="recommended_items"><!--Articles recommand??s-->
            <h2 class="title text-center">Articles recommand??s</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $countChunk=0;?>
                    @foreach($relateProducts->chunk(3) as $chunk)
                        <?php $countChunk++; ?>
                        <div class="item<?php if($countChunk==1){ echo' active';} ?>">
                            @foreach($chunk as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{url('/products/small',$item->image)}}" alt="" style="width: 150px;"/>

                                                <p>{{$item->p_name}}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Commander</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>

    </div>
        </div>
    </div>
@endsection
