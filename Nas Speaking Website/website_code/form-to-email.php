<?php 
if(isset($_POST['submit'])){
    $to = "35thdesign@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $subject = "Transcending Narratives Website";
    $name = $_POST['name'];
    $phone = $_POST[''];
    $city = $_POST['city'];
    $type = $_POST['type'];
    $budget = $_POST['budget'];
    $email = $_POST['email'];
    $organization = $_POST['organization'];
    $date = $_POST['date'];
    $audience = $_POST['audience'];
    $topic = $_POST['topic'];
    $additionalComments = $_POST['additionalComments'];
    
    $message = "Hello Nasiah,"."\n\n"."My name is ".$name."\n"."I looking to book this type of event: ".$type."\n"."For this organization: ".$organization."\n"."On this date: ".$date."\n"."At this location: ".$city."\n"."\n"."My budget is: ".$budget."\n"."About the audience: ".$city."\n"."\n"."More info: "."\n"."\n".$additionalComments."\n"."\n"."\n You can reach me at:".$email."\n or:".$phone;

    $headers = "From:" . $from;
    
    echo "Butt stuff"
    
   /* if(mail($to,$subject,$message,$headers))
    {

        echo "<script>
                alert('Email sent sucessfully!');
                window.location.href='home.php';  
            </script>";
        


    }
    else
    {
                echo "<script>
                alert('Error, something went wrong');
                window.location.href='home.php';  
            </script>";
    }*/
    
    }
?>