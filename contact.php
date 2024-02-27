<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
      <div class="content-wrapper">
        <div class="container">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-9">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "
                                <div class='alert alert-danger'>
                                    ".$_SESSION['error']."
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                    ?>
            <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div class="container" style="max-width: 800px; margin: 50px auto; padding: 20px; background-color: #CBCBCB; border-radius: 20px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);">
        <div class="contact-block" style="background-color: #E5DEDE; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <h3 style="color: #333; margin-bottom: 10px;">Syed Zafran Haider</h3>
            <p style="color: #666; margin-bottom: 5px;">Email: <a href="mailto:zraaeae@gmail.com" style="color: #007bff; text-decoration: none;">zraaeae@gmail.com</a></p>
            <p style="color: #666;">Phone: <a href="tel:+923239583860" style="color: #007bff; text-decoration: none;">+92 323 9583860</a></p>
        </div>
        <div class="contact-block" style="background-color: #E5DEDE; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
            <h3 style="color: #333; margin-bottom: 10px;">Abdul Ahad</h3>
            <p style="color: #666; margin-bottom: 5px;">Email: <a href="mailto:gokuahad11@gmail.com" style="color: #007bff; text-decoration: none;">gokuahad11@gmail.com</a></p>
            <p style="color: #666;">Phone: <a href="tel:+923239583860" style="color: #007bff; text-decoration: none;">+92 323 9583860</a></p>
        </div>
        <div class="contact-block" style="background-color: #E5DEDE; padding: 20px; border-radius: 10px;">
            <h3 style="color: #333; margin-bottom: 10px;">Huzaifa Iftikhar</h3>
            <p style="color: #666; margin-bottom: 5px;">Email: <a href="mailto:huzaifa@gmail.com" style="color: #007bff; text-decoration: none;">huzaifa@gmail.com</a></p>
            <p style="color: #666;">Phone: <a href="tel:+923239583860" style="color: #007bff; text-decoration: none;">+92 323 9583860</a></p>
        </div>
    </div>
</body>

                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Include your carousel code here -->
                    </div>
                    

                </div>
                <div class="col-sm-3">
                    <?php include 'includes/sidebar.php'; ?>
                </div>
            </div>
          </section>
         
        </div>
      </div>
  
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
