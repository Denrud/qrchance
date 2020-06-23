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
                            <li class="breadcrumb-item active"><a href="#">Все заказы</a></li>
                        </ol>
                    </nav>
                </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Таблицы заказов</h4>
              <table class="table table-dark table-responsive">
                <thead>
                  <tr>
                    <th class="col" style="width: 5%;"> # </th>
                    <th class="col" style="width: 5%;"> Id заказа </th>
                    <th class="col" style="width: 5%;"> Сумма $ </th>
                    <th class="col" style="width: 10%;"> Статус </th>
                    <th class="col" style="width: 10%;"> Опции </th>
                    <th class="col" style="width: 10%;"> Заказано </th>
                    <th class="col" style="width: 10%;"> Город </th>
                    <th class="col" style="width: 15%;"> Адрес доставки </th>
                    <th class="col" style="width: 15%;"> Email </th>
                    <th class="col"> Телефон </th>

                  </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['accept'])) {
                        $sql = "UPDATE `orders` SET `order_status` = '1' WHERE `orders`.`order_id` =" . $_GET['id'];
                        if ($conn->query($sql) ) {
                            ?>
                            <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/order/orders.php"><h4>Успех! Нажмите кнопку, чтобы принять новый статус в таблице заказов.</h4></a><br><br>
                     <?php
                        }
                    }
                    // модуль вывода заказов из БД в таблицу (админ панель)
                    $sql = "SELECT * FROM `orders`,`user_account` WHERE orders.user_id = user_account.user_id"; // запрос в БД
                    $result = $conn->query($sql); // переменная с отправкой запрома в БД
                    $num = 0;
                    while ($row = mysqli_fetch_assoc($result)) { // цикл с воводом результата из БД
                        $num++; // number of products in column "#" (снова пробовал на английском)
                        ?>
                        <tr>
                             <td> <?php echo $num; // добавляем П/Н ?> </td>
                             <td> <?php echo $row['order_id']; // вывод из БД ID товара?> </td>
                             <td> <?php echo $row['total']; // вывод из БД тайтл товара?> </td>
                             <td> <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/function/order_status.php" ?> </td>
                             <td>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/order/details.php?id=<?php echo $row['order_id']; // кнопка для редактирования ?>">детали</a>
                                     <br><br>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" title="Will you press accept button you confirm this order, and send all order data to delivery serevice" href="/admin/pages/order/orders.php?accept&id=<?php echo $row['order_id']; // кнопка для удаления ?>">принять</a>
                             </td>
                             <td> <?php echo $row['user_name']; // вывод из БД тайтл товара?> </td>
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
