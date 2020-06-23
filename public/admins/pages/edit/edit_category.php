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
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Обзорная панель </h2>
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item  active" aria-current="page"><a href="/admin">Главная</a></li>
                      <li class="breadcrumb-item active"><a href="#">Изменить категорию</a></li>
                      <?php
                      // модуль для вывода в хлебных крошках названия выбранной категории
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
                <h4 class="card-title">Изменить категорию</h4>
                <p class="card-description">После изменения данных, пожалуйста, не забудьте сохранить все изменени.</p>
                <?php

                // модуль добавление новой категории в БД
                if (isset($_POST['category']) && isset($_POST['description'])) {
                     $sql = "UPDATE categories SET title = '".$_POST['category']."',
                     description = '".$_POST['description']."'
                     WHERE categories.id = ".$_GET['id']."";
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
                //
                if (isset($_GET["id"]) ) {//логический оператор если cуществует product_id
                   $sql = "SELECT * FROM `categories` WHERE `id` = ".$_GET['id']." ";
                   $result = $conn->query($sql);
                   while ($row_ed = mysqli_fetch_assoc($result)) {
                       ?>

                <form class="forms-sample"  method="post">
                    <div class="form-group">
                        <label for="editTitle">Имя категории</label>
                        <input type="text" name="category" class="form-control" id="add-category" value="<?php echo $row_ed['title']; //select product tilte?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание категории</label>
                        <textarea class="form-control" id="description" name="description" rows="4" ><?php echo $row_ed['description']; //select category description?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Загрузить картинку</label>
                        <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                      <input type="text" class="form-control file-upload-info" disabled placeholder="Загрузить картинку">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Загрузить</button>
                      </span>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                </form>
                <?php
                    } // while ($row_ed = mysqli_fetch_assoc($result))
                } //if (isset($_GET["id"]) ) {//логический оператор если cуществует product_id --- end ---
                 ?>

              </div>
              <div class="card-body">
                <h4 class="card-title">Таблица всех категорий</h4>
                <table class="table table-dark table-responsive">
                  <thead>
                    <tr>
                      <th class="col" style="width: 5% "> # </th>
                      <th class="col" style="width: 5%"> Id категории </th>
                      <th class="col" style="width: 30%"> имя категории </th>
                      <th class="col" style="width: 10%"> Опции </th>
                      <th class="col"> Описание </th>
                      <th class="col"> Картинка </th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      if (isset($_GET['delete?id'])){ // проверка существования переменной GET запроса
                          $sql_del = "DELETE FROM `categories` WHERE `categories`.`id` = ".$_GET['delete?id']." ";
                          if ($conn->query($sql_del)) { //логический оператор проверки результата работы запроса в БД
                              ?>
                              <a class="badge badge-success text-wrap" style="width: auto;" href="#"><h4>Success!</h4></a><br><br>
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
                                   <a class="badge badge-primary text-wrap" style="width: 6rem;" href="/admin/pages/edit/edit_category.php?id=<?php echo $row['id']; // кнопка для редактирования товара ?>">изменить</a>
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
          <!-- partial -->
