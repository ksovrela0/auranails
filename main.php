<html lang="en">
   <head>
      <style data-styles="">ion-icon{visibility:hidden}.hydrated{visibility:inherit}</style>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
      <meta name="description" content="Dashlead -  Admin Panel HTML Dashboard Template">
      <meta name="author" content="Spruko Technologies Private Limited">
      <meta name="keywords" content="sales dashboard, admin dashboard, bootstrap 4 admin template, html admin template, admin panel design, admin panel design, bootstrap 4 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">
      <!-- Favicon --> 
      <link rel="icon" href="assets/img/brand/favicon.ico" type="image/x-icon">
      <!-- Title --> 
      <title>სატესტო ობიექტი - Iten.ge CONTROL PANEL</title>
      <!---Fontawesome css--> 
      <?php include('includes/functions.php'); ?>
      <meta http-equiv="imagetoolbar" content="no">

      <style type="text/css" media="print">
         <!-- body{display:none} -->
      </style>
      <!--[if gte IE 5]>
      <frame>
      </frame><![endif]--><script src="https://www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/ionicons.suuqn5vt.js" type="module" crossorigin="true" data-resources-url="https://www.spruko.com/demo/dashlead/assets/plugins/ionicons/ionicons/" data-namespace="ionicons"></script>
      <style type="text/css">/* Chart.js */
         @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
      </style>
   </head>
   <body>
      
      <?php include('includes/switcher.php'); ?>
      <!-- End Switcher --> <!-- Loader --> 
      <div id="global-loader" style="display: none;"> <img src="assets/img/loader.svg" class="loader-img" alt="Loader"> </div>
      <!-- End Loader --> <!-- Page --> 
      <div class="page">
         <!-- Sidemenu --> 
         <?php include('includes/menu.php'); ?>
         <!-- End Sidemenu --> <!-- Main Content--> 
         <div class="main-content side-content pt-0">
            <!-- Main Header--> 
            <?php include('includes/header.php'); ?>
            <!-- End Main Header--> 
            <div class="container-fluid">
               <!-- Page Header --> 
               <div class="page-header">
                  <div>
                     <h2 class="main-content-title tx-24 mg-b-5">მოგესალმებით, Admin</h2>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">მთავარი</a></li>
                        <li class="breadcrumb-item active" aria-current="page">სწრაფი სტატისტიკა</li>
                     </ol>
                  </div>
                  
               </div>
               <!-- End Page Header --> <!--Navbar--> 
               <div class="responsive-background">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <div class="advanced-search">
                        <div class="row align-items-center">
                           <div class="col-md-4">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group mb-lg-0">
                                       <label class="">From :</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend">
                                             <div class="input-group-text"> <i class="fe fe-calendar lh--9 op-6"></i> </div>
                                          </div>
                                          <input class="form-control fc-datepicker hasDatepicker" placeholder="11/01/2019" type="text" id="dp1612271925264"> 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group mb-lg-0">
                                       <label class="">To :</label> 
                                       <div class="input-group">
                                          <div class="input-group-prepend">
                                             <div class="input-group-text"> <i class="fe fe-calendar lh--9 op-6"></i> </div>
                                          </div>
                                          <input class="form-control fc-datepicker hasDatepicker" placeholder="11/08/2019" type="text" id="dp1612271925265"> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group mb-lg-0">
                                 <label class="">Sales By Country :</label> 
                                 <select class="form-control select2-flag-search select2-hidden-accessible" data-placeholder="Select Contry" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="AF" data-select2-id="3">Afghanistan</option>
                                    <option value="AL">Albania</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AU">Australia</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AO">Angola</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BN">Brunei</option>
                                    <option value="BO">Bolivia</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BY">Belarus</option>
                                    <option value="CD">Congo</option>
                                    <option value="CA">Canada</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="CI">Cote d'Ivoire</option>
                                    <option value="CL">Chile</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CN">China</option>
                                    <option value="CO">Colombia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CV">Cabo Verde</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FI">Finland</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FR">France</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GE">Georgia</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GH">Ghana</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HU">Hungary</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IL">Israel</option>
                                    <option value="IN">India</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IR">Iran</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JO">Jordan</option>
                                    <option value="JP">Japan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="LA">Laos</option>
                                    <option value="LB">Lebanons</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LY">Libya</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MD">Moldova</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MK">Macedonia (FYROM)</option>
                                    <option value="ML">Mali</option>
                                    <option value="MM">Myanmar (formerly Burma)</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MT">Malta</option>
                                    <option value="MV">Maldives</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MX">Mexico</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NO">Norway</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="OM">Oman</option>
                                    <option value="PA">Panama</option>
                                    <option value="PF">Paraguay</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PL">Poland</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russia</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SE">Sweden</option>
                                    <option value="SG">Singapore</option>
                                    <option value="TG">Togo</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TW">Taiwan</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UM">United States of America</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VA">Vatican City (Holy See)</option>
                                    <option value="VE">Venezuela</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                 </select>
                                 <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-kr70-container"><span class="select2-selection__rendered" id="select2-kr70-container" role="textbox" aria-readonly="true" title="Afghanistan"><span><img src="assets/plugins/flag-icon-css/flags/4x3/af.svg" class="img-flag"> Afghanistan</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> 
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group mb-lg-0">
                                 <label class="">Products :</label> 
                                 <select multiple="multiple" class="group-filter ms-offscreen" style="">
                                    <optgroup label="Mens">
                                       <option value="1">Foot wear</option>
                                       <option value="2">Top wear</option>
                                       <option value="3">Bootom wear</option>
                                       <option value="4">Men's Groming</option>
                                       <option value="5">Accessories</option>
                                    </optgroup>
                                    <optgroup label="Women">
                                       <option value="1">Western wear</option>
                                       <option value="2">Foot wear</option>
                                       <option value="3">Top wear</option>
                                       <option value="4">Bootom wear</option>
                                       <option value="5">Beuty Groming</option>
                                       <option value="6">Accessories</option>
                                       <option value="7">Jewellery</option>
                                    </optgroup>
                                    <optgroup label="Baby &amp; Kids">
                                       <option value="1">Boys clothing</option>
                                       <option value="2">Girls Clothing</option>
                                       <option value="3">Toys</option>
                                       <option value="4">Baby Care</option>
                                       <option value="5">Kids footwear</option>
                                    </optgroup>
                                 </select>
                                 <div class="ms-parent group-filter" title="" style="width: 100%;">
                                    <button type="button" class="ms-choice">
                                       <span class="placeholder">Select here</span>
                                       <div class="icon-caret"></div>
                                    </button>
                                    <div class="ms-drop bottom" style="">
                                       <div class="ms-search">
                                          <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="">
                                       </div>
                                       <ul>
                                          <li class="ms-select-all">
                                             <label>
                                             <input type="checkbox" data-name="selectAll">
                                             <span>[Select all]</span>
                                             </label>
                                          </li>
                                          <li class="group ">
                                             <label class="optgroup">
                                             <input type="checkbox" data-name="selectGroup" data-key="group_0">Mens
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="1" data-key="option_0_0" data-name="selectItem">
                                             <span>Foot wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="2" data-key="option_0_1" data-name="selectItem">
                                             <span>Top wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="3" data-key="option_0_2" data-name="selectItem">
                                             <span>Bootom wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="4" data-key="option_0_3" data-name="selectItem">
                                             <span>Men's Groming</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="5" data-key="option_0_4" data-name="selectItem">
                                             <span>Accessories</span>
                                             </label>
                                          </li>
                                          <li class="group ">
                                             <label class="optgroup">
                                             <input type="checkbox" data-name="selectGroup" data-key="group_1">Women
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="1" data-key="option_1_0" data-name="selectItem">
                                             <span>Western wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="2" data-key="option_1_1" data-name="selectItem">
                                             <span>Foot wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="3" data-key="option_1_2" data-name="selectItem">
                                             <span>Top wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="4" data-key="option_1_3" data-name="selectItem">
                                             <span>Bootom wear</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="5" data-key="option_1_4" data-name="selectItem">
                                             <span>Beuty Groming</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="6" data-key="option_1_5" data-name="selectItem">
                                             <span>Accessories</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="7" data-key="option_1_6" data-name="selectItem">
                                             <span>Jewellery</span>
                                             </label>
                                          </li>
                                          <li class="group ">
                                             <label class="optgroup">
                                             <input type="checkbox" data-name="selectGroup" data-key="group_2">Baby &amp; Kids
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="1" data-key="option_2_0" data-name="selectItem">
                                             <span>Boys clothing</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="2" data-key="option_2_1" data-name="selectItem">
                                             <span>Girls Clothing</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="3" data-key="option_2_2" data-name="selectItem">
                                             <span>Toys</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="4" data-key="option_2_3" data-name="selectItem">
                                             <span>Baby Care</span>
                                             </label>
                                          </li>
                                          <li class="multiple ">
                                             <label class="">
                                             <input type="checkbox" value="5" data-key="option_2_4" data-name="selectItem">
                                             <span>Kids footwear</span>
                                             </label>
                                          </li>
                                          <li class="ms-no-results">No matches found</li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-group mb-lg-0">
                                 <label class="">Sales Type :</label> 
                                 <select multiple="multiple" class="multi-select ms-offscreen" style="">
                                    <option value="1">Online</option>
                                    <option value="2">Offline</option>
                                    <option value="3">Reseller</option>
                                 </select>
                                 <div class="ms-parent multi-select" title="" style="width: 100%;">
                                    <button type="button" class="ms-choice">
                                       <span class="placeholder">Select here</span>
                                       <div class="icon-caret"></div>
                                    </button>
                                    <div class="ms-drop bottom" style="">
                                       <ul>
                                          <li class="ms-select-all">
                                             <label>
                                             <input type="checkbox" data-name="selectAll">
                                             <span>[Select all]</span>
                                             </label>
                                          </li>
                                          <li class=" ">
                                             <label class="">
                                             <input type="checkbox" value="1" data-key="option_0" data-name="selectItem">
                                             <span>Online</span>
                                             </label>
                                          </li>
                                          <li class=" ">
                                             <label class="">
                                             <input type="checkbox" value="2" data-key="option_1" data-name="selectItem">
                                             <span>Offline</span>
                                             </label>
                                          </li>
                                          <li class=" ">
                                             <label class="">
                                             <input type="checkbox" value="3" data-key="option_2" data-name="selectItem">
                                             <span>Reseller</span>
                                             </label>
                                          </li>
                                          <li class="ms-no-results">No matches found</li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="text-right"> <a href="#" class="btn btn-primary" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Apply</a> <a href="#" class="btn btn-secondary" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Reset</a> </div>
                     </div>
                  </div>
               </div>
               <!--End Navbar --> <!-- Row --> 
               <div class="row row-sm">
                  <div class="col-sm-6 col-xl-3 col-lg-6">
                     <div class="card custom-card">
                        <div class="card-body dash1">
                           <div class="d-flex">
                              <p class="mb-1 tx-inverse">გაყიდვების რაოდენობა</p>
                              <div class="ml-auto"> <i class="fas fa-chart-line fs-20 text-primary"></i> </div>
                           </div>
                           <div>
                              <h3 class="dash-25">8</h3>
                           </div>
                           <div class="progress mb-1">
                              <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-70p" role="progressbar"></div>
                           </div>
                           <div class="expansion-label d-flex"> <span class="text-muted">ამ თვეში</span> <span class="ml-auto"><i class="fas fa-caret-up mr-1 text-success"></i>0.7%</span> </div>
                        </div>
                     </div>
                  </div>
                  <?php
                     if($group_id == 3){
                        $word = 'მიტანების';
                     }
                     else if($group_id == 1){
                        $word = 'შეკვეთების';
                     }
                  ?>
                  <div class="col-sm-6 col-xl-3 col-lg-6">
                     <div class="card custom-card">
                        <div class="card-body dash1">
                           <div class="d-flex">
                              <p class="mb-1 tx-inverse">შესრულებული <?php echo $word; ?> რ-ბა</p>
                              <div class="ml-auto"> <i class="fab fa-rev fs-20 text-secondary"></i> </div>
                           </div>
                           <div>
                              <h3 class="dash-25">27</h3>
                           </div>
                           <div class="progress mb-1">
                              <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-60p bg-secondary" role="progressbar"></div>
                           </div>
                           <div class="expansion-label d-flex"> <span class="text-muted">ამ თვეში</span> <span class="ml-auto"><i class="fas fa-caret-down mr-1 text-danger"></i>0.43%</span> </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-xl-3 col-lg-6">
                     <div class="card custom-card">
                        <div class="card-body dash1">
                           <div class="d-flex">
                              <p class="mb-1 tx-inverse">შემოსავალი</p>
                              <div class="ml-auto"> <i class="fas fa-dollar-sign fs-20 text-success"></i> </div>
                           </div>
                           <div>
                              <h3 class="dash-25">489 GEL</h3>
                           </div>
                           <div class="progress mb-1">
                              <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-50p bg-success" role="progressbar"></div>
                           </div>
                           <div class="expansion-label d-flex text-muted"> <span class="text-muted">ამ თვეში</span> <span class="ml-auto"><i class="fas fa-caret-down mr-1 text-danger"></i>1.44%</span> </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-xl-3 col-lg-6">
                     <div class="card custom-card">
                        <div class="card-body dash1">
                           <div class="d-flex">
                              <p class="mb-1 tx-inverse">წინა თვესთან შედარებით</p>
                              <div class="ml-auto"> <i class="fas fa-signal fs-20 text-info"></i> </div>
                           </div>
                           <div>
                              <h3 class="dash-25" style="color: #2ee82b;">+215 GEL</h3>
                           </div>
                           <div class="progress mb-1">
                              <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" class="progress-bar progress-bar-xs wd-40p bg-info" role="progressbar"></div>
                           </div>
                           <div class="expansion-label d-flex text-muted"> <span class="text-muted">ამ თვეში</span> <span class="ml-auto"><i class="fas fa-caret-up mr-1 text-success"></i>0.9%</span> </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <!-- End Row --> <!-- Row--> 
               <div class="row">
                  <div class="col-sm-12 col-xl-12 col-lg-12">
                     <div class="card custom-card">
                        <div class="card-body">
                           <div>
                              <h6 class="card-title mb-1">გაყიდული პროდუქციის სტატისტიკა</h6>
                              <p class="text-muted card-sub-title">*ობიექტისთვის</p>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-bordered text-nowrap mb-0">
                                 <thead>
                                    <tr>
                                       <th>#No</th>
                                       <th>პროდ.დასახელება</th>
                                       <th>პროდ.კატეგორია</th>
                                       <th>პროდ.ფასი</th>
                                       <th>გაყიდვეების რაოდენობა</th>
                                       <th>საერთო ჯამი</th>
                                       <th>შეუსრ.შეკვეთები</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>1</td>
                                       <td>იმერული ხაჭაპური</td>
                                       <td>ცომეული</td>
                                       <td>15 GEL</td>
                                       <td>100</td>
                                       <td>1500 GEL</td>
                                       <td>15</td>
                                    </tr>
                                    <tr>
                                       <td>2</td>
                                       <td>ხინკალი</td>
                                       <td>ხინკალი</td>
                                       <td>1 GEL</td>
                                       <td>1000</td>
                                       <td>1000 GEL</td>
                                       <td>10</td>
                                    </tr>
                                    <tr>
                                       <td>3</td>
                                       <td>პიცა მარგარიტა</td>
                                       <td>პიცა</td>
                                       <td>10 GEL</td>
                                       <td>500</td>
                                       <td>5000 GEL</td>
                                       <td>19</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12 col-xl-12 col-lg-12">
                     <div class="card custom-card">
                        <div class="card-body">
                           <div>
                              <h6 class="card-title mb-1">კურიერის სტატისტიკა</h6>
                              <p class="text-muted card-sub-title">*ობიექტისთვის</p>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-bordered text-nowrap mb-0">
                                 <thead>
                                    <tr>
                                       <th>#No</th>
                                       <th>სახელი</th>
                                       <th>გვარი</th>
                                       <th>შესრულებული შეკვეთა</th>
                                       <th>შეუსრულებელი შეკვეთა</th>
                                       <th>მიტანის საშუალო დრო</th>
                                       <th>ხშირად მიტანილი პროდუქტი</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>1</td>
                                       <td>გიგი</td>
                                       <td>ანთიძე</td>
                                       <td>15</td>
                                       <td>0</td>
                                       <td>5 წუთი</td>
                                       <td>პიცა</td>
                                    </tr>
                                    <tr>
                                       <td>2</td>
                                       <td>ნინი</td>
                                       <td>ჭყონია</td>
                                       <td>10</td>
                                       <td>2</td>
                                       <td>10 წუთი</td>
                                       <td>ხინკალი</td>
                                    </tr>
                                    <tr>
                                       <td>3</td>
                                       <td>საბა</td>
                                       <td>შონია</td>
                                       <td>5</td>
                                       <td>1</td>
                                       <td>15 წუთი</td>
                                       <td>ხაჭაპური</td>
                                    </tr>
                                    <tr>
                                       <td>4</td>
                                       <td>ნიკა</td>
                                       <td>ქარდავა</td>
                                       <td>2</td>
                                       <td>0</td>
                                       <td>20 წუთი</td>
                                       <td>კანჭი</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- End Row --> 
            </div>
         </div>
         <!-- End Main Content--> <!-- Sidebar --> 
         <div class="sidebar sidebar-right sidebar-animate">
            <div class="sidebar-icon"> <a href="#" class="text-right float-right text-dark fs-20" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a> </div>
            <div class="sidebar-body">
               <h5>Todo</h5>
               <div class="d-flex p-2"> <label class="ckbox"><input checked="" type="checkbox"><span>Hangout With friends</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input checked="" type="checkbox"><span>System Updated</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input type="checkbox"><span>Do something more</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input type="checkbox"><span>System Updated</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top"> <label class="ckbox"><input type="checkbox"><span>Find an Idea</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <div class="d-flex p-2 border-top mb-4 border-bottom"> <label class="ckbox"><input type="checkbox"><span>Project review</span></label> <span class="ml-auto"> <i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i> <i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i> </span> </div>
               <h5>Overview</h5>
               <div class="p-2">
                  <div class="main-traffic-detail-item">
                     <div> <span>Founder &amp; CEO</span> <span>24</span> </div>
                     <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" class="progress-bar progress-bar-xs wd-20p" role="progressbar"></div>
                     </div>
                     <!-- progress --> 
                  </div>
                  <div class="main-traffic-detail-item">
                     <div> <span>UX Designer</span> <span>1</span> </div>
                     <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="15" class="progress-bar progress-bar-xs bg-secondary wd-15p" role="progressbar"></div>
                     </div>
                     <!-- progress --> 
                  </div>
                  <div class="main-traffic-detail-item">
                     <div> <span>Recruitment</span> <span>87</span> </div>
                     <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" class="progress-bar progress-bar-xs bg-success wd-45p" role="progressbar"></div>
                     </div>
                     <!-- progress --> 
                  </div>
                  <div class="main-traffic-detail-item">
                     <div> <span>Software Engineer</span> <span>32</span> </div>
                     <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-info wd-25p" role="progressbar"></div>
                     </div>
                     <!-- progress --> 
                  </div>
                  <div class="main-traffic-detail-item">
                     <div> <span>Project Manager</span> <span>32</span> </div>
                     <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-danger wd-25p" role="progressbar"></div>
                     </div>
                     <!-- progress --> 
                  </div>
               </div>
            </div>
         </div>
         <!-- End Sidebar --> <!-- Main Footer--> 
         <div class="main-footer text-center">
            <div class="container">
               <div class="row">
                  <div class="col-md-12"> <span>Copyright © 2021 <a href="#">ITEN.GE</a>.</span> </div>
               </div>
            </div>
         </div>
         <!--End Footer--> 
      </div>
      <!-- End Page --> <!-- Back-to-top --> <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a> <!-- Jquery js--> 
      
      <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
      <div class="main-navbar-backdrop"></div>
   </body>
</html>