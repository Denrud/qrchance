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
          <?php
          if (isset($_GET['id'])) {
          $sql = "SELECT * FROM orders WHERE orders.order_id = ". $_GET['id']; // получаем ID заказа
          $res = $conn->query($sql);
          if ($order = mysqli_fetch_assoc($res)) {
              ?>
              <div class="card col-12 ml-2">
                <div class="card-body">
                  <h4 class="card-title">Order #ID: <?php echo $_GET['id']; ?> </h4>
                  <table class="table table-striped table-responsive">
                    <thead>
                      <tr style="text-align: center;">
                          <th class="col" style="width: 5%"> # </th>
                          <th class="col"> Название </th>
                          <th class="col"> Цена </th>
                          <th class="col"> Количество </th>
                          <th class="col"> Опции </th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $get_product = json_decode($order['products'], true);
                            $num = 0;
                            for ($i = 0; $i < count($get_product['cart_cookie']); $i++) { // цикл для выбора значений из cookie
                                $num++; // number of products in column "#" (снова пробовал на английском)
                                $sql_2 = "SELECT * FROM products WHERE id=" . $get_product['cart_cookie'][$i]['product_id'];
                                $result = $conn->query($sql_2); // соединение с БД
                                $db_data = mysqli_fetch_assoc($result); // результат запроса в массиве
                                ?>
                            <tr>
                                <td style="text-align: center;">
                                     <?php echo $num; // добавляем П/Н ?>
                                </td>
                                <td>
                                     <?php echo $db_data['title']; // вывод из БД тайтл товара?>
                                </td>
                                <td style="white-space: nowrap;">
                                      <?php echo "$ " . $db_data['price']; // вывод из БД цены товара?>
                                  </td>
                                 <td class="d-flex justify-content-center">
                                         <span style="cursor: s-resize;" onclick="editPdMinQuantity(<?php echo $db_data['id']; ?>)">-&nbsp;</span>
                                         <p id="pd_id_<?php echo $db_data['id'];  ?>">
                                             <?php echo $get_product['cart_cookie'][$i]['count']; // вывод из БД количестква заказаных товаров ?>
                                         </p>
                                         <span style="cursor: n-resize;" onclick="editPdQuantity(<?php echo $db_data['id']; ?>)">&nbsp;+</span>
                                 </td>
                                 <td>
                                     <a class="badge badge-primary text-white" onclick="cartPdDelete(this, <?php echo $db_data['id']; ?>)" text-wrap style="width: 6rem;">удалить
                                     </a>
                                 </td>
                           </tr>
                            <?php
                                    } // for ($i = 0; $i < count($get_product['cart_cookie']); $i++)
                                } // if ($order = mysqli_fetch_assoc($res))
                            } // if (isset($_GET['id']))
                            ?>
                    </tbody>
                  </table>
                </div>
              </div>

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.php -->
<?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
