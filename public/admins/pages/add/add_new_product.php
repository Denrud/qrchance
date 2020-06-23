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
                            <li class="breadcrumb-item active"><a href="#">Добавить новый продукт</a></li>
                        </ol>
                    </nav>
                </div>
            <div class="card">
                <?php
                    include $_SERVER['DOCUMENT_ROOT'] . "/admin/function/logic_add_new_product.php"; // подключаем логический модуль с функционалом добавления и новых товаров и выбором категории
                ?>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/partials/_footer.php"; // подключение footer ?>
