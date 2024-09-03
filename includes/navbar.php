<header class="main-header" style="position:fixed; width:100%;">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><img src="images/logo.png" alt="" width="48px"></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
      <!-- <?php
      if(isset($_SESSION['user'])){
        if($user['addressId']){
          echo '<div class="address-nav" style="background-color: white; max-width: 55%; box-sizing: content-box; padding: 0.4rem 1rem; border-radius: 4px; margin-top: 1rem; display: flex;">
          <a href="user_address.php" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%;">
              '.$user["region"].', '.$user["province"].', '.$user["city"].', '.$user["baranggay"].', '.$user["street"].'
          </a>
      </div>';
      }
    }
        ?> -->
        <ul class="nav navbar-nav">
          <li><a href="index.php#">Home</a></li>
          <?php
          if(isset($_SESSION['user'])){
            echo "<li><a href='orders.php?status=Pending'>Orders</a></li>";
          }
          ?>      
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){
                    echo "
                      <li><a href='category.php?category=".$row['id']."'>".$row['name']."</a></li>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();

              ?>
            </ul>
          </li>
          <li><a href="index.php#about">About Us</a></li> 
          <li><a href="index.php#contactus">Contact Us</a></li> 
        </ul>
        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <a href="orders.php?status=Pending" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-bag"></i>
              <span class="label label-success order_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="order_count"></span> order(s)</li>
              <li>
                <ul class="menu" id="order_menu">
                </ul>
              </li>
              <li class="footer"><a href="orders.php?status=Pending">Go to Order</a></li>
            </ul>
          </li>
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['user'])){
              $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image" style="object-fit: cover;">
                    <span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header" style="background-color: #1229ff">
                      <img src="'.$image.'" class="img-circle" alt="User Image" style="object-fit: cover;">

                      <p>
                        '.$user['firstname'].' '.$user['lastname'].'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li><a href='login.php'>Login/Signin</a></li><br>
              ";
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>