<?php
include 'includes/session.php';
$conn = $pdo->open();
$output = '';
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
$limit = 2;
$offset = 0;
try{
    $stmt = $conn->prepare("SELECT *, ratings.rating as rating FROM ratings INNER JOIN products ON ratings.product_id=products.id INNER JOIN users ON ratings.user_id=users.id WHERE products.slug=:slug ORDER BY created_at ASC LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); 
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    foreach ($stmt as $row) {
        $output .= '<div class="rating-container">
                ' . timeAgo($row['created_at']) . '
                <p class="rating-name">' . htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']) . '</p>
                <div class="stars" data-rating="' . htmlspecialchars($row['rating']) . '">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
                <p class="rating-message">' . htmlspecialchars($row['message']) . '</p>
            </div>';
    }   
}
catch(PDOException $e){
   $output = "There is some problem in connection: " . $e->getMessage();
}
$pdo->close()
echo json_encode($output);
?>
