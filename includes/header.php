<div class="main-header side-header sticky sticky-pin" style="margin-bottom: -64px;">
   <div class="container-fluid">
      <div class="main-header-left"> <a class="main-logo d-lg-none" href="index.html"> <img src="assets/img/brand/logo.jpg?v=1.2" class="header-brand-img desktop-logo" alt="logo"> <img src="assets/img/brand/icon.png" class="header-brand-img icon-logo" alt="logo"> <img src="assets/img/brand/logo-light.png" class="header-brand-img desktop-logo theme-logo" alt="logo"> <img src="assets/img/brand/icon-light.png" class="header-brand-img icon-logo theme-logo" alt="logo"> </a> <a class="main-header-menu-icon" href="" id="mainSidebarToggle"><span></span></a> </div>
      <div class="main-header-right">
      <?php
         /* $group_id = $_SESSION['GRPID'];
         if($group_id == 3){
            $db->setQuery("SELECT cash_balance,real_balance FROM users WHERE id = '$_SESSION[USERID]'");
            $balances = $db->getResultArray();
            $balances = $balances['result'][0];
            echo '<div class="dropdown d-md-flex"> <p style="margin:0!important;font-weight: 700;">ქეშ-ბალანასი: <span id="money_cash"> - '.$balances['cash_balance'].'</span></p>  </div>
                  <div class="dropdown d-md-flex" style="margin-left:10px;"> <p style="margin:0!important;font-weight: 700;">ბალანასი: <span id="money_card"> + '.$balances['real_balance'].'</span></p>  </div>';
         }
         if($group_id == 4){
            echo '<div class="dropdown d-md-flex" style="margin-left:10px;"> <p style="margin:0!important;font-weight: 700;">ბალანასი: <span id="money_card"> + 24.75</span></p>  </div>';
         } */
      ?>
         <?php 
            $apikey = '571c38c51589289fde4c41b5a2abaae4aaa051880832ccecfe230cbc1aac1d13';
            $url = 'https://api.gosms.ge/api/sms-balance';
            $fields = array(
               'api_key' => $apikey,
            );
            $fields_string = http_build_query($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            $data = json_decode($output, true);
         
         
         ?>
         <div class="dropdown d-md-flex" style="margin-left:10px;"> <p style="margin:0!important;font-weight: 700;">SMS ბალანასი: <span id="money_card"> <?php echo $data['balance']; ?></span></p>  </div>
         <div class="dropdown main-header-notification" style="display:none">
            <a class="nav-link icon" href=""> <i class="fe fe-bell"></i> <span class="pulse bg-danger"></span> </a> 
            <div class="dropdown-menu">
               <div class="header-navheading">
                  <p class="main-notification-text">You have 1 unread notification<span class="badge badge-pill badge-primary ml-3">View all</span></p>
               </div>
               <div class="main-notification-list">
                  <div class="media new">
                     <div class="main-img-user online"><img alt="avatar" src="assets/img/users/5.jpg"></div>
                     <div class="media-body">
                        <p>Congratulate <strong>Olivia James</strong> for New template start</p>
                        <span>Oct 15 12:32pm</span> 
                     </div>
                  </div>
                  <div class="media">
                     <div class="main-img-user"><img alt="avatar" src="assets/img/users/2.jpg"></div>
                     <div class="media-body">
                        <p><strong>Joshua Gray</strong> New Message Received</p>
                        <span>Oct 13 02:56am</span> 
                     </div>
                  </div>
                  <div class="media">
                     <div class="main-img-user online"><img alt="avatar" src="assets/img/users/3.jpg"></div>
                     <div class="media-body">
                        <p><strong>Elizabeth Lewis</strong> added new schedule realease</p>
                        <span>Oct 12 10:40pm</span> 
                     </div>
                  </div>
               </div>
               <div class="dropdown-footer"> <a href="">View All Notifications</a> </div>
            </div>
         </div>
         <div class="dropdown main-profile-menu">
            <a class="main-img-user" href=""><img alt="avatar" src="assets/img/users/1.jpg"></a> 
            <div class="dropdown-menu">
               
               <a class="dropdown-item" href="index.php?act=sign_out"> <i class="fe fe-power"></i> Sign Out </a> 
            </div>
         </div>
      </div>
   </div>
</div>