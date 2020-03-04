<?php $sPageTitle = 'Search - Estate Houses'; $sActive = 'search'; require_once(__DIR__ . '/components/top.php'); require_once(__DIR__ . '/components/nav.php'); ?>



<div id="search_container">


<h1>Find your <span>dream</span> house</h1>

<div class="search_wrapper">
<form id="frmSearch">
    <input name="txtSearch" id="txtSearch" type="text" placeholder="Search for zip here ...">
</form>

<div id="results">

</div>
</div>

<div class="overlay"></div>
<div id="background_image_search"></div>

</div>



<?php $sLinkToScript = '<script src="js/search.js"></script>'; require_once(__DIR__ . '/components/bottom.php'); ?>

