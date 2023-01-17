<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-Digital</title>
    <link rel="stylesheet" href="/css/libs/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    
    <a class="navbar-brand collapse navbar-collapse" href="/">Task List</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="nav-link disabled"><?php if ($data['isAuth']) echo 'Привет, '.htmlspecialchars($data['login']); ?></div>
        </li>
    </ul>
    <div>
        <a class="navbar-brand collapse navbar-collapse" href="/auth">
            <?php 
                if ($data['isAuth']) 
                    echo "Выйти"; 
                else 
                    echo "Войти"; 
            ?>
        </a>
    </div>
</nav>

<?php include 'application/views/'.$content_view; ?>  
</body>
</html>