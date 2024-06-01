<?php


session_start();

if(isset($_SESSION['flash_message'])) {

  ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert" id="success-alert">
    <strong>Hey !</strong> <?= $_SESSION['flash_message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
  unset($_SESSION['flash_message']);
}

$_SESSION['name_error_message']             = '';
$_SESSION['email_error_message']            = '';
$_SESSION['business_name_error_message']    = '';
$_SESSION['contact_error_message']          = '';
$_SESSION['surname_error_message']          = '';
$_SESSION['business_address_error_message'] = '';


if(isset($_POST["send_email"])) {
  include('DB/db_connect.php');

  if(is_valid_form() == false) {
    // header('Location:index.php');
  } else {

    $name             = $_POST["name"];
    $sur_name         = $_POST["sur_name"];
    $business_name    = $_POST["business_name"];
    $business_address = $_POST["business_address"];
    $email            = $_POST["email"];
    $contact          = $_POST["contact"];

    $checkEmailQuery = "SELECT * FROM attandence WHERE email = '$email'";
    $result          = $conn->query($checkEmailQuery);

    if($result->num_rows > 0) {

      $_SESSION['flash_message'] = " You are already registered!";
      header('Location:index.php');

    } else {

      $insertQuery = "INSERT INTO attandence (first_name, surname, business_name, business_address, email, contact) VALUES ('$name', '$sur_name', '$business_name', '$business_address', '$email', '$contact')";

      if($conn->query($insertQuery) === TRUE) {
        include('email_form_submit.php');
        sendMail();
        header('Location:index.php');

      } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
      }
    }
    $conn->close();
  }
}

function is_valid_form ()
{
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_valid = true;


    if(empty($_POST["name"])) {
      $_SESSION['name_error_message'] = 'Name is required';
      $is_valid                       = false;
    } else if(empty($_POST['sur_name'])) {
      $_SESSION['surname_error_message'] = 'Sur Name is required';
      $is_valid                          = false;
    } else if(empty($_POST['business_name'])) {
      $_SESSION['business_name_error_message'] = 'Business Name is required';
      $is_valid                                = false;
    } else if(empty($_POST['business_address'])) {
      $_SESSION['business_address_error_message'] = 'Business Address is required';
      $is_valid                                   = false;
    } else if(empty($_POST["email"])) {
      $_SESSION['email_error_message'] = 'Email is required';
      $is_valid                        = false;
    } else if(empty($_POST['contact'])) {
      $_SESSION['contact_error_message'] = 'Contact is required';
      $is_valid                          = false;
    } else {
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error_message'] = 'Invalid email format';
        $is_valid                        = false;
      }
    }
  } else {
    $_SESSION['flash_message'] = 'Sorry! Something went wrong, Try Again.';
    $is_valid                  = false;
  }
  return $is_valid;
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>UKBCCI</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

  </head>

  <style>
    .error {
      color: #FF0000;
    }
  </style>

  <body>

    <div class="container">
      <section id="sec-1">
        <div class="header">
          <img src="assets/images/visitor.png" alt="header-image" class=" bg-img" />
          <img src="assets/images/logo.png" alt="logo" class="logo-img" />
          <div class="img-text">
            <h2 class="logo-heading">UKBCCI Trade Show and </br>Business Networking Event</h2>
            <div class="date-time">
              <p class="time">Time : 6:30 pm Followed by Dinner</p>
              <p class="date">Date : Monday 8<sup>th</sup> January 2024</p>
              <p class="venue">Venue : Yasmin Banqueting, 1 Intown Row, Walsall, WS1 2AD</p>
            </div>
          </div>
        </div>
      </section>

      <section id="sec-2">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="header-bottom">You are invited to attend a Trade Show and Business Networking Event organised by
              the UKBCCI to bring together the local business community.</p>
          </div>

        </div>
      </section>

      <section id="sec-3">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="paragraph-2">This will be a great opportunity to network with entrepreneurs who have diversified
              into many different
              sectors.</p>
          </div>

        </div>
      </section>

      <section id="sec-4">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="paragraph-3">Attending business networking events is a great way to make valuable connections and
              expand your
              professional network. Make sure to RSVP below.</p>
          </div>

        </div>
      </section>

      <section id="sec-5">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>
              <button type="button" class="point-title click registration-modal-btn" data-bs-toggle="modal"
                data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                <span class="">Please click on the link</span> and register your attendance
              </button>
            </h2>
          </div>
        </div>
      </section>

      <footer>
        <div class="row footer-img">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <p class="contact-number"><img src="assets/images/contact_number.svg" alt="" width="19px" height="auto">
              <span class="number">02072472331</span>
            </p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 text-center">
            <p class="contact-number"><img src="assets/images/email.svg" alt="" width="25px" height="auto">
              <span class="number">info@ukbcci.org.uk</span>
            </p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 text-end">
            <p class="contact-number"><img src="assets/images/website.svg" alt="" width="25px" height="auto"> <span
                class="number"><a style="text-decoration: none; color:#FFFFFF;" href="https://www.ukbcci.org.uk/"
                  target="_blank">www.ukbcci.org.uk</a></span></p>

          </div>
        </div>
      </footer>
    </div>

    <div class="modal fade registration-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" name="registration_form">
             <div class=" row">
                <div class=" col-lg-6 col-md-6 col-sm-12 mb-1">
                  <label for="name" class="form-label"> First Name:</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                  <span
                    class="error"><?php echo isset($_SESSION['name_error_message']) ? $_SESSION['name_error_message'] : ''; ?></span>

                </div>

                <div class=" col-lg-6 col-md-6 col-sm-12 mb-1">
                  <label for="sur_name" class="form-label"> Surname:</label>
                  <input type="text" class="form-control" id="sur_name" name="sur_name" required>
                  <span
                    class="error"><?php echo isset($_SESSION['surname_error_message']) ? $_SESSION['surname_error_message'] : ''; ?></span>
                </div>
              </div>

              <div class="mb-1">
                <label for="business-name" class="form-label">Business Name:</label>
                <input type="text" class="form-control" id="business-name" name="business_name" required>
                <span
                  class="error"><?php echo isset($_SESSION['business_name_error_message']) ? $_SESSION['business_name_error_message'] : ''; ?></span>
              </div>
              <div class="mb-1">
                <label for="business-address" class="form-label">Business Address:</label>
                <input type="text" class="form-control" id="business-address" name="business_address" required>
                <span
                  class="error"><?php echo isset($_SESSION['business_address_error_message']) ? $_SESSION['business_address_error_message'] : ''; ?></span>
              </div>
              <div class=" mb-1">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <span
                  class="error"><?php echo isset($_SESSION['email_error_message']) ? $_SESSION['email_error_message'] : ''; ?></span>
              </div>
              <div class=" mb-1">
                <label for="contact" class="form-label">Contact Number:</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
                <span
                  class="error"><?php echo isset($_SESSION['contact_error_message']) ? $_SESSION['contact_error_message'] : ''; ?></span>
              </div>
              <div class=" mb-1">
                <input type="checkbox" id="checkmark" name="checkmark" value="checkbox" required>
                &nbsp;
                <label for="checkmark"> Yes i am attending</label>
              </div>
              <div class="">
                <label for="message-text" class="form-label"><b>Note: If you have any friends
                    and family who also own a business in and around Walsall, please share this invitation, as this
                    networking event will be beneficial to all business owners.</br>
                  </b>
                </label>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save-btn" name="send_email">Submit</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script>
      setInterval(closeAlertMessage, 3000);

      function closeAlertMessage() {
        var alertElement = document.getElementById("success-alert");
        if (alertElement) {
          alertElement.remove();
        }
      }

    </script>
  </body>

</html>