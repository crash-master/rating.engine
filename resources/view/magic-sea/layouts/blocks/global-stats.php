<div class="block stats">
  <div class="block-icon"><i class="m-icon chart-bar"></i></div>
  <div class="block-title">Статистика сайта</div>
  <div class="block-body">
    <div class="row">
      <div class="col-lg-3">
        <div class="stat-name">Количество магов</div>
        <div class="circle" style="background-color: #00acc1"><?= $stats['count_profiles'] ?></div>
      </div>
      <div class="col-lg-3">
        <div class="stat-name">Количество отзывов</div>
        <div class="circle" style="background-color: #8e24aa"><?= $stats['count_reviews'] ?></div>
      </div>
      <div class="col-lg-3">
        <div class="stat-name">Количество переходов</div>
        <div class="circle" style="background-color: #e53935"><?= $stats['count_personal_site_visits'] ?></div>
      </div>
      <div class="col-lg-3">
        <div class="stat-name">Количество просмотров</div>
        <div class="circle" style="background-color: #43a047"><?= $stats['count_profile_views'] ?></div>
      </div>
    </div>
  </div>
</div>
