<?php include("includes/header.php"); ?>
    <div class="section smallBox">
        <div class="contentContainer smallContainer">  

            <h1 class="cartTitle">Cart</h1>

            <div class="cartTableWrapper Show">  
                <table class="cartTable">
                    <tr class="cartTableRow">
                        <th>Remove</th>
                        <th colspan = 2>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    <!--PHP START-->
                    <?php $total = 0;?>
                    <?php foreach($cart as $product): ?>
                    <tr class="cartTableRow">
                        <td>
                            <form action="redirectCt.php" method="post">
                                <input type="hidden" name="removeNo" value="<?php echo $product['itemNo']; ?>"/>
                                <button class="removeBtn"></button>
                            </form>
                        </td>
                        <td>
                            <a class="link" href="item.php?itemNo=<?php echo $product['itemNo']?>">
                                <img class="cartItemImg" src="media/catalog/<?php echo $product['imgName']; ?>" alt="product"/>
                            </a>
                        </td>
                        <td>
                            <a class="link" href="item.php?itemNo=<?php echo $product['itemNo']?>">
                                <?php echo $product['itemName']; ?>
                            </a>
                        </td>
                        <td>$<?php echo $product['price']; ?></td>
                        <td><?php echo $product['qty']; ?></td>
                        <td>$<?php echo $product['subTotal']; ?></td>
                    
                    </tr>
                    <?php $total+= $product['subTotal'];?>
                    <?php endforeach; ?>
                    <!--PHP END-->
                </table>
            </div>

            <table class="mobileCartTable noShowTable" >
                <!--PHP START-->
                <?php foreach($cart as $product): ?>
                <tr class="mobileCartTableRow1">
                    <td rowspan="2" ><img class="mobileCartItemImg" src="media/catalog/<?php echo $product['imgName']; ?>" alt="product"/></td>
                    <td><?php echo $product['itemName']; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                </tr>
                
                <tr class="mobileCartTableRow2">
                    <td>Quantity: <?php echo $product['qty']; ?></td>
                    <td>
                        <form action="redirectCt.php" method="post">
                            <input type="hidden" name="removeNo" value="<?php echo $product['itemNo']; ?>"/>
                            <button class="removeBtnSmall">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <!--PHP END-->
            </table>


            <div class="totalBox">
                <p class="totalTxt">Total: <!--PHP START-->$<?php echo $total; ?> <!--PHP END--></p>
                <?php if(!empty($cart)): ?>
                    <a class="link" href="checkout.php"><button class="SIB checkout">checkout</button></a>
                <?php else: ?>
                    <a class="link" href="shop.php"><button class="SIB">view products</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>