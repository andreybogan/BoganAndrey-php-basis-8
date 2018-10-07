<h1>Редактирование каталога товаров</h1>

<p><a href="/catalog">Вернуться в каталог товаров.</a></p>

<?php if (isset($_SESSION['user'])) : ?>

  <div class="catalog">

    <?php foreach ($arrCatalog as $value): ?>
      <div class="item">
        <?php if ($value['img'] != ''): ?>
          <img src="./images/small/<?= $value['img'] ?>" alt="">
        <?php else: ?>
          <div class="plug">Фото отсутствует</div>
        <?php endif; ?>
        <a href="admin/admin_one/<?= $value['id_prod'] ?>">
          <p><?= $value['name'] ?></p>
        </a>
        <p>Цена <?= $value['price'] ?> руб.</p>

        <?php if (isset($_SESSION['user'])) : ?>
          <form action="admin/admin_one/<?= $value['id_prod'] ?>" method="post" style="display: inline-block;">
            <input type="hidden" name="id_prod" value="<?= $value['id_prod'] ?>">
            <input type="submit" name="submitAddBasket" class="submit" value="Редактировать">
          </form>
          <?php if ($value['hide'] == 'see'): ?>
            <button data-id_prod="<?= $value['id_prod'] ?>" class="submit editHide">Скрыть</button>
          <?php else: ?>
            <button data-id_prod="<?= $value['id_prod'] ?>" class="submit editHide">Показать</button>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

  </div>

  <h2>Добавить новый товар</h2>

  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" style="margin: 36px 0">
    <label for="name">Название товара</label>
    <input type="text" name="prod[name]" id="name" value="<?= $arrProduct['name'] ?>" required>
    <label for="text">Описание товара</label>
    <textarea id="text" name="prod[text]" rows="8" required><?= $arrProduct['text'] ?></textarea>
    <label for="price">Цена</label>
    <input type="text" name="prod[price]" id="price" value="<?= $arrProduct['price'] ?>" required>
    <input type="submit" name="prod[submitAddProd]" class="submit" value="Добавить">
  </form>

<?php else: ?>
  <p>Эту страницу могу просматривать только зарегистрированные пользователи.</p>
<?php endif; ?>