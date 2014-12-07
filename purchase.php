<!DOCTYPE html>
<!--[if lt IE 7]>

<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]-->
<!--[if IE 7]>

<html class="lt-ie9 lt-ie8" lang="en">

<![endif]-->
<!--[if IE 8]>

<html class="lt-ie9" lang="en">

<![endif]-->
<!--[if gt IE 8]>
<!-->

<html lang="en">
  
  <!--
<![endif]-->
 
<head>
    <meta charset="utf-8">
    <title>
      গোডাউন সম্পর্কিত তথ্য | অভিযাত্রী সুজ
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    </script>
    <link href="icomoon/style.css" rel="stylesheet">
     <link rel="icon" type="image/ico" href="img/ico/favicon.ico"></link>
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
  <link href="css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
  <link href="css/new_table.css" rel="stylesheet">
  <link href="css/charts-purchase.css" rel="stylesheet">
  <link href="css/delbtn.css" rel="stylesheet">
  <script type="text/javascript" src="jquery.js"></script>   
  <script type="text/javascript">
        $(window).bind('beforeunload', function(){
          return '>>>>><<<<< \n আপনি কি রিফ্রেশ করতে চান?';
        });
  </script>
  </head>
  <body>
    <?php header("Cache-Control: no-cache, no-store, must-revalidate "); ?>
    <header>
      <a href="#" class="logo">
        <img src="img/Regainers_final.jpg" alt="Logo"/>
      </a>
      <div class="btn-group">
        <button class="btn btn-primary">
          ইউজার
        </button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu pull-right">
          <li>
            <a href="#">
              Edit Profile
            </a>
          </li>
          <li>
            <a href="#">
              Account Settings
            </a>
          </li>
          <li>
            <a href="#">
              Logout
            </a>
          </li>
        </ul>
      </div>
    </header>
    <div class="container-fluid">
      <div class="dashboard-container">
        <?php 
          include 'top_nav.php';
          selected('purchase');
         ?>
       </div>
       

        <div class="sub-nav">
          <ul>
            <li>
              <a href="#" class="heading">গোডাউন</a>
            </li>
            <li>
              <a href="purchase.php">
                মাল ক্রয়
              </a>
            </li>
            <li>
              <a href="new_factory.php">
                নতুন কারখানা যোগ করুন
              </a>
            </li>
            
          </ul>
        </div>
          
        <div class="dashboard-wrapper">
          <div class="left-sidebar">
            
            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      নতুন মালের তালিকা তৈরি করুন 
                      <span class="mini-title">
                        নতুন মালের সাধারণ ফরম
                      </span>
                    </div>
                    
                  </div>
                  <div class="widget-body">
                    <?php 
                        if (isset($_GET['msg']) && $_GET['msg']=='success' ) {
                          echo "<p><h1>মাল কেনা সফল হয়েছে</h1></p>";
                        }else{}
                       ?>




                    <?php 
                      require_once "conn.php";

                      $result = mysqli_query($con,"SELECT * FROM purchase_memos ORDER BY table_index DESC LIMIT 1");
                      $memo_no = null;
                      if(mysqli_num_rows($result)!=0){
                        $row = mysqli_fetch_array($result);
                        $last = $row['memo_no'];
                        $memo_no = $last + 1;
                      } else{ $memo_no = 1;}?>
                    
                    <form class="form-horizontal no-margin" action="purchase_preview.php" method="post" enctype="multipart/form-data">
                      <div class="control-group">
                        <label class="required control-label" for="memo_no">
                          মেমো নং  <?php echo $memo_no; ?>
                        </label>
                        <div class="controls controls-row">
                          <input name="memo_no" type="hidden" value="<?php echo $memo_no; ?>">
                          
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label" for="">
                          কারখানার নাম
                        </label>
                        <div class="controls">
                          <input type="text" id="factory_name" name="factory_name" list="factories" autocomplete="off" onchange="checkFactoryName();validateFactoryName();" value="লিখুন">
                          <datalist class ="" id="factories" onchange="javascript:checkFactoryName();">
                            <?php       
                              $result = mysqli_query($con,"SELECT * FROM factories");
                              while($row = mysqli_fetch_array($result)){
                              echo "<option value=\"".$row['factory_name']."\">".$row['factory_name']."</option>";
                                }     
                            ?>
                          </datalist>

                          <span class="help-inline ">
                            কারখানার নাম দিন
                          </span>
                        </div>
                        <a href="purchase.php" class="btn btn-info pull-right">রিফ্রেশ</a>
                        </div>

                         
                      <div class="table">
                         <table class="table-condensed table-striped table-bordered table-hover no-margin new table">
                         <colgroup>
						    <col style="width:5%;">
						    <col span="4" style="width:8%;">
						    <col >
						 </colgroup>
                          <tr>
                            <th rowspan="2">ক্রঃ নং</th>
                            <th colspan="4">বিবরণ</th>
                            <th rowspan="2">ছবি</th>
                            <th rowspan="2">পরিমাণ (জোড়া)</th>
                            <th rowspan="2">গায়ের দাম (জোড়া)</th>
                            <th rowspan="2">মূল্য (ডজন)</th>
                            <th rowspan="2">হিসাব</th>
                          </tr>
                          <tr>
                            <th>জুতা</th>
                            <th>ধরন</th>
                            <th>কালার</th>
                            <th>ডিজাইন</th>
                          </tr>
                         
                        <tr id="row1a">
                          <td id="serial" rowspan="2">1</td>
                          <td colspan="4">আইডি <input type="text" name="pids[]" id ="pid1" value="জেনারেট হয়নি" onchange="javascript:ajax_post_prices(1);setTimeout(function(){calcTotal(1);},100);" ></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><p id="delrow1" onclick="javascript:delRow(1);" class="delbtn">x</p></td>
                         </tr>
                        <tr id="row1b">
                          <td rowspan="1">
                            <select style=""name="genres[]" id="genre" onChange="genrePipe(1);" onclick="javascript:checkFactoryName();">
                              <option class="new" value="0" selected="selected">সিলেক্ট</option>
                              <option value="1" >জেঃ</option>
                              <option value="2">লেঃ</option>
                              <option value="3">সু</option>
                              <option value="4">বেবি</option>
                            </select> 
                          </td>
                          <td rowspan="1">
                            <select name="types[]" id="types" onChange="typesPipe(1);">
                              <option value="" selected="selected">সিলেক্ট</option>
                            </select>
                          </td>
                          <td rowspan="1">
                            <select name="colors[]" id="colors" onChange="colorsPipe(1);">
                              <option value="" selected="selected">সিলেক্ট</option>       
                            </select>
                          </td>
                          <td rowspan="1">
                            <p id="design_no"></p>
                            <input type="hidden" name="designs[]" id="designs" value="001" >
                             <!-- <input type="hidden" name="pids[]" id ="pid" value="00000000"> -->        
                            <input class="new button btn btn-info" type="button" value="নতুন" id="renew" onclick="renewPipe(1);">
                          </td> 
                          <td rowspan="1">
                            <input class="new button btn btn-info" name="images[]" id="photo_up" type="file" title="ছবি দিন"  style="width: 60%;" value="ছবি দিন">
                          </td>
                        
                          <td rowspan="1">
                            <input type="text" name="qtys[]" value="6" id="qty1" onfocus="calcTotal(1);" onchange="calcTotal(1);">
                          </td>
                          <td rowspan="1">
                            <input type="text" name ="retail_prices[]" id="rprice1">
                          </td>
                          <td rowspan="1">
                            <input type="text" name="cost_prices[]" id="cprice1" onchange="calcTotal(1);">
                          </td>
                          <td><input type="text" readonly id="sub1" onfocus="addField();"></td>
                        </tr>
                        <tr id="last_row">
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>মোট:</td>
                          <td><input type="text" readonly name="total" id="total"> <input type="hidden" id="total_serial" value="1"></td>
                        </tr>

                        </table>
                        </div>
                        <div>
                          <p id="type">
                            
                          </p>
                        </div>
                        <input type="button" class="btn btn-info pull-left" onclick="checkFactoryName();checkLastRow();" value="প্রিভিউ">
                        <input class="btn btn-info pull-left" type="submit" id="submit" style="visibility: hidden;">
                        <input type="button" class="btn btn-info pull-right" value="নতুন লাইন" onclick="addField();">
                      </form>
                      
                    
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>      
    <footer>
      <p>
        &copy; CodeCharley
      </p>
    </footer>
    <script src="js/jquery.min.js">
    </script>
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.scrollUp.js">
    </script>
    

    <!-- Easy Pie Chart JS -->
    <script src="js/jquery.easy-pie-chart.js">
    </script>
    
    <!-- Sparkline JS -->
    <script src="js/jquery.sparkline.js">
    </script>
    
    
    <script type="text/javascript">
      //ScrollUp
      $(function () {
        $.scrollUp({
          scrollName: 'scrollUp', // Element ID
          topDistance: '300', // Distance from top before showing element (px)
          topSpeed: 300, // Speed back to top (ms)
          animation: 'fade', // Fade, slide, none
          animationInSpeed: 400, // Animation in speed (ms)
          animationOutSpeed: 400, // Animation out speed (ms)
          scrollText: 'Scroll to top', // Text for element
          activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
      });

      $(document).ready(function () {
        pie_chart();
        sparkline_purchase();
      });

      function pie_chart() {
        $(function () {
          //create instance
          $('.chart1').easyPieChart({
            animate: 2000,
            barColor: '#74b749',
            trackColor: '#dddddd',
            scaleColor: '#74b749',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(50);
          }, 5000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(70);
          }, 10000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(30);
          }, 15000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(90);
          }, 19000);
          setTimeout(function () {
            $('.chart1').data('easyPieChart').update(40);
          }, 32000);
        });

        $(function () {
          //create instance
          $('.chart2').easyPieChart({
            animate: 2000,
            barColor: '#ed6d49',
            trackColor: '#dddddd',
            scaleColor: '#ed6d49',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(90);
          }, 10000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(40);
          }, 18000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(70);
          }, 28000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(50);
          }, 32000);
          setTimeout(function () {
            $('.chart2').data('easyPieChart').update(80);
          }, 40000);
        });

        $(function () {
          //create instance
          $('.chart3').easyPieChart({
            animate: 2000,
            barColor: '#0daed3',
            trackColor: '#dddddd',
            scaleColor: '#0daed3',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(20);
          }, 9000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(59);
          }, 20000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(38);
          }, 35000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(79);
          }, 49000);
          setTimeout(function () {
            $('.chart3').data('easyPieChart').update(96);
          }, 52000);
        });

        $(function () {
          //create instance
          $('.chart4').easyPieChart({
            animate: 2000,
            barColor: '#ffb400',
            trackColor: '#dddddd',
            scaleColor: '#ffb400',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(40);
          }, 6000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(67);
          }, 14000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(43);
          }, 23000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(80);
          }, 36000);
          setTimeout(function () {
            $('.chart4').data('easyPieChart').update(66);
          }, 41000);
        });


        $(function () {
          //create instance
          $('.chart5').easyPieChart({
            animate: 3000,
            barColor: '#F63131',
            trackColor: '#dddddd',
            scaleColor: '#F63131',
            size: 180,
            lineWidth: 5,
          });
          //update instance after 5 sec
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(30);
          }, 9000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(87);
          }, 19000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(28);
          }, 27000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(69);
          }, 39000);
          setTimeout(function () {
            $('.chart5').data('easyPieChart').update(99);
          }, 47000);
        });


      }


      function sparkline_purchase() {
        $(function () {
          $('#stock-graph').sparkline('html', {
            type: 'bar',
            barColor: '#0daed3',
            barWidth: 7,
            height: 38,
          });
        });
      }


      google.load("visualization", "1", {
        packages: ["corechart"]
      });

      $(document).ready(function () {
        drawChart1();
        drawChart2();
        drawChart3();
        drawChart4();
      })

      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Google+', 'Facebook'],
          ['2009', 4000, 900],
          ['2010', 970, 1460],
          ['2011', 1660, 520],
          ['2012', 1030, 540]
        ]);

        var options = {
          width: 'auto',
          lineWidth: 1,
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#74b749', '#0daed3', '#ed6d49', '#ffb400', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 40,
            top: 10,
            height: "80%"
          }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('area_chart'));
        chart.draw(data, options);
      }




      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Visitors', 'Orders'],
          ['Sun', 9709, 761],
          ['Mon', 1367, 8631],
          ['Tue', 6792, 971],
          ['Wed', 1267, 7491],
          ['Thu', 9539, 1792],
          ['Fri', 670, 9367],
          ['Sat', 9761, 709]
        ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#0daed3'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 100,
            top: 10
          },
          focusTarget: 'category',
          hAxis: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          vAxis: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          pointSize: 6,
          chartArea: {
            left: 60,
            top: 10,
            height: '80%'
          },
          lineWidth: 1,
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
        chart.draw(data, options);
      }


      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Visitors', 'Orders', 'Income', 'Expenses'],
          ['2007', 300, 800, 900, 300],
          ['2008', 1170, 860, 1220, 564],
          ['2009', 260, 1120, 2870, 2340],
          ['2010', 1030, 540, 3430, 1200],
          ['2011', 200, 700, 1700, 770],
          ['2012', 1170, 2160, 3920, 800], ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#0daed3', '#ffb400', '#74b749', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 60,
            top: 10,
            height: '80%'
          },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));
        chart.draw(data, options);
      }

      function drawChart4() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Eat', 2],
          ['Work', 10],
          ['Commute', 2],
          ['Read', 2],
          ['Sleep', 8]
        ]);

        var options = {
          width: 'auto',
          height: '160',
          backgroundColor: 'transparent',
          colors: ['#ed6d49', '#74b749', '#0daed3', '#ffb400', '#f63131'],
          tooltip: {
            textStyle: {
              color: '#666666',
              fontSize: 11
            },
            showColorCode: true
          },
          legend: {
            position: 'left',
            textStyle: {
              color: 'black',
              fontSize: 12
            }
          },
          chartArea: {
            left: 0,
            top: 10,
            width: "100%",
            height: "100%"
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
        chart.draw(data, options);
      }
    </script>
  <script language="JavaScript" type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="purchase_ajax.js"></script>
    <script src="defTest.js"></script>
  <script type="text/javascript" src="purchase_script_v2.js"></script>
  <script type="text/javascript" src="ignore_key.js"></script>
  </body>
</html>