<?php include("includes/header.php"); ?>
    <!--Main Page Body-->
    <?php #echo $title?>
    <?php #echo "<BR><BR>"?>
    <?php #echo $maxItemCount?>
    <?php #echo "<BR><BR>"?>
    <?php #echo $type?>
    <?php #echo "<BR><BR>"?>
  
    <div class="section shopSection">
        <div class="contentContainer shopContainer">
            <div class="filterBox">
                <p class="filterTxt">filter</p>
                <div class="filter">
                    <label for="filter1" class="filterLabel">MANUFACTURERS</label>
                    <select name="filter1" class="filterSelect" id="mfgFilter" onChange="filterResults();">
                        <option value="" disabled selected>Select Manufacturer</option>
                        <option value="All">All</options>
                        <?php foreach($manufacturers as $manufacturer): ?>
                            <option value="<?php echo $manufacturer?>"><?php echo $manufacturer?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="filter2" class="filterLabel">TYPE</label>
                    <select name="filter2" class="filterSelect" id="fTypeFilter" onChange="filterResults();">
                        <option value="" disabled selected>Select Firearm Type</option>
                        <option value="All">All</options>
                        <?php foreach($firearmTypes as $firearmType): ?>
                            <option value="<?php echo $firearmType?>"><?php echo $firearmType?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="filter3" class="filterLabel">OPTICS</label>
                    <select name="filter3" class="filterSelect" id="opticsFilter" onChange="filterResults();">
                        <option value="" disabled selected>Select Optic Type</option>
                        <option value="All">All</options>
                        <?php foreach($opticTypes as $opticType): ?>
                            <option value="<?php echo $opticType?>"><?php echo $opticType?></option>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label for="filter4" class="filterLabel">CALLIBER/GAGE</label>
                    <select name="filter4" class="filterSelect" id="calibFilter" onChange="filterResults();">
                        <option value="" disabled selected>Select Calliber/Gage</option>
                        <option value="All">All</options>
                        <?php foreach($caliberGages as $caliberGage): ?>
                            <option value="<?php echo $caliberGage?>"><?php echo $caliberGage?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="shopBox" id="ShopContainerBox">
                <h1 class="shopHeader"><?php echo $title; ?></h1>
                <!--PHP START-->
                <?php if($products) : ?>
                    <?php if($type == 'All') : ?>
                        <?php foreach($products as $product):?> 
                            <?php if($currentCount < $maxItemCount) : ?> 
                            <div class="slide shopProducts" id="productSlide">
                                <a class="link" href="item.php?itemNo=<?php echo $product->ITEMNO; ?>">
                                    <div class="shopProductImgBox">
                                        <?php $imgName = substr($product->IMAGENAME, 0, strpos($product->IMAGENAME, '.')) . ".webp"; ?>  
                                        <img class="shopProductImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                    </div>
                                    <div class="productDescBox">
                                        <div class="productDesc shopProductDescPad">
                                            <div class="tagsBox">
                                                <div id="manufBox">
                                                    <b><?php echo $product->MANUFACTURER; ?></b>
                                                </div>
                                                / 
                                                <div id="typeBox">
                                                    <b><?php echo $product->TYPE; ?></b>
                                                </div>
                                                / 
                                                <div id="sightsBox">
                                                    <b><?php echo $product->SIGHTSTYPE; ?></b>
                                                </div>
                                                / 
                                                <div id="caliberBox">
                                                    <b><?php echo $product->CALIBERGAUGE; ?></b>
                                                </div>
                                            </div>
                                            <?php echo $product->DESCRIPTION1; ?>
                                        </div>
                                        <div class="productPrice" id="price">
                                            <?php if($product->ONSALE == "TRUE"): ?>
                                                <p style="padding:0; margin:0; color:red;">SALE! $<?php echo number_format((float)($product->MSRP - ($product->MSRP*.05)), 2, '.', ''); ?></p>
                                            <?php else: ?>
                                                $<?php echo number_format((float)$product->MSRP, 2, '.', ''); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php $currentCount = $currentCount + 1;?>
                            <?php endif ?>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if($type == 'None') : ?>
                        <?php foreach($products as $product):?> 
                            <?php if($currentCount < $maxItemCount) : ?> 
                            <div class="slide shopProducts" id="productSlide">
                                <a class="link" href="item.php?itemNo=<?php echo $product->ITEMNO; ?>">
                                    <div class="shopProductImgBox">
                                        <?php $imgName = substr($product->IMAGENAME, 0, strpos($product->IMAGENAME, '.')) . ".webp"; ?>  
                                        <img class="shopProductImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                    </div>
                                    <div class="productDescBox">
                                        <div class="productDesc shopProductDescPad">
                                            <div class="tagsBox">
                                                <div id="manufBox">
                                                    <b><?php echo $product->MANUFACTURER; ?></b>
                                                </div>
                                                / 
                                                <div id="typeBox">
                                                    <b><?php echo $product->TYPE; ?></b>
                                                </div>
                                                / 
                                                <div id="sightsBox">
                                                    <b><?php echo $product->SIGHTSTYPE; ?></b>
                                                </div>
                                                / 
                                                <div id="caliberBox">
                                                    <b><?php echo $product->CALIBERGAUGE; ?></b>
                                                </div>
                                            </div>
                                            <?php echo $product->DESCRIPTION1; ?>
                                        </div>
                                        <div class="productPrice" id="price">
                                            <?php if($product->ONSALE == "TRUE"): ?>
                                                <p style="padding:0; margin:0; color:red;">SALE! $<?php echo number_format((float)($product->MSRP - ($product->MSRP*.05)), 2, '.', ''); ?></p>
                                            <?php else: ?>
                                                $<?php echo number_format((float)$product->MSRP, 2, '.', ''); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php $currentCount = $currentCount + 1;?>
                            <?php endif ?>
                        <?php endforeach;?>
                    <?php endif; ?>
                    <?php if($type == 'Accessory-%') : ?>
                        <?php foreach($products as $product):?> 
                            <?php if($currentCount < $maxItemCount) : ?>
                                <div class="slide shopProducts" id="productSlide">
                                    <a class="link" href="item.php?itemNo=<?php echo $product->ITEMNO; ?>">
                                        <div class="shopProductImgBox">
                                            <?php $imgName = substr($product->IMAGENAME, 0, strpos($product->IMAGENAME, '.')) . ".webp"; ?>  
                                            <img class="shopProductImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                        </div>
                                        <div class="productDescBox">
                                            <div class="productDesc shopProductDescPad">
                                                <div class="tagsBox">
                                                    <div id="manufBox">
                                                        <b><?php echo $product->MANUFACTURER; ?></b>
                                                    </div>
                                                    / 
                                                    <div id="typeBox">
                                                        <b><?php echo $product->TYPE; ?></b>
                                                    </div>
                                                    / 
                                                    <div id="sightsBox">
                                                        <b><?php echo $product->SIGHTSTYPE; ?></b>
                                                    </div>
                                                    / 
                                                    <div id="caliberBox">
                                                        <b><?php echo $product->CALIBERGAUGE; ?></b>
                                                    </div>
                                                </div>
                                                <?php echo $product->DESCRIPTION1; ?>
                                            </div>
                                            <div class="productPrice" id="price">
                                                <?php if($product->ONSALE == "TRUE"): ?>
                                                    <p style="padding:0; margin:0; color:red;">SALE! $<?php echo number_format((float)($product->MSRP - ($product->MSRP*.05)), 2, '.', ''); ?></p>
                                                <?php else: ?>
                                                    $<?php echo number_format((float)$product->MSRP, 2, '.', ''); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php $currentCount = $currentCount + 1;?>
                            <?php endif ?>
                        <?php endforeach;?>
                    <?php else: ?>
                        <?php foreach($products as $product):?>  
                            <?php if($currentCount < $maxItemCount) : ?>
                                <?php if($product->TYPE == $type) : ?>
                                    <div class="slide shopProducts" id="productSlide">
                                        <a class="link" href="item.php?itemNo=<?php echo $product->ITEMNO; ?>">
                                            <div class="shopProductImgBox">
                                                <?php $imgName = substr($product->IMAGENAME, 0, strpos($product->IMAGENAME, '.')) . ".webp"; ?>  
                                                <img class="shopProductImg" src="media/catalog/<?php echo $imgName; ?>" alt="" />
                                            </div>
                                            <div class="productDescBox">
                                                <div class="productDesc shopProductDescPad">
                                                    <div class="tagsBox">
                                                        <div id="manufBox">
                                                            <b><?php echo $product->MANUFACTURER; ?></b>
                                                        </div>
                                                        / 
                                                        <div id="typeBox">
                                                            <b><?php echo $product->TYPE; ?></b>
                                                        </div>
                                                        / 
                                                        <div id="sightsBox">
                                                            <b><?php echo $product->SIGHTSTYPE; ?></b>
                                                        </div>
                                                        / 
                                                        <div id="caliberBox">
                                                            <b><?php echo $product->CALIBERGAUGE; ?></b>
                                                        </div>
                                                    </div>
                                                    <?php echo $product->DESCRIPTION1; ?>
                                                </div>
                                                <div class="productPrice" id="price">
                                                <?php if($product->ONSALE == "TRUE"): ?>
                                                    <p style="padding:0; margin:0; color:red;">SALE! $<?php echo number_format((float)($product->MSRP - ($product->MSRP*.05)), 2, '.', ''); ?></p>
                                                <?php else: ?>
                                                    $<?php echo number_format((float)$product->MSRP, 2, '.', ''); ?>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif ?>
                                <?php $currentCount = $currentCount + 1;?>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php else : ?>
                    <p>No <?php echo $type?> To Display</p>
                <?php endif ?>
                <!--PHP END-->

                <div style="width:100%">
                    <div id="loadmore" class="moreButton">load more</div>
                </div>
            </div>
            
        </div>
    </div>
<?php include("includes/footer.php"); ?>

<script>
    var filter1Active = false;
    var currentFilter1 = "";
    var filter2Active = false;
    var currentFilter2 = "";
    var filter3Active = false;


    function filterResults(){
        const parentDiv = document.getElementById("ShopContainerBox");
        const shopProducts = parentDiv.querySelectorAll("div");

        const mfgFilter = document.getElementById("mfgFilter");
        const mfgFilterText = mfgFilter.value.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
        const fTypeFilter = document.getElementById("fTypeFilter");
        const fTypeFilterText = fTypeFilter.value.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
        const opticsFilter = document.getElementById("opticsFilter");
        const opticsFilterText = opticsFilter.value.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
        const calibFilter = document.getElementById("calibFilter");
        const calibFilterText = calibFilter.value.toUpperCase();
        var filter1Applied = false;
        var filter1Match = false;
        var filter2Applied = false;
        var filter2Match = false;
        var filter3Applied = false;
        var filter3Match = false;
        var filter4Applied = false;
        var filter4Match = false;

        //console.log(mfgFilterText, fTypeFilterText, opticsFilterText, calibFilterText);
        
        shopProducts.forEach(function(shopProduct){
            
            if (shopProduct.id == "manufBox" && mfgFilterText !== "" && mfgFilterText != "ALL"){
                filter1Applied = true;
                divtext = shopProduct.textContent.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
                //console.log(divtext, mfgFilterText);
                if(divtext === mfgFilterText){
                    filter1Match = true;
                }else{
                    filter1Match = false;
                }
            }

            if (shopProduct.id == "typeBox" && fTypeFilterText !== "" && fTypeFilterText != "ALL"){
                filter2Applied = true;
                divtext = shopProduct.textContent.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
                //console.log(divtext, fTypeFilterText);
                if(divtext == fTypeFilterText){
                    filter2Match = true;
                }else{
                    filter2Match = false;
                }
            }

            if (shopProduct.id == "sightsBox" && opticsFilterText !== "" && opticsFilterText != "ALL"){
                filter3Applied = true;
                divtext = shopProduct.textContent.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
                //console.log(divtext, opticsFilterText);
                if(divtext == opticsFilterText){
                    filter3Match = true;
                }else{
                    filter3Match = false;
                }
            }

            if (shopProduct.id == "caliberBox" && calibFilterText !== "" && calibFilterText != "ALL"){
                filter4Applied = true;
                divtext = shopProduct.textContent.toUpperCase().replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
                //console.log(divtext, calibFilterText);
                if(divtext == calibFilterText){
                    filter4Match = true;
                }else{
                    filter4Match = false;
                }
            }

            var filterCount = 0;

            if (shopProduct.id == "price"){
                
                //Check howmany filters are applied 
                if(filter1Applied){
                    filterCount++;
                }
                if(filter2Applied){
                    filterCount++;
                }
                if(filter3Applied){
                    filterCount++;
                }
                if(filter4Applied){
                    filterCount++;
                }

                //console.log(filterCount, filter1Applied, filter2Applied, filter3Applied, filter4Applied);

                if(filterCount == 4){
                    if(filter1Match && filter2Match && filter3Match && filter4Match){
                        slideDiv = shopProduct.parentElement.parentElement.parentElement;
                        slideDiv.style.display = "";
                    }else{
                        slideDiv = shopProduct.parentElement.parentElement.parentElement;
                        slideDiv.style.display = "none";      
                    }
                }else if (filterCount == 1){
                    if(filter1Match || filter2Match || filter3Match || filter4Match){
                        slideDiv = shopProduct.parentElement.parentElement.parentElement;
                        slideDiv.style.display = "";
                    }else{
                        slideDiv = shopProduct.parentElement.parentElement.parentElement;
                        slideDiv.style.display = "none";      
                    }
                }else if (1 < filterCount && filterCount < 4){
                    //console.log(filterCount, filter1Match, filter2Match, filter3Match, filter4Match);
                    if(filterCount == 2){
                        if(filter1Match && filter2Match && !filter3Match && !filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";
                        }else if(filter1Match && !filter2Match && filter3Match && !filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";      
                        }else if(filter1Match && !filter2Match && !filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";      
                        }else if(!filter1Match && filter2Match && filter3Match && !filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";      
                        }else if(!filter1Match && filter2Match && !filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";      
                        }else if(!filter1Match && !filter2Match && filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";   
                        }else{
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "none";
                            }
                    }
                    if(filterCount == 3){
                        if(!filter1Match && filter2Match && filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";   
                        }else if(filter1Match && !filter2Match && filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";   
                        }else if(filter1Match && filter2Match && !filter3Match && filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";   
                        }else if(filter1Match && filter2Match && filter3Match && !filter4Match){
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "";   
                        }else{
                            slideDiv = shopProduct.parentElement.parentElement.parentElement;
                            slideDiv.style.display = "none";      
                            //console.log("removing!")
                        }
                    }
                }else{
                    slideDiv = shopProduct.parentElement.parentElement.parentElement;
                    slideDiv.style.display = "";
                }
            }
        });

    }

    type= "<?php echo $type; ?>";
    search= "<?php echo $search; ?>";
    maxCount= <?php echo $maxItemCount; ?>;

    document.getElementById("loadmore").onclick = function() {loadMoreFunction()};

    function loadMoreFunction() {
        maxCount +=100;
        params = ['count'];
        if(search != ""){
            params.push("search");
        }
        if(type != ""){
            params.push("type");
        }
        vals = [maxCount];
        if(search != ""){
            vals.push(search);
        }
        if(type != ""){
            vals.push(type);
        }
        url = URL_add_parameter("redirectShop.php", params, vals);
        console.log(url);
        window.location.href = url;
    }

    function URL_add_parameter(url, params, values, ){
        var hash       = {};
        var parser     = document.createElement('a');

        parser.href    = url;

        var parameters = parser.search.split(/\?|&/);

        for(var i=0; i < parameters.length; i++) {
            if(!parameters[i])
                continue;

            var ary      = parameters[i].split('=');
            hash[ary[0]] = ary[1];
        }

        for(var j = 0; j < params.length; j++){
            hash[params[j]] = vals[j];
        }


        var list = [];  
        Object.keys(hash).forEach(function (key) {
            list.push(key + '=' + hash[key]);
        });

        parser.search = '?' + list.join('&');
        console.log(parser.href);
        return parser.href;
    }
    
</script>
