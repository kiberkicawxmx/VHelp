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
                    <?php

$client_id = ID приложения;
$client_secret = 'Секретный ключ';
$redirect_uri = 'http://название сайта/profile.php';

$url = 'http://oauth.vk.com/authorize';

$params = [ 'client_id' => $client_id, 'redirect_uri'  => $redirect_uri, 'response_type' => 'code'];

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '" class="nav-link rounded-pill px-4 position-relative border text-white fw-bold" style="right: 10px; top: 10px;">Вход</a></p>';

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
            'fields' => 'uid,first_name,last_name,screen_name,city,sex,bdate,photo_big',
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
            'fields' => 'uid,members_count,description,status,site',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userGroup = json_decode(file_get_contents('https://api.vk.com/method/groups.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userGroup['response'][0])) {
            $userGroup = $userGroup['response'][0];
            $resultGroup = true;
        }
    }
}

$_SESSION['id'] = $userInfo['id'];
?>
                    </form>
                </div>
              </nav>
        </header>
