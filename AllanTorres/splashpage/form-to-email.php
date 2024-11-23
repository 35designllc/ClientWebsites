<?php 
if(isset($_POST['submit'])){
    $to = "marketing@modernedgearmory.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $subject = "New Newsletter Subscriber!";
    $message = "Hello, I would like to subscribe to your newsletter!"."\n\n"."Here is my email: ".$_POST['email'];
   
    $headers = "From:" . $from;
    
    if(mail($to,$subject,$message,$headers))
    {

        echo "<script>
                alert('Subscribed to Newsletter!');
                window.location.href='index.php';  
            </script>";
        


    }
    else
    {
                echo "<script>
                alert('Error, something went wrong');
                window.location.href='index.php';  
            </script>";
    }
    
    }
?>