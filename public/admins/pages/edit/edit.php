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
                      <li class="breadcrumb-item active"><a href="#">Форма редактирования продукции </a></li>
                      <?php
                      // модуль для вывода в хдебных крошках названия выбраного товара
                      $sql_prod = "SELECT * FROM `products`"; // запрос в БД
                      $result_prod = $conn->query($sql_prod); // переменная с отправкой запрома в БД
                      while ($row_prod = mysqli_fetch_assoc($result_prod) ) {// цикл с воводом результата из БД
                          if (isset($_GET['id']) && $_GET['id'] == $row_prod['id'] ) { // логическая операция для вывода выбраной категории в хлебных крошках
                              ?>
                              <li class="breadcrumb-item text-uppercase active"><a href="#"><?php echo $row_prod['title'];
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
                <h4 class="card-title">Редактирования продукции</h4>
                <p class="card-description">После изменения данных, пожалуйста, не забудьте сохранить все изменения.</p>
            <?php

            // inresrt edited product to DB
            if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['in_stock']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['content'])) {
                $sql_4 = "UPDATE products SET title = '".$_POST['title']."', description = '".$_POST['description']."',
                content = '".$_POST['content']."', price = ".$_POST['price'].", status = ".$_POST['in_stock'].",
                category = '".$_POST['category']."' WHERE products.id = ".$_GET['id']."";

                if ($conn->query($sql_4)) {
                    ?>
                    <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/products.php"><h4>Success! Click thet button for back to All products table</h4></a><br><br>
                    <?php
                    // header('Location: products.php');
                    // header('Refresh: 1; url=http://e-shop.local/admin/products.php');
                } else {
                    echo "<h1 class=\"badge badge-warning text-wrap\">error</h1>";
                }
            }
        // edit product information
         if (isset($_GET["id"]) ) {//логический оператор если cуществует product_id
            $sql = "SELECT * FROM products WHERE id = ".$_GET['id']." ";
            $result = $conn->query($sql);
            while ($row_ed = mysqli_fetch_assoc($result)) {
                ?>

                <form class="forms-sample" method="post">
                  <div class="form-group">
                    <label for="editTitle">Изменить название</label>
                    <input type="text" name="title" class="form-control" id="editTitle" value="<?php echo $row_ed['title']; //select product tilte?>">
                  </div>
                  <div class="form-group">
                    <label for="price">Изменить новую цену</label>
                    <input type="text" name="price" class="form-control" id="price" value="<?php echo $row_ed['price']; //select produsct price ?>">
                  </div>
                  <div class="form-group">
                    <label for="in_stock">Установить количество на складе</label>
                    <input type="text" name="in_stock" class="form-control" id="in_stock" value="<?php echo $row_ed['status']; // select product in stock status?>">
                  </div>
                  <div class="form-group">
                    <label for="category">Изменить категорию</label>
                    <select class="form-control" name="category" id="category" >
                        <option value="<?php echo $row_ed['category']; //add product default category ?>" selected><?php echo $row_ed['category']; // select defaulf product category ?><option>
                        <?php
                        // select all categories from `categories` table
                        $sql_2 = "SELECT * FROM `categories`";
                        $res = $conn->query($sql_2);
                        while ($rows = mysqli_fetch_assoc($res)) {
                                ?>
                                <option><?php echo $rows['title']; // get all categories ?></option>
                            <?php
                            }
                            ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">Изменить частичное описание</label>
                    <textarea class="form-control" id="description" name="description" rows="4" ><?php echo $row_ed['description']; // select product description ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="content">Изменить описание</label>
                    <textarea class="form-control" id="content" name="content" rows="4" ><?php echo $row_ed['content']; // select product main content ?></textarea>
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
            }
        }

        ?>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
          <!-- partial -->
