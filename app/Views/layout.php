<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assest/css/header.css">
    <link rel="stylesheet" href="./assest/css/footer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php echo $title  ?></title>
    <link rel="stylesheet" href="./assest/css/layout.css">
</head>

<body>
    <header>
        <?php include __DIR__ . "/partials/header.php" ?>
    </header>
    <div class="main">
        <div class="menubars">
            <?php include __DIR__ . "/partials/header.php" ?>
        </div>
        <div class="app">
            <?php include $render ?>
        </div>
    </div>
    <footer>
        <?php include __DIR__ . "/partials/footer.php" ?>
    </footer>
</body>
</html>