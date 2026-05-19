<?php
$lb_id = !empty($_GET['lbid']) ? $_GET['lbid'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    

<?php
echo do_shortcode('[SQBLeaderboard id="'.$lb_id.'" optout="0"]');
print_embed_scripts();
wp_print_footer_scripts();
?>
</body>
</html>