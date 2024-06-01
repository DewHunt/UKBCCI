<?php
function getBusinessEmailBody ()
{
   return
        '<p> First Name: ' . $_POST['name'] . '</p></br>'
        . '<p> Surname: ' . $_POST['sur_name'] . '</p></br>'
        . '<p>Business Name: ' . $_POST['business_name'] . '</p></br>'
        . '<p>Business Address: ' . $_POST['business_address'] . '</p></br>'
        . '<p>Email Address: ' . $_POST['email'] . '</p></br>'
        . '<p>Contact Number: ' . $_POST['contact'] . '</p></br>';
}

?>