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
                      <li class="breadcrumb-item active"><a href="#">Изменить пользователя </a></li>
                      <?php
                      // модуль для вывода в хдебных крошках названия выбраного товара
                      $sql = "SELECT * FROM `user_account`"; // запрос в БД
                      $result_user = $conn->query($sql); // переменная с отправкой запрома в БД
                      while ($row_user = mysqli_fetch_assoc($result_user) ) {// цикл с воводом результата из БД
                          if (isset($_GET['id']) && $_GET['id'] == $row_user['user_id'] ) { // логическая операция для вывода выбраной категории в хлебных крошках
                              ?>
                              <li class="breadcrumb-item text-uppercase active"><a href="#"><?php echo $row_user['user_name'];
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
                <h4 class="card-title">Форма изменения информации про пользователя</h4>
                <p class="card-description">После изменения данных, пожалуйста, не забудьте сохранить все изменени.</p>
            <?php

            // inresrt edited product to DB
            if (isset($_POST['user_name']) && isset($_POST['city']) && isset($_POST['adress']) && isset($_POST['email']) && isset($_POST['phone']) ) {
                $sql_4 = "UPDATE user_account SET user_name = '".$_POST['user_name']."', city = '".$_POST['city']."',
                adress = '".$_POST['adress']."', email = '".$_POST['email']."', phone = '".$_POST['phone']."' WHERE user_account.user_id =" . $_GET['id'];

                if ($conn->query($sql_4)) {
                    ?>
                    <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/users.php"><h4>Success! Click thet button for back to All users table</h4></a><br><br>
                    <?php
                } else {
                    echo "<h1 class=\"badge badge-warning text-wrap\">error</h1>";
                }
            }
        // edit product information
         if (isset($_GET["id"]) ) {//логический оператор если cуществует product_id
            $sql = "SELECT * FROM user_account WHERE user_id = ".$_GET['id']." ";
            $result = $conn->query($sql);
            while ($row_ed = mysqli_fetch_assoc($result)) {
                ?>

                <form class="forms-sample" method="post">
                  <div class="form-group">
                    <label for="editUserName">Имя пользователя</label>
                    <input type="text" name="user_name" class="form-control" id="editUserName" value="<?php echo $row_ed['user_name']; //select product tilte?>">
                  </div>
                  <div class="form-group">
                    <label for="price">Изменить город</label>
                    <input type="text" name="city" class="form-control" id="city" value="<?php echo $row_ed['city']; //select produsct price ?>">
                  </div>
                  <div class="form-group">
                    <label for="deliveryAdress">Изменить адрес доставки</label>
                    <input type="text" name="adress" class="form-control" id="deliveryAdress" value="<?php echo $row_ed['adress']; // select product in stock status?>">
                  </div>
                  <div class="form-group">
                    <label for="userEmail">Изменить email</label>
                    <input type="text" name="email" class="form-control" id="userEmail" value="<?php echo $row_ed['email']; // select product in stock status?>">
                  </div>
                  <div class="form-group">
                    <label for="userPhone">Изменить телефон</label>
                    <input type="text" name="phone" class="form-control" id="userPhone" value="<?php echo $row_ed['phone']; // select product in stock status?>">
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
