<!--=====================================
Preload
======================================-->

<div class="d-flex justify-content-center preloadTrue">

    <div class="spinner-border text-muted my-5"></div>

</div>

<!--=====================================
Load
======================================-->

<div class="ps-block--shop-features preloadFalse">

    <div class="ps-block__header">

        <h3>Recommended Items</h3>

        <div class="ps-block__navigation">

            <a class="ps-carousel__prev" href="#recommended">
                <i class="icon-chevron-left"></i>
            </a>

            <a class="ps-carousel__next" href="#recommended">
                <i class="icon-chevron-right"></i>
            </a>

        </div>

    </div>

    <div class="ps-block__content">

        <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000"
            data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="5" data-owl-item-xs="2"
            data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000"
            data-owl-mousedrag="on">

            <?php foreach ($recommendedItems as $key => $item) : ?>

            <!--=====================================
            Product
            ======================================-->

            <div class="ps-product">

                <div class="ps-product__thumbnail">

                    <!--=====================================
                    Imagen del producto
                    ======================================-->

                    <a href="<?php echo $path . $item->url_product ?>">

                        <img src="img/products/<?php echo $item->url_category ?>/<?php echo $item->image_product ?>"
                            alt="<?php echo $item->name_product ?>">

                    </a>

                    <!--=====================================
                    Descuento de oferta o fuera de stock
                    ======================================-->

                    <?php if ($item->stock_product == 0) : ?>

                    <div class="ps-product__badge out-stock">Out Of Stock</div>

                    <?php else : ?>

                    <?php if ($item->offer_product != null) : ?>

                    <div class="ps-product__badge">
                        -

                        <?php

                                    echo TemplateController::offerDiscount(

                                        $item->price_product,
                                        json_decode($item->offer_product, true)[1],
                                        json_decode($item->offer_product, true)[0]

                                    );

                                    ?>


                        %

                    </div>

                    <?php endif ?>

                    <?php endif ?>

                    <!--=====================================
                    Botones de acciones
                    ======================================-->

                    <ul class="ps-product__actions">

                        <li>
                            <a class="btn"
                                onclick="addShoppingCart('<?php echo $item->url_product ?>','<?php echo CurlController::api() ?>', '<?php echo $_SERVER["REQUEST_URI"] ?>', this)"
                                detailsSC quantitySC data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                <i class="icon-bag2"></i>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="<?php echo $path . $item->url_product ?>" data-toggle="tooltip"
                                data-placement="top" title="Quick View">
                                <i class="icon-eye"></i>
                            </a>
                        </li> -->
                        <!--Vista rapida verificada -->
                        <li>
                            <a class="btn" onclick='quickview(<?php echo json_encode($item); ?>)' data-toggle="modal"
                                data-placement="top" title="PRUEBA" data-target="#product-quickview">
                                <i class="icon-eye"></i>
                            </a>
                        </li>

                        <li>
                            <a class="btn"
                                onclick="addWishlist('<?php echo $item->url_product ?>','<?php echo CurlController::api() ?>')"
                                data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                <i class="icon-heart"></i>
                            </a>
                        </li>

                    </ul>

                </div>

                <div class="ps-product__container">

                    <!--=====================================
                    nombre de la tienda
                    ======================================-->

                    <a class="ps-product__vendor"
                        href="<?php echo $path . $item->url_store ?>"><?php echo $item->name_store ?></a>

                    <div class="ps-product__content">

                        <!--=====================================
                        nombre del producto
                        ======================================-->

                        <a class="ps-product__title" href="<?php echo $path . $item->url_product ?>">
                            <?php echo $item->name_product ?>
                        </a>

                        <!--=====================================
                        Las reseñas del producto
                        ======================================-->

                        <div class="ps-product__rating">

                            <?php

                                $reviews = TemplateController::averageReviews(
                                    json_decode($item->reviews_product, true)
                                );

                                ?>

                            <select class="ps-rating" data-read-only="true">

                                <?php

                                    if ($reviews > 0) {

                                        for ($i = 0; $i < 5; $i++) {

                                            if ($reviews < ($i + 1)) {

                                                echo '<option value="1">' . ($i + 1) . '</option>';
                                            } else {

                                                echo '<option value="2">' . ($i + 1) . '</option>';
                                            }
                                        }
                                    } else {

                                        echo '<option value="0">0</option>';

                                        for ($i = 0; $i < 5; $i++) {

                                            echo '<option value="1">' . ($i + 1) . '</option>';
                                        }
                                    }

                                    ?>

                            </select>

                            <span>(<?php

                                        if ($item->reviews_product != null) {

                                            echo count(json_decode($item->reviews_product, true));
                                        } else {

                                            echo 0;
                                        }

                                        ?>)</span>

                        </div>

                        <!--=====================================
                        El precio en oferta del producto
                        ======================================-->

                        <?php if ($item->offer_product != null) : ?>

                        <p class="ps-product__price sale">

                            <?php
                                    echo "$" . TemplateController::offerPrice(

                                        $item->price_product,
                                        json_decode($item->offer_product, true)[1],
                                        json_decode($item->offer_product, true)[0]

                                    );

                                    ?>

                            <del> $<?php echo $item->price_product ?></del>

                        </p>

                        <?php else : ?>

                        <p class="ps-product__price"><?php echo "$" . $item->price_product ?></p>

                        <?php endif ?>

                    </div>

                    <div class="ps-product__content hover">

                        <!--=====================================
                        El nombre del producto
                        ======================================-->

                        <a class="ps-product__title" href="<?php echo $path . $item->url_product ?>">

                            <?php echo $item->name_product ?>

                        </a>

                        <!--=====================================
                        El precio en oferta del producto
                        ======================================-->

                        <?php if ($item->offer_product != null) : ?>

                        <p class="ps-product__price sale">

                            <?php
                                    echo "$" . TemplateController::offerPrice(

                                        $item->price_product,
                                        json_decode($item->offer_product, true)[1],
                                        json_decode($item->offer_product, true)[0]

                                    );

                                    ?>

                            <del> $<?php echo $item->price_product ?></del>

                        </p>

                        <?php else : ?>

                        <p class="ps-product__price"><?php echo "$" . $item->price_product ?></p>

                        <?php endif ?>

                    </div>

                </div>

            </div><!-- End Product -->

            <?php endforeach ?>

        </div>

    </div>

</div><!-- End Recommended Items -->
<div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
            <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                <div class="ps-product__header">
                    <div class="ps-product__thumbnail" data-vertical="false">
                        <div class="ps-product__images" data-arrow="true">
                            <div class="item" text-align="center"><img src="img/products/default/no_found.png"
                                    width="100%" alt="" id="modal-image">
                            </div>
                        </div>
                    </div>
                    <div class="ps-product__info">
                        <a href="#" id="modal-url">
                            <h1 id="modal-name">Marshall Kilburn Portable Wireless Speaker</h1>
                        </a>
                        <div class="ps-product__meta">
                            <!-- <p >Brand:<a href="shop-default.html">Sony</a></p> -->
                            <div class="ps-product__rating">
                                <select class="ps-rating" data-read-only="true">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select><span>(1 review)</span>
                            </div>
                        </div>
                        <h4 class="ps-product__price" id="modal-price">$36.78 – $56.99</h4>
                        <div class="ps-product__desc">
                            <p>Sold By: <a href="#" id="modal-name-store"><strong> Go
                                        Pro</strong></a>
                                <!-- status:<strong class="ps-tag--out-stock"> Out of stock</strong> -->
                            </p>
                            <p id="ps-sold-out">
                                <!-- status:<strong class="ps-tag--out-stock"> Out of stock</strong> -->
                            </p>
                            <ul class="ps-list--dot" id="modal-summary">

                            </ul>
                        </div>
                        <div class="ps-product__shopping" id="ps-product__shopping">
                            <a class="ps-btn ps-btn--black" href="#" id="show-more">
                                Show more
                            </a>
                            <!-- <a class="ps-btn" href="#">Buy Now</a> -->
                            <!-- <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div> -->
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>