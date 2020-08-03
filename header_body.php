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
      <label id="hamburger-menu__content" for="hamburger-menu__check-box">
      <ul>
        <!--<li class="header__nav-label"><a href="https://taku-oshiba.com/taku-oshiba-quartet2020/">大柴拓カルテットツアー2020春 詳細</a></li>-->
        <li class="header__nav-label"><a href="<?=$root.BIOGRAPHY_PAGE_PATH?>"><?=BIOGRAPHY_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.SCHEDULE_PAGE_PATH?>"><?=SCHEDULE_EN?></a></li>
        <li class="header__nav-label"><a href="<?=INSTAGRAM_URL?>" target="_blank"><?=DESIGN_EN?> <i class="fas fa-external-link-alt"></i></a></li>
        <li class="header__nav-label"><a href="<?=YOUTUBE_URL?>" target="_blank"><?=VIDEO_EN?> <i class="fas fa-external-link-alt"></i></a></li>
        <li class="header__nav-label"><a href="<?=$root.BLOG_PAGE_PATH?>"><?=BLOG_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.LESSON_PAGE_PATH?>"><?=LESSON_EN?></a></li>
        <li class="header__nav-label"><a href="<?=$root.DISCOGRAPHY_PAGE_PATH?>"><?=DISCOGRAPHY_EN?></a></li>
        <li class="header__nav-label"><a href="<?='mailto:'.EMAIL_ADDRESS.'?subject='.EMAIL_SUBJECT?>"><?=CONTACT_EN?> <i class="fas fa-external-link-alt"></i></a></li>
        <div class="header__sns-icons">
          <li class="header__sns-icon"><a href="<?=TWITTER_URL?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li class="header__sns-icon"><a href="<?=INSTAGRAM_URL?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li class="header__sns-icon"><a href="<?=YOUTUBE_URL?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
          <li class="header__sns-icon"><a href="<?=FACEBOOK_URL?>" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
          <li class="header__sns-icon"><a href="<?=GITHUB_URL?>" target="_blank"><i class="fab fa-github"></i></a></li>
        </div>
      </ul>
      </label>
    </nav>
  </header>
