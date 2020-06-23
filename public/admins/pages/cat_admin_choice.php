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
                            <li class="breadcrumb-item  active" ><a href="/admin">Главная</a></li>
                            <li class="breadcrumb-item"><a href="#">Категории</a></li>
                            <?php
                            // модуль для вывода в хлебных крошках выбраной категории
                            $sql_cat = "SELECT * FROM `categories`"; // запрос в БД
                            $result_cat = $conn->query($sql_cat); // переменная с отправкой запрома в БД
                            while ($row_cat = mysqli_fetch_assoc($result_cat) ) {// цикл с воводом результата из БД
                                if (isset($_GET['id']) && $_GET['id'] == $row_cat['id'] ) { // логическая операция для вывода выбраной категории в хлебных крошках
                                    ?>
                                    <li class="breadcrumb-item text-uppercase active"><a href="/admin/pages/cat_admin_choice.php?id=<?php echo $row_cat['id']; ?>"><?php echo $row_cat['title'];
                                    // вывод названия категории из БД?></a></li>
                                    <?php
                                }
                            }
                                    ?>
                        </ol>
                    </nav>
                </div>
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Таблица отфильтрованных категорий</h4>
                <table class="table table-dark table-responsive">
                  <thead>
                    <tr>
                      <th class="col"> # </th>
                      <th class="col"> Название </th>
                      <th class="col"> Опции </th>
                      <th class="col"> Цена продажи </th>
                      <th class="col"> Статус на скаде </th>
                      <th class="col"> Id продукта </th>
                      <th class="col"> Категории </th>
                      <th class="col"> Id категории </th>
                      <th class="col"> Описание </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      // модуль удаления продуктов из БД (админ панель)
                      if (isset($_GET['delete?id'])) { // проверка существования переменной GET запроса
                          $sql_del = "DELETE FROM `products` WHERE `products`.`id` = ".$_GET['delete?id']." "; //запрос на удаление в БД
                          if ($conn->query($sql_del)) { //логический оператор проверки результата работы запроса в БД
                              ?>
                              <a class="badge badge-success text-wrap" style="width: auto;" href="products.php"><h4>Успех! Нажмите кнопку, чтобы принять новые данные в таблице продуктов</h4></a><br><br>
                              <?php
                          } else {
                              echo "<h4 class=\"badge badge-warning text-wrap\">error</h4>";
                          }
                      } //if (isset($_GET['delete?id'])) --- end ---
                      // модуль вывода товаров из БД в таблицу (админ панель)
                      // модуль для фильтрации выбора товараов по категории
                      $sql = "SELECT * FROM `products` WHERE `category_id` = ".$_GET['id']." "; // запрос в БД
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
                               <td><?php echo $row['description'] // вывод короткого описания товара из БД ?></td>
                         </tr>
                          <?php
                      } //while ($row = mysqli_fetch_assoc($result)) { // цикл с воводом результата из БД --- end ---
                       ?>
                      </tbody>
                  </table>
              </div>
          </div>
  <!-- content-wrapper ends -->
          </div>

<!-- partial:partials/_footer.php -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
