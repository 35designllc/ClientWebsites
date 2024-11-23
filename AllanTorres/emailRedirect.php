<?php require("core/init.php");?>
<?php

if(isset($_POST['newsletterSubscribe'])){
    $to = "35thdesign@gmail.com";//"marketing@modernedgearmory.com"; // this is your Email address
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
    
    }elseif(isset($_POST['footerContactSubmit'])){

    $to = "35thdesign@gmail.com";//"marketing@modernedgearmory.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $randRequestNumber = rand(0000000000,1000000000);
    $subject = "Modern Edge Armory Inquiry #".$randRequestNumber;
    $message = $_POST['text'];
   
    $headers = "From:" . $from;

    if(mail($to,$subject,$message,$headers))
    {

        echo "<script>
                alert('Message Submitted!');
                window.location.href='index.php';  
            </script>";
        


    }
    else
    {
                echo "<script>
                alert('Error, something went wrong 2');
                window.location.href='index.php';  
            </script>";
    }

    }else{

        echo "<script>
        alert('Error, something went wrong 2');
        window.location.href='index.php';  
        </script>";

    }

die();
?>