<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
      <div class="content-wrapper" style="margin-top: 4rem">
        <div class="container text-center">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-12">
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
                    <div style="padding: 20px; background-color: #FFFFFF; border-radius: 15px;">
                    <div style="margin-bottom: 8px; background-color: #FFFFFF; padding: 20px; border-radius: 10px;">
                        <h2 style="text-align: center; color: #007bff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 30px; font-weight: bold; margin-bottom: 20px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">Welcome to Our Project</h2>
                        <p style="font-size: 14px; line-height: 1.6; text-align: center; color: #444;">We strive to provide the best products to our customers with a commitment to quality and excellence. Our journey began with a passion for Jambol, and since then, we have been dedicated to offering exceptional services and building lasting relationships.</p>
                    </div>
                
                    <div style="margin-bottom: 8px; background-color: #FFFFFF; padding: 20px; border-radius: 10px;">
                        <h3 style="color: #0056b3; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Our Mission</h3>
                        <p style="font-size: 14px; line-height: 1.6; color: #444;">Our mission is to be the first choice for your dream. We aim to deliver products at a really good price.</p>
                    </div>
                
                    <div style="margin-bottom: 8px; background-color: #FFFFFF; padding: 20px; border-radius: 10px;">
                        <h3 style="color: #0056b3; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Top Sellers and Featured Products</h3>
                        <p style="font-size: 14px; line-height: 1.6; color: #444;">Explore our top-selling products and featured items that showcase the essence of our commitment to quality and customer satisfaction.</p>
                    </div>
                
                    <div style="margin-bottom: 8px; background-color: #FFFFFF; padding: 20px; border-radius: 10px;">
                        <h3 style="color: #0056b3; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Meet the Team</h3>
                        <p style="font-size: 14px; line-height: 1.6; color: #444;">Behind Our Company is a dedicated team of professionals passionate about your industry or product. Meet the individuals who work tirelessly to bring you the best products and services. <br><strong>kyle, Jelica, Marc, Rovic, Isaac</strong> - Thank you</p>
                    </div>
                </div>
                

                    

                </div>
                <!-- <div class="col-sm-1">
                    <?php include 'includes/sidebar.php'; ?>
                </div> -->
            </div>
          </section>
         
        </div>
      </div>
  
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
