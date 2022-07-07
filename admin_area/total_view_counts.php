
<?php
    include("includes/db.php");
?>

    <script>
        function deleteRows(id, toDeleteHeader) {
          var obj = document.getElementById(id);
          if(!obj && !obj.rows)
            return;
          if(typeof toDeleteHeader == 'undefined')
            toDeleteHeader = false;
          var limit = !!toDeleteHeader ? 0 : 1;
          var rows = obj.rows;
          if(limit > rows.length)
            return;
          for(; rows.length > limit; ) {
            obj.deleteRow(limit);
          }


        }

    </script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard / View Counts
                </li>
            </ol>
        </div>
    </div>


<div class="container">
  <h2>Total Views Count</h2>

  <?php
    $get_products1 = "Select count(distinct(ip)) from views_count ";
    $run_products1 = mysqli_query($connection, $get_products1);
    $row1 = mysqli_fetch_array($run_products1);
    $hosts_count = $row1['count(distinct(ip))'];

    $get_products1 = "Select sum(count) from views_count ";
    $run_products1 = mysqli_query($connection, $get_products1);
    $row1 = mysqli_fetch_array($run_products1);
    $views_count = $row1['sum(count)'];
  ?>
  <div style="display: flex">
        <h1>Hosts <span class="label label-default"><?php echo $hosts_count ?></span></h1>
        <h1 style="margin-left: 100px">Views <span class="label label-default"><?php echo $views_count ?></span></h1>
  </div>



<form action="total_view_counts.php" method="post">
    <div style="display:flex;">
        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px; display: inline;">
            <h5>Hosts Search</h5>
            <input class="form-control" type="text" name="hosts" placeholder="Search"
            aria-label="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>Date Search</h5>
            <input class="form-control" type="text" name="date" placeholder="Search"
            aria-label="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>View Search</h5>
            <input class="form-control" type="text" name="views" placeholder="Search"
            aria-label="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>Search</h5>
            <input class="form-control btn-primary" onclick="deleteRows('table', false)" type="submit" name="submit" value="Search">
        </div>


    </div>
</form>




  <table id="table" class="table table-hover sortable">
    <thead>
      <tr>
        <th>Hosts</th>
        <th>Date</th>
        <th>Views</th>
      </tr>
    </thead>
    <tbody>


        <?php

            $per_page = 20;
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            }else {
                $page = 1;
            }

            $start_from = ($page-1) * $per_page;


            if(isset($_POST['submit'])) {
                $hosts = $_POST['hosts'];
                $date_s = $_POST['date'];
                $views = $_POST['views'];
                $get_products1 = "Select count(ip), date, sum(count) from views_count group by `date` having date like '%$date_s%' and count(ip) like '%$hosts%' and sum(count) like '%$views%'";
              //  error_log($get_products1, 0);
                $run_products1 = mysqli_query($connection, $get_products1);
                $i = 0;
                $sum_views = 0;
                $sum_hosts = 0;
                while($row1 = mysqli_fetch_array($run_products1)) {
                    $i = $i + 1;
                    $ip = $row1['count(ip)'];
                    $date = $row1['date'];
                    $count = $row1['sum(count)'];
                    $sum_hosts += 1;
                    $sum_views += $row1['sum(count)'];
                    echo "
                        <tr>
                            <td>$ip</td>
                            <td>$date</td>
                            <td>$count</td>
                        </tr>
                    ";
                }

                 echo "
                        <tr>
                            <td>$sum_hosts</td>
                            <td></td>
                            <td>$sum_views</td>
                            <td>Total</td>
                        </tr>
                    ";


            } else {
                $sql = "Select count(ip), date, sum(count) from views_count group by `date` order by `date` desc limit $start_from, $per_page";
                $result = mysqli_query($connection, $sql);
                $sum = 0;
                while ($rowList = mysqli_fetch_array($result)) {
                    $ip = $rowList['count(ip)'];
                    $date = $rowList['date'];
                    $count = $rowList['sum(count)'];
                    $sum += $count;
                    echo "
                        <tr>
                            <td>$ip</td>
                            <td>$date</td>
                            <td>$count</td>
                        </tr>
                    ";
                }

                echo "
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td>$sum</td>
                    </tr>
                ";
            }






        ?>


    </tbody>
  </table>
</div>



<center>
    <ul class="pagination">
        <?php

            $query = "Select count(ip), date, sum(count) from views_count group by `date` order by `date`";

            $res = mysqli_query($connection, $query);

            $records = mysqli_num_rows($res);

            $total_pages = ceil($records / $per_page);

            echo "
                <li><a href='total_view_counts.php?page=1'>".'First Page'."</a></li>
            ";

            for ($i = 1; $i <= $total_pages; $i++) {
                echo "
                    <li><a href='total_view_counts.php?page=".$i."'>".$i."</a></li>
                ";
            }
                echo "
                <li><a href='total_view_counts.php?page=$total_pages'>".'Last Page'."</a></li>
            ";


        ?>
    </ul>
</center>

<?php

?>

<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>



</body>
</html>
