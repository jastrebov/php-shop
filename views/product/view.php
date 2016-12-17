<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php');?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id'];?>">
                                            <?php echo $categoryItem['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="/template/images/product-details/1.jpg" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=""><img src="/template/images/product-details/similar1.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar2.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar3.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img src="/template/images/product-details/similar1.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar2.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar3.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href=""><img src="/template/images/product-details/similar1.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar2.jpg" alt=""></a>
                                    <a href=""><img src="/template/images/product-details/similar3.jpg" alt=""></a>
                                </div>

                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2><?php echo $oneProduct['name']?></h2>
                            <p>Web ID: 1089772</p>
                            <img src="/template/images/product-details/rating.png" alt="" />
                            <span>
									<span>$<?php echo $oneProduct['price']?></span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> E-SHOPPER</p>
                            <a href=""><img src="/template/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->
                <div class="row">
                    <div class="col-sm-12">
                        <h5>Описание товара</h5>
                        <p>Разнообразный и богатый опыт постоянный количественный рост и
                            сфера нашей активности требуют определения и уточнения направлений
                            прогрессивного развития. Таким образом реализация намеченных плановых
                            заданий требуют определения и уточнения форм развития.</p>
                        <p>Повседневная практика показывает, что новая модель организационной
                            деятельности способствует подготовки и реализации позиций, занимаемых
                            участниками в отношении поставленных задач. Таким образом постоянное
                            информационно-пропагандистское обеспечение нашей деятельности влечет
                            за собой процесс внедрения и модернизации форм развития.</p>
                        <p>Повседневная практика показывает, что новая модель организационной
                            деятельности способствует подготовки и реализации позиций, занимаемых
                            участниками в отношении поставленных задач. Таким образом постоянное
                            информационно-пропагандистское обеспечение нашей деятельности влечет
                            за собой процесс внедрения и модернизации форм развития.</p>
                        <p>Повседневная практика показывает, что новая модель организационной
                            деятельности способствует подготовки и реализации позиций, занимаемых
                            участниками в отношении поставленных задач. Таким образом постоянное
                            информационно-пропагандистское обеспечение нашей деятельности влечет
                            за собой процесс внедрения и модернизации форм развития.</p>
                    </div>
                </div>
            </div><!--/product-details-->




            </div>
        </div>
    </div>
</section>



<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php');?>
