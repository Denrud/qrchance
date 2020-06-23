<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin">
        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
        <span class="menu-title">Главная</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="icon-bg"><i class="mdi mdi-format-list-bulleted-type menu-icon"></i></span>
        <span class="menu-title">Категории</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/pages/add/add_new_category.php">Добавить новую категорию</a></li>
            <?php
            // $sql_cat = "SELECT * FROM `categories`"; // запрос в БД
            // $result_cat = $conn->query($sql_cat); // переменная с отправкой запроcа в БД
            // while ($row_cat = mysqli_fetch_assoc($result_cat) ) {// цикл с воводом результата из БД
                // if (isset($_GET['id']) && $_GET['id'] == $row_cat['id'] ) { // логическая операция для добавления класса active выбраной ссылке из пункта меню
                    ?>
                    <!-- <li class="nav-item"> <a class="nav-link text-uppercase active"  href="/admin/pages/cat_admin_choice.php?id=<?php // echo $row_cat['id']; ?>"><?php //echo $row_cat['title']; // вывод названия категории из БД?></a> </li> -->
                    <?php
                // } else {
                    ?>
                    <!-- <li class="nav-item"> <a class="nav-link text-uppercase"  href="/admin/pages/cat_admin_choice.php?id=<?php //echo $row_cat['id']; ?>"><?php // echo $row_cat['title']; // вывод названия категории из БД?></a> </li> -->
                    <?php
                // }
            // }
            ?>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="icon-bg"><i class="mdi mdi-barcode-scan menu-icon"></i></span>
        <span class="menu-title">Продукция</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/pages/products.php">Все продукты</a></li>
            <li class="nav-item"> <a class="nav-link" href="/admin/pages/add/add_new_product.php">Добавить новый продукт</a></li>
        </ul>
      </div>
    </li>
    <!--- реализовать дополнительные категории
            //  раздел пользователи (users) +
                    -   закладка все пользователи +
                        -   вывести список пользователей
                функционал
                    -   удаление пользователей
                    -   редактирование полей
            //  раздел заказы
                    -   закладка все заказы +
                    -   заказы по категориям + **
                функционал
                    -   удаление заказов
                    -   реадктирование заказа
                --->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#userCall" aria-expanded="false" aria-controls="userCall">
        <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
        <span class="menu-title">Пользователь</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="userCall">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/pages/users.php">Все пользователи</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#orderCall" aria-expanded="false" aria-controls="orderCall">
        <span class="icon-bg"><i class="mdi mdi-basket-fill menu-icon"></i></span>
        <span class="menu-title">Заказы</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="orderCall">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/admin/pages/order/orders.php">Все заказы</a></li>
        </ul>
      </div>
    </li>

    <br>
    <li class="nav-item sidebar-user-actions ">
      <div class="sidebar-user-menu">
        <a href="/" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
          <span class="menu-title">Перейти на сайт</span></a>
      </div>
    </li>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
  </ul>

</nav>
