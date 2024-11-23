<?php include("includes/header.php"); ?>
<div class="section resultPage">
    <?php if($success == 1): ?>
        <div class="resultMsgBox">
            <h3>
                Thank you! <br> 
                Your payment processes sucessfully, and your order has been placed! <br>
                A confirmaion email has been sent out!
                <br>
                <br>
                - Modern Edge Armory
            </h3>
        </div>
    <?php elseif($success == 2): ?>
        <div class="resultMsgBox">
            <h3>
                Your credit card has been declined! <br> 
                Your payment did not processes, and your order has not been placed. <br>
                Please try again later.
                <br>
                <br>
                - Modern Edge Armory
            </h3>
        </div>
    <?php elseif($success == 3): ?>
        <div class="resultMsgBox">
            <h3>
                Your credit card number is invalid! <br> 
                Your payment did not processes, and your order has not been placed. <br>
                Please try again later.
                <br>
                <br>
                - Modern Edge Armory
            </h3>
        </div>
    <?php else: ?>
        <div class="resultMsgBox">
            <h3>
                Something Went Wrong! <br> 
                Your payment did not processes, and your order has not been placed. <br>
                Please try again later.
                <br>
                <br>
                - Modern Edge Armory
            </h3>
        </div>
    <?php endif; ?>
    <a class="link" href="frontpage.php"><button class="SIB">home page</button></a>
</div>
<?php include("includes/footer.php"); ?>