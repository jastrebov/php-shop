<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/header.php');?>

<section>
    <div class="container">
        <div class="row">

            <h1>Кабинет пользователя</h1>

            <h3>Привет, <?php echo $user['name'];?>!</h3>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
                <li><a href="/cabinet/history">Список покупок</a></li>
                <li><a href="/admin">Админ панель</a></li>
            </ul>

        </div>
    </div>
</section>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/layouts/footer.php');?>
