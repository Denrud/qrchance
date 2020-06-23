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
                            <li class="breadcrumb-item active"><a href="#">Все продукты</a></li>
                        </ol>
                    </nav>
                </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Таблица продуктов</h4>
              <table class="table table-dark table-responsive">
                <thead>
                  <tr>
                    <th class="col"> # </th>
                    <th class="col"> Название </th>
                    <th class="col"> Опиции </th>
                    <th class="col"> Цена </th>
                    <th class="col"> Статус на скаде </th>
                    <th class="col"> Id продукта </th>
                    <th class="col"> Категория </th>
                    <th class="col"> Id категори </th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    // модуль удаления продуктов из БД (админ панель)
                    if (isset($_GET['delete?id'])) { // проверка существования переменной GET запроса
                        $sql_del = "DELETE FROM `products` WHERE `products`.`id` = ".$_GET['delete?id']." "; //запрос на удаление в БД
                        if ($conn->query($sql_del)) { //логический оператор проверки результата работы запроса в БД
                            ?>
                            <a class="badge badge-success text-wrap" style="width: auto;" href="products.php"><h4>Success! Click thet button for acept new data in products table</h4></a><br><br>
                            <?php
                        } else {
                            echo "<h4 class=\"badge badge-warning text-wrap\">error</h4>";
                        }
                    } //if (isset($_GET['delete?id'])) --- end ---
                    // модуль вывода товаров из БД в таблицу (админ панель)
                    $sql = "SELECT * FROM `products`"; // запрос в БД
                    $result = $conn->query($sql); // переменная с отправкой запрома в БД
                    $num = 0;
                    while ($row = mysqli_fetch_assoc($result)) { // цикл с воводом результата из БД
                        $status  = null; // variable for change color in column "status in stock"
                        $num++; // number of products in column "#" (снова пробовал на английском)
                        if ($row["status"] == 0) { // логический оператор проверки переменной если true = цвет зелёный
                            $status = "text-danger"; // color red
                        }
                        else { // логический оператор проверки переменной если false = цвет красный
                            $status = "text-success"; // color green
                        }
                        ?>
                        <tr>
                             <td> <?php echo $num; // добавляем П/Н ?> </td>
                             <td> <?php echo $row['title']; // вывод из БД тайтл товара?> </td>
                             <td>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/edit/edit.php?id=<?php echo $row['id']; // кнопка для редактирования товара ?>">редактировать</a>
                                     <br><br>
                                 <a class="badge badge-primary text-wrap" style="width: 6rem;" href="products.php?delete?id=<?php echo $row['id']; // кнопка для удаления товара ?>">удалить</a>
                             </td>
                             <td> <?php echo "$ " . $row['price']; // вывод из БД цены товара?> </td>
                             <td class="<?php echo $status; // меняем цвет с помощью логического оператора if ($row["status"] == 0) ?>"><?php echo $row['status']; // вывод наличие товара из БД ?></td>
                             <td> <?php echo $row['id']; // вывод id товара из БД ?>  </td>
                             <td> <?php echo $row['category']; // вывод названия категории из БД ?> </td>
                             <td> <?php echo $row['category_id']; // вывод id категории из БД ?> </td>
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
