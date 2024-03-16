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

        <?php

$client_id = ID приложения;
$client_secret = 'Секретный ключ';
$redirect_uri = 'http://название сайта/profile.php';


if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri,
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,status,online,first_name,last_name,screen_name,city,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'filter' => 'admin,editor,moder',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userGroup = json_decode(file_get_contents('https://api.vk.com/method/groups.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userGroup['response'][0])) {
            $userGroup = $userGroup['response'][0];
            $resultGroup = true;
        }
    }

    $group = $userGroup["response"]["items"];
}
?>

<div class="container profile p-4">
        <div class="profile-info d-flex">
            <div class="row w-100">
                <div class="col-md-2">
                    <div class="profile-img">
                        <?php echo '<img src="' . $userInfo['photo_big'] . '" />'; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-stats ps-4">
                        <div class="profile-name d-flex align-items-center mt-2">
                            <p class="fs-6 fw-bold text-white">Имя: <span><?php echo $userInfo['first_name']; ?></span></p>
                        </div>
                        <div class="profile-id">
                            <p class="fs-6 fw-bold text-white">Ваш ID: <span><?php echo $userInfo['id']; ?></span></p>
                        </div>
                        <div class="profile-sex">
                            <p class="fs-6 fw-bold text-white">Ваш пол: <span>
                                <?php
                                    if ($userInfo['sex'] == 1) {
                                        echo 'Женский';
                                    } else {
                                        echo 'Мужской';
                                    }
                                ?>
                            </span></p>
                        </div>
                        <div class="profile-link">
                            <p class="fs-6 fw-bold text-white">Ссылка на профиль: <span><a class='text-decoration-none' style='color: #26297a' href="https://vk.com/<?php echo $userInfo['screen_name']; ?>">Перейти</a></span></p>
                        </div>
                        <div class="profile-email">
                            <p class="fs-6 fw-bold text-white">Дата рождения: <span><?php echo $userInfo['bdate']; ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-stats ps-4">
                        <div class="profile-name d-flex align-items-center mt-2">
                            <p class="fs-6 fw-bold text-white">Фамилия: <span><?php echo $userInfo['last_name']; ?></span></p>
                        </div>
                        <div class="profile-id">
                            <p class="fs-6 fw-bold text-white">Профиль: <span>
                                <?php
                                    if($userInfo['is_closed' == 'false']) {
                                        echo 'Закрыт';
                                    } else {
                                        echo 'Открыт';
                                    }
                                ?>
                            </span></p>
                        </div>
                        <div class="profile-name d-flex align-items-center mt-2">
                            <p class="fs-6 fw-bold text-white">Статус: <span><?php echo $userInfo['status']; ?></span></p>
                        </div>
                        <div class="profile-name d-flex align-items-center mt-2">
                            <p class="fs-6 fw-bold text-white">Онлайн: 
                                <span>
                                    <?php
                                        if($userInfo['online' == 0]) {
                                            echo 'Не в сети';
                                        } else {
                                            echo 'В сети';
                                        }
                                    ?> 
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style='padding-bottom: 100px;'>
    <div class="container profile p-4">
        <table class="table text-white text-center">
    <thead>
        <tr>
            <th scope="col">Логотип</th>
            <th scope="col">Название</th>
            <th scope="col">Статус</th>
            <th scope="col">Участники</th>
            <th scope="col">ID</th>
        </tr>
    </thead>
    <tbody>
    <?php
foreach ($group as $groupSend) {
    if (isset($_GET['code'])) {
        $result = true;
        $params = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $_GET['code'],
            'redirect_uri' => $redirect_uri,
        ];

        if (isset($token['access_token'])) {
            $params = [
                'uids' => $token['user_id'],
                'group_ids' => $groupSend,
                'group_id' => $groupSend,
                'fields' => 'uid,name,type,photo_50,screen_name,status,city,members_count',
                'access_token' => $token['access_token'],
                'v' => '5.101'];
            $userGroupInfo = json_decode(file_get_contents('https://api.vk.com/method/groups.getById' . '?' . urldecode(http_build_query($params))), true);
            if (isset($userGroupInfo['response'][0])) {
                $userGroupInfo = $userGroupInfo['response'][0];
                $resultGroupInfo = true;
            }
        }
    }
    echo '<tr>';
    echo '<th><img style="border-radius: 50%; width: 50px; height: 50px;" src="';
    echo $userGroupInfo["photo_50"];
    echo '"></th>';
    echo '<td style="position: relative; top: 10px;">';
    echo $userGroupInfo["name"];
    echo '</td>';
    echo '<td style="position: relative; top: 10px;">';
    echo $userGroupInfo["status"];
    echo '</td>';
    echo '<td style="position: relative; top: 10px;">';
    echo $userGroupInfo["members_count"];
    echo '</td>';
    echo '<td style="position: relative; top: 10px;">';
    echo $userGroupInfo["id"];
    echo '</td>';
}

        ?>
    </tbody>
    </table>
</div>
    </div>
<?php include 'footer.php'; ?>
