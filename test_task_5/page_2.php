<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200;1,500&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .form{
            display: flex;
            width: 400px;
            background-color: antiquewhite;
            height: 400px;
            border-radius: 20px;
        }
        form{
            display:flex;
            margin: auto;
            justify-content: space-around;
            flex-direction: column;
            width: 250px;
            height: 350px;
        }
        input{
            border-radius: 10px;
            padding: 5px;
            font-family: 'Montserrat', sans-serif;
            font-size: large;
        }
        textarea{
            padding: 5px;
            height: 80px;
            border-radius: 10px;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>

    <div class="form">
        <form action="" method="post">
            <input type="hidden" name="intr_group" value="olgamooha2212@mail.com;group13@mail.ru;ira@test.ru">
            <input type="hidden" name="status" value="24374821">
            <input type="text" name="name" id="name" placeholder="Ваше имя">
            <input type="tel" name="phone" id="phone" placeholder="Телефон">
            <input type="email" name="mail" id="mail" placeholder="Почта">
            <textarea name="comment" id="comment" placeholder="Ваш комментарий"></textarea>
            <input type="submit" class="submit" name="submit" value="Отправить">
        </form>
    </div>

    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/introvert_save.php');
    ?>

    <script type="text/javascript">
        (function(d, w, k) {
            w.introvert_callback = function() {
                try {
                    w.II = new IntrovertIntegration(k);
                } catch (e) {console.log(e)}
            };

            var n = d.getElementsByTagName("script")[0],
                e = d.createElement("script");

            e.type = "text/javascript";
            e.async = true;
            e.src = "https://api.yadrocrm.ru/js/cache/"+ k +".js";
            n.parentNode.insertBefore(e, n);
        })(document, window, '3363f0c5');
</script>
</body>
</html>