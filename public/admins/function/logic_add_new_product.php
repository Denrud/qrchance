 <div class="card-body">
   <h4 class="card-title">Форма добавления ноовй продукции</h4>
   <p class="card-description">После изменения данных, пожалуйста, не забудьте сохранить все изменения.</p>
   <?php
   // модуль добавление новоно продукта в БД (админ панель)
   if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['in_stock']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['content'])) { // логический оператор проверят существование переменных POSt запросов
       if($_POST['category'] != "no name category" ) { // логический оператор проверки переменной POST запроса
           $sql_3 = "SELECT `id` FROM `categories` WHERE `title` = '".$_POST['category']."' "; // зпрос в БД
           $res = $conn->query($sql_3); // результат запроса в БД
           while ($row_id = mysqli_fetch_assoc($res)) { // получение результата запроса в БД
               $sql = "INSERT INTO `products` (`id`, `title`, `description`, `content`, `price`, `status`, `category`, `category_id`, `image`)
               VALUES (NULL, '".$_POST['title']."', '".$_POST['description']."', '".$_POST['content']."', '".$_POST['price']."', '".$_POST['in_stock']."', '".$_POST['category']."', '".$row_id['id']."', '')"; // запрос в БД для добавления новых товаров и всех данных в POST перменных
                if ($conn->query($sql)) { // логический оператор, проверка результат работы запроса в БД
                    ?>
                    <a class="badge badge-success text-wrap" style="width: auto;" href="/admin/pages/products.php"><h4>Успех! Нажмите кнопку, чтобы вернуться к таблице «Все продукты»</h4></a><br><br>
                    <?php
                } else { // в случае ошибки -> вывод ошибки
                    echo "<h4 class=\"badge badge-warning text-wrap\">error</h4>";
                }
            } // while ($row_id = mysqli_fetch_assoc($res)) {
       }
       else { // в случае ошибки -> вывод ошибки
           echo "<h4 class=\"badge badge-warning text-wrap\">error category isn't selected</h4>";
       } // if($_POST['category'])
   } // if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['in_stock']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['content']))
    ?>
   <form class="forms-sample"  method="post">
       <div class="form-group">
           <label for="select-tilte">Выберите категорию или добавьте новую <a class="badge badge-primary text-wrap" style="width: 10rem;" href="/admin/pages/add/add_new_category.php">Добавить новую категорию</a></label>
           <select class="form-control" name="category" id="category" >
               <option value="no name category" default>категория не выбрана</option>
             <?php
             // select all categories from `categories` table (пробовал писать на английском )) прикольно выглядит!)
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
           <label for="editTitle">Название товара</label>
           <input type="text" name="title" class="form-control" id="editTitle" placeholder="Бумага">
       </div>
       <div class="form-group">
           <label for="price">Установить новую цену</label>
           <input type="text" name="price" class="form-control" id="price" placeholder="999.00">
       </div>
       <div class="form-group">
           <label for="in_stock">Установить количество на складе</label>
           <input type="text" name="in_stock" class="form-control" id="in_stock" placeholder="999"  >
       </div>
       <div class="form-group">
           <label for="description">Описание товара</label>
           <textarea class="form-control" id="description" name="description" rows="4" ></textarea>
       </div>
           <div class="form-group">
           <label for="content">Полное описание товара</label>
           <textarea class="form-control" id="content" name="content" rows="4"></textarea>
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
 </div> <!--- <div class="card-body"> end --->
