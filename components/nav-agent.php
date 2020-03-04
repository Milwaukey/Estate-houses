<div class="burger_menu">Menu</div>

<a href="index"><img class="logo" src="images/icons/estate_houses.svg"></a>
<nav class="close">
    <a <?=($sActive=='profile')?'class="active_menu"':'';?> href="profile-agent">Profile</a>
    <a <?=($sActive=='my_properties')?'class="active_menu"':'';?> href="my-properties-agent">My properties</a>
    <a <?=($sActive=='add_properties')?'class="active_menu"':'';?> href="add-property-agent">Add new property</a>
    <a href="api/api-logout.php">Logout</a>
</nav>

<div class="menu_wrapper"></div>


