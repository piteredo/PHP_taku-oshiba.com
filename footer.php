<footer class="footer">
  <nav class="footer__nav">
    <ul>
      <div class="footer__sns-icons">
        <li class="footer__sns-icon"><a href="<?=TWITTER_URL?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <li class="footer__sns-icon"><a href="<?=INSTAGRAM_URL?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <li class="footer__sns-icon"><a href="<?=YOUTUBE_URL?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
        <li class="footer__sns-icon"><a href="<?=FACEBOOK_URL?>" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
        <li class="footer__sns-icon"><a href="<?=GITHUB_URL?>" target="_blank"><i class="fab fa-github"></i></a></li>
      </div>
      <li class="footer__nav-label"><a href="<?=$root.BIOGRAPHY_PAGE_PATH?>"><?=BIOGRAPHY_JA?></a></li>
      <li class="footer__nav-label"><a href="<?=$root.SCHEDULE_PAGE_PATH?>"><?=SCHEDULE_JA?></a></li>
      <li class="footer__nav-label"><a href="<?=INSTAGRAM_URL?>" target="_blank"><?=DESIGN_JA?> <i class="fas fa-external-link-alt"></i></a></li>
      <li class="footer__nav-label"><a href="<?=YOUTUBE_URL?>" target="_blank"><?=VIDEO_JA?> <i class="fas fa-external-link-alt"></i></a></li>
      <li class="footer__nav-label"><a href="<?=$root.BLOG_PAGE_PATH?>"><?=BLOG_JA?></a></li>
      <li class="footer__nav-label"><a href="<?=$root.LESSON_PAGE_PATH?>"><?=LESSON_JA?></a></li>
      <li class="footer__nav-label"><a href="<?=$root.DISCOGRAPHY_PAGE_PATH?>"><?=DISCOGRAPHY_JA?></a></li>
      <li class="footer__nav-label"><a href="<?='mailto:'.EMAIL_ADDRESS.'?subject='.EMAIL_SUBJECT?>"><?=CONTACT_JA?> <i class="fas fa-external-link-alt"></i></a></li>
      <li class="footer__nav-label"><a href="<?=$root?>"><?=INDEX_JA?></a></li>
    </ul>
  </nav>
  <small class="footer__copyright">
    <?='2006-'.date('Y').COPYRIGHT?>
  </small>
</footer>
</body>
</html>
