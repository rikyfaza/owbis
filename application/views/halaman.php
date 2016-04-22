﻿<!DOCTYPE html>
<html data-ng-app="customersApp">
<head>
    <title>Customer Manager</title>
    <link href="Content/bootstrap.min.css" rel="stylesheet" />
    <link href="Content/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="Content/customerManagementStyles.css" rel="stylesheet" />
</head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand " href="#/">
                    <img src="Content/Images/people.png" alt="logo"> Customer Manager
                </a>
                <ul class="nav nav-pills" data-ng-controller="NavbarController">
                    <li data-ng-class="{'active':getClass('/customers')}"><a href="#/customers">Customers</a></li>
                    <li data-ng-class="{'active':getClass('/orders')}"><a href="#/orders">Orders</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Note that AngularJS 1.2+ now has a built-in ng-animation direction. Left in animated-view to show a 
         custom directive -->
    <div animated-view></div>


    <div id="footer">
        <div class="navbar navbar-fixed-bottom">
            <div class="navbar-inner">
                <div class="container">
                    <footer>
                        <div class="row">
                            <div class="span4">
                                Created by Dan Wahlin
                            </div>
                            <div class="span4">
                                Twitter: <a href="http://twitter.com/DanWahlin">@DanWahlin</a>
                            </div>
                            <div class="span4">
                                Blog: <a href="http://weblogs.asp.net/dwahlin">weblogs.asp.net/dwahlin</a>
                            </div>
                        </div>
                   </footer>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Libs: jQuery only used for Bootstrap functionality -->
    <script src="Scripts/angular.js"></script>
    <script src="Scripts/angular-route.js"></script>
    <script src="Scripts/jquery.min.js"></script>

    <!-- UI Libs -->
    <script src="Scripts/bootstrap.js"></script>


    <!-- App libs -->
    <script src="app/app.js"></script>
    <script src="app/controllers/controllers.js"></script>
    <script src="app/services/customersService.js"></script>
    <script src="app/directives/animatedView.js"></script>
</body>
</html>