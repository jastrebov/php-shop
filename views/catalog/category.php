<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php');?>



    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?php foreach ($categorys as $category ):?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a  href="/category/<?php echo $category['id']; ?>"
                                            class="<?php if($category_id == $category['id'])echo 'active'?>" >
                                                <?php echo $category['name'];?>
                                            </a>
                                        </h4>
                                    </div>

                                </div>

                            <?php endforeach;?>

                        </div><!--/category-products-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->

                        <h2 class="title text-center">Каталог товаров</h2>


                        <?php  foreach ($getProductsListByCategory as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/template/images/home/product1.jpg" alt="" />
                                            <h2>$<?php echo $product['price']?></h2>
                                            <p><a href="/product/<?php echo $product['id'] ?>"><?php echo $product['name']?>№id -<?php echo $product['id']?></a></p>
                                            <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i class="fa fa-shopping-cart"></i>Корзина</a>
                                        </div>
                                        <?php if($product['is_new']):?>
                                            <img src="/template/images/home/new.png" class="new" alt=""/>
                                        <?php endif;?>
                                    </div>

                                </div>
                            </div>
                        <?php  endforeach; ?>

                        <!--Постраничная навигация-->
                        <?php echo $pagination->get();?>

                    </div><!--features_items-->

                </div>
            </div>
        </div>
    </section>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php');?>