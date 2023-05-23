<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Public/asset/style/style.css">
    <title>Connexion</title>
</head>
<body>
    <form action="" method="post">
        <h1>Se connecter</h1>
        <label for="mail">Saisir votre mail :</label>
        <input type="email" name="mail">
        <label for="mdp">Saisir votre mot de passe :</label>
        <input type="password" name="mdp">
        <input type="submit" value="Connexion" name="submit">
        <div id="msgzone"><?=$msg?></div>
    </form>
</body>
</html>