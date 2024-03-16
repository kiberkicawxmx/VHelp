<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>VHelp</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./img/logo.svg">
    <script src="https://kit.fontawesome.com/a3e3eec57d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="wrapper">
        <header class="container-fluid header">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img class="bi me-2" width="40" height="32" src="./img/logo.svg" alt="">
                        <span class="text-white fw-bold">VHelp</span>
                    </a>
                    <form class="d-flex">
                        <a href="/" class="nav-link rounded-pill px-4 border text-white fw-bold">Выход</a>
                    </form>
                </div>
              </nav>
        </header>

    <div class="container profile p-4">
        <p class="fs-1 fw-bold text-center" style='color: #26297a;'>Управление группой</p>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                Выбрать группу
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item active" href="#">Действие</a></li>
                <li><a class="dropdown-item" href="#">Другое действие</a></li>
                <li><a class="dropdown-item" href="#">Что-то еще здесь</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Отделенная ссылка</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mt-3">
                    <label class="form-label text-white">Название</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mt-3">
                    <label class="form-label text-white">Описание</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="formFile" class="form-label text-white">Логотип группы</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <div class="mt-3">
                    <label class="form-label text-white">Короткое название группы</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-warning mt-5 ms-2 w-25 fw-bold fs-5">Применить</button>
        </div>
    </div>

<?php include 'footer.php'; ?>