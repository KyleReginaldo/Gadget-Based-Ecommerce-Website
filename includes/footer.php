<!-- <footer class="main-footer" style="background-color: #001f3f; color: #fff; padding: 20px 0; text-align: center;">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Jambol</b>
      </div>
      <strong>Copyright &copy; 2024 <a href="#" style="color: #fff; text-decoration: underline;">Group 1</a></strong>
    </div>
</footer> -->

<footer style="background-color: #0D357E; color: #fff; padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; flex-wrap: wrap;">
        <!-- About Us Section -->
        <div style="flex: 1; margin: 10px;">
            <h3 style="color: #f2f2f2;">About Jambol</h3>
            <p style="line-height: 1.6;">
                Jambol is your one-stop-shop for the latest and greatest gadgets. We offer a wide range of devices
                that cater to tech enthusiasts, professionals, and casual users alike. Our mission is to provide top-quality products at competitive prices.
            </p>
        </div>

        <!-- Quick Links Section -->
        <div style="flex: 1; margin: 10px;">
            <h3 style="color: #f2f2f2;">Quick Links</h3>
            <ul style="list-style: none; padding: 0;">
                <li><a href="index.php" style="color: #f2f2f2; text-decoration: none;">Home</a></li>
                <li><a href="category.php?category=1" style="color: #f2f2f2; text-decoration: none;">Shop</a></li>
                <li><a href="#aboutus" style="color: #f2f2f2; text-decoration: none;">About Us</a></li>
                <li><a href="#contactus" style="color: #f2f2f2; text-decoration: none;">Contact Us</a></li>
                <li><a href="#" style="color: #f2f2f2; text-decoration: none;">FAQ</a></li>
                <?php
                  if(!isset($_SESSION['user'])){

                  
                ?>
                <li><a href="login.php" style="color: #f2f2f2; text-decoration: none;">Login/Signin</a></li>
                <?php
                  }
                ?>
            </ul>
        </div>

        <!-- Customer Support Section -->
        <div style="flex: 1; margin: 10px;">
            <h3 style="color: #f2f2f2;">Customer Support</h3>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="color: #f2f2f2; text-decoration: none;">Track Your Order</a></li>
                <li><a href="#" style="color: #f2f2f2; text-decoration: none;">Terms & Conditions</a></li>
                <li><a href="#" style="color: #f2f2f2; text-decoration: none;">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- Newsletter Subscription & Social Media -->
        <div style="flex: 1; margin: 10px;">
            <h3 style="color: #f2f2f2;">Stay Connected</h3>
            <p style="line-height: 1.6;">Subscribe to our newsletter for the latest updates and offers:</p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 20px; border-top: 1px solid #444; padding-top: 20px;">
        <p style="margin: 0;">&copy; 2024 Jambol. All Rights Reserved.</p>
    </div>
</footer>
