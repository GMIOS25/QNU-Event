<!DOCTYPE html>
<html lang="en">
<head>
        <base href="<?php global $publicBase; echo $publicBase; ?>/" />
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assest/css/header.css">
    <link rel="stylesheet" href="assest/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8f5e4d2946.js" crossorigin="anonymous"></script>
    <title><?php echo $title  ?></title>
    <link rel="stylesheet" href="assest/css/layout.css">
    

</head>

<body>
    <header>
        <?php include __DIR__ . "/partials/header.php" ?>
    </header>
    <div class="main">
        <div class="menubars">
            <?php include __DIR__ . "/partials/menubar.php" ?>
        </div>
        <div class="app">
            <?php include $render ?>
        </div>
    </div>
    <footer>
        <?php include __DIR__ . "/partials/footer.php" ?>
    </footer>
</body>
<?php 
    if(isset($message))
    {
        echo '<script>
        alert("'.$message.'");
    </script>';
    }

?>
</html>
