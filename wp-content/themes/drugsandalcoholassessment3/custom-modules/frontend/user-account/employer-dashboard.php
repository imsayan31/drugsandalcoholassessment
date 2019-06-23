<?php
/*
 *  User Dashboard Page
 */
$GeneralThemeObject = new GeneralTheme();
$userDetails = $GeneralThemeObject->user_details();
$applicationGraphData = [];
if ($userDetails->data['role'] == 'job_seeker'):
    wp_redirect(USER_ACCOUNT_PAGE);
    exit;
endif;
$getEmployerDashboardOverView = $GeneralThemeObject->getEmployerDashboardOverView($userDetails->data['ID']);
$getJobApplicationsPreview = get_posts(['post_type' => THEME_PREFIX . 'job_application', 'posts_per_page' => 5, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC', 'meta_query' => [
        [
            'key' => '_job_application_employer',
            'value' => $userDetails->data['ID'],
            'compare' => '='
        ]
        ]]);
$getJobApplications = get_posts(['post_type' => THEME_PREFIX . 'job_application', 'posts_per_page' => -1, 'post_status' => 'publish', 'meta_query' => [
        [
            'key' => '_job_application_employer',
            'value' => $userDetails->data['ID'],
            'compare' => '='
        ]
        ]]);
$countGraph = 0;
for ($i = 1; $i <= 12; $i++):
    if ($i < 10):
        $monthVal = '0' . $i;
    else:
        $monthVal = $i;
    endif;
    $getJobApplicationsMonthly = get_posts(['post_type' => THEME_PREFIX . 'job_application', 'post_status' => 'publish',
        'date_query' => [
            [
                'year' => date('Y'),
                'month' => $i
            ]
        ], 'meta_query' => [
            [
                'key' => '_job_application_employer',
                'value' => $userDetails->data['ID'],
                'compare' => '='
            ]
    ]]);
    $applicationGraphData[$countGraph]['date'] = date('Y') . '-' . $monthVal . '-01';
    $applicationGraphData[$countGraph]['value'] = count($getJobApplicationsMonthly);
    $countGraph++;
endfor;
?>
<style>
    #chartdiv {
        width	: 100%;
        height	: 500px;
    }
</style>
<div class="">
    <!-- Overview Section -->
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-briefcase fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <?php _e('Total Jobs', THEME_TEXTDOMAIN); ?><span><?php echo $getEmployerDashboardOverView->data['total_jobs']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-users fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <?php _e('Active Jobs', THEME_TEXTDOMAIN); ?><span><?php echo $getEmployerDashboardOverView->data['total_active_jobs']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-clock-o fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <?php _e('Expired Jobs', THEME_TEXTDOMAIN); ?><span><?php echo $getEmployerDashboardOverView->data['total_expired_jobs']; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-diamond fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <?php _e('Current Plan', THEME_TEXTDOMAIN); ?><span class="current_plan"><?php echo get_the_title($getEmployerDashboardOverView->data['current_subscription_plan']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-envelope fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">                        
                        <?php _e('Unread Messages', THEME_TEXTDOMAIN); ?><span><?php echo $getEmployerDashboardOverView->data['no_of_unread_messages']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-4">
                        <i class="fa fa-file-text fa-fw fa-3x"></i>
                    </div>
                    <div class="col-8 text-right">
                        <?php _e('Job Abbplications', THEME_TEXTDOMAIN); ?><span><?php echo $getEmployerDashboardOverView->data['no_of_job_application']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Overview Section -->

    <!-- Graph Section -->
    <div class="sj-registration-form">
        <label><?php _e('Chart for Monthly Job Application', THEME_TEXTDOMAIN); ?></label>
        <div id="chartdiv"></div>
    </div>
    <!-- End of Graph Section -->

    <!-- Recent Job Applications -->
    <div class="table-responsive sj-table">
        <table class="table table-hover">
            <thead>
            <th><?php _e('#ID', THEME_TEXTDOMAIN); ?></th>
            <th><?php _e('Applicant Name', THEME_TEXTDOMAIN); ?></th>
            <th><?php _e('Job Title', THEME_TEXTDOMAIN); ?></th>
            <th><?php _e('Action', THEME_TEXTDOMAIN); ?></th>
            </thead>
            <tbody>
                <?php
                if (is_array($getJobApplicationsPreview) && count($getJobApplicationsPreview) > 0):
                    foreach ($getJobApplicationsPreview as $eachJobApplications):
                        $jobApplicationDetails = $GeneralThemeObject->job_application_details($eachJobApplications->ID);
                        $jobApplicantDetails = $GeneralThemeObject->user_details($jobApplicationDetails->data['author']);
                        ?>
                        <tr>
                            <td><?php echo $jobApplicationDetails->data['title']; ?></td>
                            <td><?php echo $jobApplicantDetails->data['fname'] . ' ' . $jobApplicantDetails->data['lname']; ?></td>
                            <td><?php echo get_the_title($jobApplicationDetails->data['job']); ?></td>
                            <td>
                                <a href="javascript:void(0);" class="download-applicant-resume btn btn-primary" data-job_application="<?php echo base64_encode($jobApplicationDetails->data['ID']); ?>" title="<?php _e('Download Resume', THEME_TEXTDOMAIN); ?>"><i class="fa fa-download" aria-hidden="true"></i></a> | 
                                <a href="javascript:void(0);" class="check-applicant-message btn btn-primary" data-job_application="<?php echo base64_encode($jobApplicationDetails->data['ID']); ?>" title="<?php _e('View Applicant\'s Message', THEME_TEXTDOMAIN); ?>"><i class="fa fa-comment" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                else:
                    ?>
                    <tr>
                        <td colspan="5"><div class="alert alert-danger"><?php _e('No jobs applicartion received.', THEME_TEXTDOMAIN); ?></div></td>
                    </tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <!-- End of Recent Job Applications -->
</div>
<script type="text/javascript">
    var applicationGraphData = <?php echo json_encode($applicationGraphData); ?>;
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        //"marginRight": 60,
        //"marginLeft": 40,
        "autoMarginOffset": 20,
        //"mouseWheelZoomEnabled": true,
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
                "id": "v1",
                "axisAlpha": 0,
                "position": "left",
                "ignoreAxisWidth": true
            }],
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "graphs": [{
                "id": "g1",
                "balloon": {
                    "drop": true,
                    "adjustBorderColor": false,
                    "color": "#ffffff"
                },
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "bulletSize": 5,
                "hideBulletsCount": 50,
                "lineThickness": 2,
                "title": "red line",
                "useLineColorForBulletBorder": true,
                "valueField": "value",
                "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
            }],
        "chartScrollbar": {
            "graph": "g1",
            "oppositeAxis": false,
            "offset": 30,
            "scrollbarHeight": 80,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "graphLineAlpha": 0.5,
            "selectedGraphFillAlpha": 0,
            "selectedGraphLineAlpha": 1,
            "autoGridCount": true,
            "color": "#AAAAAA"
        },
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha": 1,
            "cursorColor": "#258cbb",
            "limitToGraph": "g1",
            "valueLineAlpha": 0.2,
            "valueZoomable": true
        },
        "valueScrollbar": {
            "oppositeAxis": false,
            "offset": 50,
            "scrollbarHeight": 10
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "dataProvider": applicationGraphData
                /*[{
                 "date": "2012-07-27",
                 "value": 13
                 }, {
                 "date": "2012-07-28",
                 "value": 11
                 }, {
                 "date": "2012-07-29",
                 "value": 15
                 }, {
                 "date": "2012-07-30",
                 "value": 16
                 }, {
                 "date": "2012-07-31",
                 "value": 18
                 }, {
                 "date": "2012-08-01",
                 "value": 13
                 }, {
                 "date": "2012-08-02",
                 "value": 22
                 }, {
                 "date": "2012-08-03",
                 "value": 23
                 }, {
                 "date": "2012-08-04",
                 "value": 20
                 }]*/
    });

    chart.addListener("rendered", zoomChart);

    zoomChart();

    function zoomChart() {
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
    }
</script>
<?php
