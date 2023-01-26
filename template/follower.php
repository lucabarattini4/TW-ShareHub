<h1><?php echo $templateParams["tipo"]; ?></h1>

<?php foreach($templateParams["lista"] as $lista): ?>

<h2><a href="./profilo.php?user=<?php echo $lista["username"]; ?>"><?php echo $lista["username"]; ?></a></h2>

<?php endforeach; ?>