<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Techbaze InfoCenter - Search <?php echo $siteName; ?></title>

    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/freelancer.css" rel="stylesheet">

	 <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/monthly.css">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-resource.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/scripts/searchto.js"></script>
</head>

<body id="page-top" class="index" ng-app="searchAppto">

    <!-- Header -->
     <!-- Header -->
    <div ng-controller="searchtoCntrl">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="intro-text">
                        <span class="name"><a href="<?php echo base_url(); ?>Infocenter/index">Info Center</a> - Search <?php echo $siteName; ?></span>
                        <hr class="star-primary">
            <div id="hideAfterSearch" ng-hide="searchType||searchLoc||searchKey||searchDate">
						<img class="img-responsive" src="<?php echo base_url(); ?>/assets/img/infocenter_images/profile.png" alt="">
						<hr class="star-primary">
             </div>

						 <div class="form-group">
               <div class="form-horizontal">
                 <form name="searchform">
                 <div class="input-group">
                     <!-- <div class="input-group-btn search-panel"> -->
                          <select class="form-control" ng-model="searchType" >
                            <option value="" selected> - Select Tpye - </option>
                            <option value="Internship">Internship</option>
                            <option value="Event">Event</option>
                            <option value="Conference">Conference</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Industrial Visit">Industrial Visit</option>
                            <option value="Symposium">Symposium</option>
                            <option value="Scholarship">Scholarship</option>
                            <option value="NGO">NGO</option>
                          </select>
                      <div class="input-group-btn search-panel">
                     <input type="text" class="form-control" name="loc" style="width:180px;" placeholder="Enter Location..." ng-model="searchLoc"></div>
                     <!-- <input type="hidden" name="search_param" value="all"> -->
                     <div class="input-group-btn search-panel">
                       <input type="date" class="form-control" id="myDate" ng-model="searchDate">
                     </div>
                     <input type="text" class="form-control" name="key" placeholder="Search term..." ng-model="searchKey">
                     <span class="input-group-btn">
                         <button class="btn btn-danger" type="submit" ng-click="formSubmit()"><span class="glyphicon glyphicon-search"></span></button>
                     </span>
              </div>
              </form>
            </div>
          </div>

          <!-- <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" id="inputGroup" ng-model="seachKey" /> <span class="input-group-addon"><id="search.html"> <i
              class="fa fa-search"></a></i>
            </span>
          </div> -->
        </div>
                        <span class="skills">Get the latest updates about various events in and around your campus!</span>
                    </div>
                </div>
            </div>
    </header>
