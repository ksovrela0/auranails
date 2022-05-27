<?php
include('../db.php');
GLOBAL $db;

$db = new dbClass();
$user_gr = $_SESSION['GRPID'];
?>
<div class="main-sidebar main-sidebar-sticky side-menu ps">
    <div class="sidemenu-logo"> <a class="main-logo" href="index.php"> <img src="assets/img/brand/logo.png" class="header-brand-img desktop-logo" alt="logo"> <img src="assets/img/brand/icon.png" class="header-brand-img icon-logo" alt="logo"> <img src="assets/img/brand/logo-light.png" class="header-brand-img desktop-logo theme-logo" alt="logo"> <img src="assets/img/brand/icon-light.png" class="header-brand-img icon-logo theme-logo" alt="logo"> </a> </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <?php
                $menu_li;
                $db->setQuery(" SELECT 		menu_detail.id,
                                            menu_detail.icon,
                                            menu_detail.name,
                                            menu_detail.url

                                FROM 		menu_detail
                                JOIN 		group_pages ON group_pages.page_id = menu_detail.id

                                WHERE 		menu_detail.actived = 1 AND group_pages.group_id = '$user_gr'
                                ORDER BY 	menu_detail.position ASC");
                $menu = $db->getResultArray();
                foreach($menu['result'] AS $item){
                    if($item[url] == '#'){
                        $menu_li .= '<li class="nav-label">'.$item[name].'</li>';
                    }
                    else{
                        $menu_li .= '<li class="nav-item"> <a class="nav-link" href="index.php?page='.$item[url].'">'.$item[icon].'<span class="sidemenu-label">'.$item[name].'</span></a> </li>';
                    }
                }
                echo $menu_li;
            ?>
            
            
        </ul>
    </div>
    <div class="ps__rail-x" style="left: 0px; top: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</div>