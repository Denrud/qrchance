<?php include $_SERVER['DOCUMENT_ROOT'] . "/db_config/connect.php"; ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_header.php"; // подключение header  ?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_navbar.php"; // подключение навигационной панели (горизонтальная панель) ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_sidebar.php"; // подключение боковой панели меню админки  ?>
        <!-- partial:partials/_sidebar.html end-->
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              <div class="d-xl-flex align-items-center">
                <h2 class="text-dark font-weight-bold mb-2 mr-2"> Обзорная панель </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item  active" aria-current="page"><a href="/admin">Главная</a></li>
                            <li class="breadcrumb-item active"><a href="#">Все пользователи</a></li>
                        </ol>
                    </nav>
                </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Таблица зарегистрированных пользователей</h4>
              <table class="table table-dark table-responsive">
                <thead>
                  <tr>
                    <th class="col" style="width: 5% "> # </th>
                    <th class="col"> Имя </th>
                    <th class="col" style="width: 5% "> ID пользователя </th>
                    <th class="col"> Опции </th>
                    <th class="col"> Город </th>
                    <th class="col"> Адрес доставки </th>
                    <th class="col"> Email </th>
                    <th class="col"> Телефон </th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    // модуль удаления продуктов из БД (админ панель)
                    if (isset($_GET['delete?id'])) { // проверка существования переменной GET запроса
                        $sql_del = "DELETE FROM `user_account` WHERE `user_account`.`user_id` = ".$_GET['delete?id']." "; //запрос на удаление в БД
                        if ($conn->query($sql_del)) { //логический оператор проверки результата работы запроса в БД
                            ?>
                            <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/users.php"><h4>Успех!</h4></a><br><br>
                            <?php
                        } else {
                            echo "<h4 class=\"badge badge-warning text-wrap\">error</h4>";
                        }
                    } //if (isset($_GET['delete?id'])) --- end ---
                    // модуль вывода товаров из БД в таблицу (админ панель)
                    $sql = "SELECT * FROM `user_account`"; // запрос в БД
                    $result = $conn->query($sql); // переменная с отправкой запрома в БД
                    $num = 0;
                    while ($row = mysqli_fetch_assoc($result)) { // цикл с воводом результата из БД
                        $num++; // number of products in column "#" (снова пробовал на английском)
                        ?>
                        <tr>
                             <td> <?php echo $num; // добавляем П/Н ?> </td>
                             <td> <?php echo $row['user_name']; // вывод из БД тайтл товара?> </td>
                             <td> <?php echo $row['user_id']; // вывод из БД тайтл товара?> </td>
                             <td>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/edit/edit_user.php?id=<?php echo $row['user_id']; // кнопка для редактирования товара ?>">редактировать</a>
                                     <br><br>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/users.php?delete?id=<?php echo $row['user_id']; // кнопка для удаления товара ?>">удалить</a>
                             </td>
                             <td> <?php echo $row['city']; // вывод id товара из БД ?>  </td>
                             <td> <?php echo $row['adress']; // вывод названия категории из БД ?> </td>
                             <td> <?php echo $row['email']; // вывод id категории из БД ?> </td>
                             <td><?php echo $row['phone'] // вывод короткого описания товара из БД ?></td>
                       </tr>
                        <?php
                    } //while ($row = mysqli_fetch_assoc($result)) { // цикл с воводом результата из БД --- end ---
                     ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.php -->
          <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
