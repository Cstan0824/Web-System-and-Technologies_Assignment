<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../Root/link.php") ?>
    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .btn {
            margin-bottom: 5px;
        }

        .grid {
            position: relative;
            width: 100%;
            background: #fff;
            color: #666666;
            border-radius: 2px;
            margin-bottom: 25px;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
        }

        .grid .grid-body {
            padding: 15px 20px 15px 20px;
            font-size: 0.9em;
            line-height: 1.9em;
        }

        .search table tr td.rate {
            color: #f39c12;
            line-height: 50px;
        }

        .search table tr:hover {
            cursor: pointer;
        }

        .search table tr td.image {
            width: 50px;
        }

        .search table tr td img {
            width: 50px;
            height: 50px;
        }

        .search table tr td.rate {
            color: #f39c12;
            line-height: 50px;
        }

        .search table tr td.price {
            font-size: 1.5em;
            line-height: 50px;
        }

        .search #price1,
        .search #price2 {
            display: inline;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <?php include("header.php") ?>
    <main id="main">
        <div class="container">
            <div class="row">
                <!-- BEGIN SEARCH RESULT -->
                <div class="col-md-12">
                    <div class="grid search">
                        <div class="grid-body">
                            <div class="row">
                                <!-- BEGIN FILTERS -->
                                <div class="col-md-3">
                                    <h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
                                    <hr>

                                    <!-- BEGIN FILTER BY CATEGORY -->
                                    <h4>By category:</h4>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck">Famous Actor Meeting</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck">Movie Review Sharing
                                            Session</label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="icheck">Movie Premiere</label>
                                    </div>
                                    <!-- END FILTER BY CATEGORY -->

                                    <div class="padding"></div>

                                    <!-- BEGIN FILTER BY DATE -->
                                    <h4>By date:</h4>
                                    From
                                    <div class="input-group date form_date" data-date="2014-06-14T05:25:07Z"
                                        data-date-format="dd-mm-yyyy" data-link-field="dtp_input1">
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon bg-blue"><i class="fa fa-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="">

                                    To
                                    <div class="input-group date form_date" data-date="2014-06-14T05:25:07Z"
                                        data-date-format="dd-mm-yyyy" data-link-field="dtp_input2">
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon bg-blue"><i class="fa fa-th"></i></span>
                                    </div>
                                    <input type="hidden" id="dtp_input2" value="">
                                    <!-- END FILTER BY DATE -->
                                    <div class="padding"></div>
                                </div>
                                <!-- END FILTERS -->
                                <!-- BEGIN RESULT -->
                                <div class="col-md-9">
                                    <h2><i class="fa-solid fa-book"></i> Result</h2>
                                    <hr>
                                    <!-- BEGIN SEARCH INPUT -->
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" type="button"><i
                                                    class="fa fa-search"></i>
                                            </button>
                                        </span>
                                        <input type="search" class="form-control input-lg" value="web development">
                                    </div>
                                    <!-- END SEARCH INPUT -->
                                    <p>Showing all results matching "web development"</p>

                                    <div class="padding"></div>

                                    <div class="row">
                                        <!-- BEGIN ORDER RESULT -->
                                        <div class="col-sm-6">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    Order by <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Name</a></li>
                                                    <li><a href="#">Date</a></li>
                                                    <li><a href="#">View</a></li>
                                                    <li><a href="#">Rating</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- END ORDER RESULT -->

                                        <div class="col-md-6 text-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default active"><i
                                                        class="fa fa-list"></i></button>
                                                <button type="button" class="btn btn-default"><i
                                                        class="fa fa-th"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- BEGIN TABLE RESULT -->
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <td class="number text-center">1</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right">
                                                        <span><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span>
                                                    </td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="number text-center">2</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right"><span><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span></td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="number text-center">3</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right"><span><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span></td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="number text-center">4</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right"><span><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span></td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="number text-center">5</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right"><span><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span></td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="number text-center">6</td>
                                                    <td class="image"><img
                                                            src="https://www.bootdey.com/image/400x300/FF8C00" alt="">
                                                    </td>
                                                    <td class="event"><strong>Event</strong><br>This is the
                                                        event description.</td>
                                                    <td class="rate text-right"><span><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                                class="fa fa-star"></i><i
                                                                class="fa fa-star-half-o"></i></span>
                                                    </td>
                                                    <td><strong>Category</strong><br />Movie Premiere</td>
                                                    <td><strong>Location</strong><br />Kuala Lumpur, Setapak, TARUMT
                                                    </td>
                                                    <td><strong>Date</strong><br /><?php echo date("Y/m/d"); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END TABLE RESULT -->

                                    <!-- BEGIN PAGINATION -->
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                    </ul>
                                    <!-- END PAGINATION -->
                                </div>
                                <!-- END RESULT -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SEARCH RESULT -->
            </div>
        </div>
    </main>
</body>

</html>