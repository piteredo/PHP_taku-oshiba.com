<body>
  <header class="header">

    <h1 class="header__title-text">
      <a href="<?=$root?>">
        <?=SITE_LOGO?>
      </a>
    </h1>

    <nav class="header__nav" id="hamburger-menu">
      <input id="hamburger-menu__check-box" type="checkbox" value="off">
      <label id="hamburger-menu__icon" for="hamburger-menu__check-box"><i class="fas fa-bars"></i></label>
      <label id="hamburger-menu__background" for="hamburger-menu__check-box"></label>
      <ul id="hamburger-menu__content">
        <li class="header__nav-label"><a href="<?=$root.BIOGRAPHY_PAGE_PATH?>"><?=BIOGRAPHY_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.SCHEDULE_PAGE_PATH?>"><?=SCHEDULE_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=DESIGN_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.VIDEO_PAGE_PATH?>"><?=VIDEO_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.BLOG_PAGE_PATH?>"><?=BLOG_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.LESSON_PAGE_PATH?>"><?=LESSON_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.DISCOGRAPHY_PAGE_PATH?>"><?=DISCOGRAPHY_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.CONTACT_PAGE_PATH?>"><?=CONTACT_EN?></a></li>
        <div class="header__sns-icons">
          <li class="header__sns-icon"><a href="<?=TWITTER_URL?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li class="header__sns-icon"><a href="<?=INSTAGRAM_URL?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li class="header__sns-icon"><a href="<?=FACEBOOK_URL?>" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
          <li class="header__sns-icon"><a href="<?=GITHUB_URL?>" target="_blank"><i class="fab fa-github"></i></a></li>
        </div>
      </ul>
    </nav>
  </header>
