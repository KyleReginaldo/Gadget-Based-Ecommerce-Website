<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .rating-container{
			background-color: white;
			padding: 0.6rem 1rem;
			margin: 1rem 0;
			border-radius: 8px;
		}
		.rating-name{
			font-size: 1.4rem;
			margin: 0;
		}
		.rating-message{
			color: black;
			font-style: italic;
		}
		.stars{
			margin: 0;
			padding: 0;
		}
		.fa-star {
            font-size: 16px;
            color: #d3d3d3;
        }
        .fa-star.checked {
            color: #ffcc00;
        }
		.rating-title{
			display: flex;
			justify-content: space-between;
		}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var starContainers = document.querySelectorAll('.stars');
    starContainers.forEach(container => {
        var rating = parseInt(container.getAttribute('data-rating'), 10); // Get rating from data attribute
        var stars = container.querySelectorAll('.fa-star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('checked');
            } else {
                star.classList.remove('checked');
            }
        });
    });
});
</script>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
<?php include 'includes/navbar.php'; ?> 
    <div class="content-wrapper" style="margin-top: 4rem; padding-top: 2rem;">
        <div class="container">
            <h4>Ratings &#921; <span style="color: blue;"><?php echo $_GET['slug']?></span></h4>
            <?php
                function timeAgo($timestamp) {
                    $now = new DateTime();
                    $date = new DateTime($timestamp);
                    $interval = $now->diff($date);
                    if ($interval->y > 0) {
                        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                    } elseif ($interval->m > 0) {
                        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                    } elseif ($interval->d > 0) {
                        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                    } elseif ($interval->h > 0) {
                        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                    } elseif ($interval->i > 0) {
                        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                    } else {
                        return $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
                    }
                }
            	$conn = $pdo->open();
                $stmt = $conn->prepare("SELECT *, ratings.rating as rating, users.photo AS userPhoto FROM ratings INNER JOIN products ON ratings.product_id=products.id INNER JOIN users ON ratings.user_id=users.id WHERE products.slug=:slug ORDER BY created_at ASC");
	            $stmt->execute(['slug' => $_GET['slug']]);
                foreach ($stmt as $row) {
                    $image = (!empty($row['userPhoto'])) ? 'images/'.$row['userPhoto'] : 'images/profile.jpg';
                    echo "<div class='rating-container'>
                    <div style='display: flex;'>
                    <img src=".$image." width='64px' height='64px' style='object-fit: cover; border-radius: 8px; border: 2px solid lightgreen; margin-bottom: 1rem; margin-right: 1rem;'>
                        <div>
                            
                            <p class='rating-name'> " . htmlspecialchars($row['firstname']) . " ". htmlspecialchars($row['lastname']) . "</p>
                            <p class='rating-name'>". timeAgo($row['created_at']) ."</p>
                            <div class='stars' data-rating=" . htmlspecialchars($row['rating']) . ">
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                <span class='fa fa-star'></span>
                                (<span class='rating-value'>".$row['rating']."</span> out of 5)
                            </div>
                            <p class='rating-message'> " . htmlspecialchars($row['message']) . "</p>
                        </div>
                    </div>
                    </div>";
                }
            ?>
        </div>
    </div>
</div> 
<?php include 'includes/scripts.php'; ?>

</body>
</html>