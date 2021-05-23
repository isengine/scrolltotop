<?php

namespace is\Masters\Modules\Isengine\Scrolltotop;

use is\Helpers\System;
use is\Helpers\Objects;
use is\Helpers\Strings;

$instance = $object -> get('instance');
$sets = &$object -> settings;

// добавить в мастер модулей методы
// get
// get first value

$class = $object -> eget('container') -> classes;
$class = Strings::join($class);
$class = Strings::split($class);
$class = Objects::first($class, 'value');

$class_active = $sets['classes']['active'];
$class_active = Strings::join($class_active);
$class_active = Strings::split($class_active);
$class_active = Objects::first($class_active, 'value');

if (!$class || !$class_active) {
	return;
}

?>

<!-- Scroll to Top Button -->

<?php

$object -> eget('item') -> addContent($sets['label']);

$object -> eget('container') -> open(true);
$object -> eget('item') -> open(true);
$object -> eget('item') -> content(true);
$object -> eget('item') -> close(true);
$object -> eget('container') -> close(true);

?>

<script>
(function() {
  'use strict';

  function trackScroll() {
    var scrolled = window.pageYOffset;
    var coords = document.documentElement.clientHeight;

    if (scrolled > coords) {
      goTopBtn.classList.add('<?= $class_active; ?>');
    }
    if (scrolled < coords) {
      goTopBtn.classList.remove('<?= $class_active; ?>');
    }
  }

  function backToTop() {
    if (window.pageYOffset > 0) {
      //window.scrollBy(0, -80);
      //setTimeout(backToTop, 0);
	  window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      setTimeout(backToTop, 1000);
    }
  }

  var goTopBtn = document.querySelector('.<?= $class; ?>');

  window.addEventListener('scroll', trackScroll);
  goTopBtn.addEventListener('click', backToTop);
})();
</script>
