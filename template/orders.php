<a href="catalog">Вернуться в каталог товаров.</a>

<h1>Мои заказы</h1>

<?php if (isset($_SESSION['user'])) : ?>

  <?php if ($arrOrders == null) : ?>

    <p>У вас пока нет заказов</p>

  <?php else: ?>
    <ul>
      <?php foreach ($arrOrders as $value): ?>
        <li data-id_order="<?= $value['id_order'] ?>" class="cancelled" style="margin: 6px 0">
          Заказ №<?= $value['id_order'] ?> на сумму <b><?= $value['total'] ?> руб</b>, статус:
          <?php if ($value['status'] == 'new') : ?>
            <span class="status" style="font-weight: bold">новый</span><button
                style="margin-left: 12px">Отменить</button>
          <?php elseif ($value['status'] == 'cancelled'): ?>
            <span class="status" style="font-weight: bold">заказ отменен</span>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

<?php else: ?>
  <p>Эту страницу могу просматривать только зарегистрированные пользователи.</p>
<?php endif; ?>

<script>
  "use strict";

  $(function () {
    $('.cancelled').on('click', 'button', function () {
      let id_order = $(this).parent('li').data('id_order');
      $.ajax({
        url: "/orders/change_status",
        type: 'post',
        data: {
          id_order: id_order
        },
        success: (result) => {
          result = JSON.parse(result);
          if (result.success == 'ok') {
            $(this).parent('li').find('.status').html(result.message);
            $(this).parent('li').find('button').remove();
          }
        }
      });
    });
  });
</script>