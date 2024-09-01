<style>
.form-body{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.form-body input{
    padding: 0.6rem 1rem;
    width: 100%;
    border-radius: 8px;
    outline: none;
    border: 1px solid blue;
}
.rating-title{
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0;
    letter-spacing: 1px;
}
.star-rating {
    display: flex;
  	flex-direction: row-reverse;
  	justify-content: start;
    font-size: 0;
}

.star-rating input[type="radio"] {
    display: none;
}

.star-rating label {
    font-size: 30px;
    color: #ccc;
    cursor: pointer;
}

.star-rating label:before {
    content: "\2605";
}

.star-rating input[type="radio"]:checked ~ label {
    color: #ffcc00;
}
.submit-now{
    width: 100%;
    background-color: blue;
    border-radius: 8px;
    height: 4rem;   
    margin-top: 1rem;
    color: white;
    border: none;
}
</style>
<!-- <script>
$(function() {
    $(document).on('submit', '.form-body', function() {
        var rating = $(this).prev('input[type="radio"]').val();
        var item_id = 36; 
        var user_id = 14; 
        var data = $(this).data("id");

        $.ajax({
            url: 'submit_rating.php',
            method: 'POST',
            data: { item_id: data, user_id: user_id, rating: rating },
            success: function(response) {
                $('.rating-result').html(response);
                
            }
        });
    });
});
</script> -->
<?php
$conn = $pdo->open();
$userId = $_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    try{ 		
        $stmt = $conn->prepare("SELECT rating FROM products WHERE id=:product_id");
        $stmt->execute(['product_id'=>$_SESSION['product_id']]);
        $product = $stmt->fetch();
        $stmt = $conn->prepare("INSERT INTO ratings(user_id, product_id, rating, message) VALUES(:user_id,:product_id,:rating,:message)");
        $stmt->execute(['user_id'=>$userId,'product_id'=>$_SESSION['product_id'],'rating'=>$rating ,"message"=>$_POST['comment']]);
        if($product['rating'] == 0){
            $stmt = $conn->prepare("UPDATE products SET rating=:rating WHERE id=:id");
            $stmt->execute(['id'=>$_SESSION['product_id'],'rating'=>$rating]);
        }else{
            $newRating = ($rating + $product['rating']) / 2;
            $stmt = $conn->prepare("UPDATE products SET rating=:rating WHERE id=:id");
            $stmt->execute(['id'=>$_SESSION['product_id'],'rating'=>$newRating]);
        }
           
    }
    catch(PDOException $e){
    }
}
$pdo->close();
?>
<div class="modal fade rating-modal" id="rating" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="" class="form-body" method="post">
            <p class="rating-title">Give us your rating</p>
            <p>Your rating will help us know and improve our quality of service.</p>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
            </div>
            <input type="text" placeholder="Enter your comment here..." name="comment">
            <button type="submit" class="submit-now">Submit Now</button>
        </form>
      </div>
    </div>
  </div>
</div>