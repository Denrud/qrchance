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
                          <li class="breadcrumb-item active"><a href="#">Добавить новую категорию</a></li>
                      </ol>
                  </nav>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Добавить новую категорию</h4>
                <p class="card-description">После изменения данных, пожалуйста, не забудьте сохранить все изменения.</p>
                <?php

                // модуль добавление новой категории в БД
                if (isset($_POST['category']) && isset($_POST['description'])) {
                     $sql = "INSERT INTO `categories` (`id`, `title`, `description`, `image`)
                     VALUES (NULL, '".$_POST['category']."', '".$_POST['description']."', '');";
                     if ($conn->query($sql)) {
                         ?>
                         <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/products.php"><h4>Успех! Нажмите кнопку, чтобы вернуться к таблице «Все продукты»</h4></a><br><br>
                         <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/add/add_new_product.php"><h4>Нажмите, чтобы добавить продукт</h4></a><br><br>
                         <?php
                         // header('Location: products.php');
                         // header('Refresh: 1; url=http://e-shop.local/admin/products.php');
                     } else {
                         echo "<h4 class=\"badge badge-warning text-wrap\">error </h4>";
                     }
                 }
                ?>
                <form class="forms-sample"  method="post">
                    <div class="form-group">
                        <label for="editTitle">Имя категории</label>
                        <input type="text" name="category" class="form-control" id="add-category" placeholder="example - phone">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание категории</label>
                        <textarea class="form-control" id="description" name="description" rows="4" ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                </form>

              </div>
              <div class="card-body">
                <h4 class="card-title">Таблица всех категорий</h4>
                <table class="table table-dark table-responsive">
                  <thead>
                    <tr>
                      <th class="col" style="width: 5% "> # </th>
                      <th class="col" style="width: 5%"> Id_категории </th>
                      <th class="col" style="width: 30%"> Имя категории </th>
                      <th class="col" style="width: 10%"> Опции </th>
                      <th class="col"> Описание </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      if (isset($_GET['delete?id'])){ // проверка существования переменной GET запроса
                          $sql_del = "DELETE FROM `categories` WHERE `categories`.`id` = ".$_GET['delete?id']." ";
                          if ($conn->query($sql_del)) { //логический оператор проверки результата работы запроса в БД
                              ?>
                              <a class="badge badge-success text-wrap" style="width: auto;" href="#"><h4>Успех!</h4></a><br><br>
                              <?php
                          } else {
                              echo "<h4 class=\"badge badge-warning text-wrap\">error</h4>";
                          }
                      }
                      $sql = "SELECT * FROM `categories`"; // запрос в БД
                      $result = $conn->query($sql); // переменная с отправкой запрома в БД
                      $num = 0;
                      while ($row = mysqli_fetch_assoc($result)) {
                          $num++; // number of category in column "#"
                          ?>
                          <tr>
                               <td> <?php echo $num; ?> </td>
                               <td> <?php echo $row['id'];?> </td>
                               <td> <?php echo $row['title'];?> </td>
                               <td>
                                   <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/edit/edit_category.php?id=<?php echo $row['id']; // кнопка для редактирования товара ?>">редактировать</a>
                                       <br><br>
                                   <a class="badge badge-primary text-wrap" style="width: 6rem;" href="add_new_category.php?delete?id=<?php echo $row['id']; ?>">удалить</a>
                               </td>
                               <td><?php echo $row['description'] ?></td>
                         </tr>
                          <?php
                      }
                       ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
