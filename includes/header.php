<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductManage</title>
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css file -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- jquery link -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<nav class="header-menu navbar navbar-expand-lg navbar-light bg-success">

    <a class="navbar-brand" href="#">L-B</a>
    <button class="navbar-toggler" id="toggle-btn" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="menu collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="">Dashboard <span class="sr-only"></span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link " href="?page=manageproduct">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=categories">Categories</a>
            </li>
        </ul>
        <div class="logout-btn-div">
                <button id="logout-btn" type="button" class="btn btn-default btn-sm logout-btn">
                    <span><i class="fa fa-sign-out" aria-hidden="true"></i></span> Log out
                </button>
        </div>
        
    </div>
</nav>

<body>