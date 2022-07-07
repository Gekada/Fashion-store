


<?php
    include("includes/db.php");
    if(!isset($_SESSION['admin_email'])) {
        echo "<script>window.open('login.php', '_self')</script>";
    } else {


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
  <h2>Views Count</h2>

<form action="view_counts.php" method="post">
    <div style="display:flex;">
        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px; display: inline;">
            <h5>IP Search</h5>
            <input class="form-control" type="text" name="ip" placeholder="Search"
            aria-label="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>Date Search</h5>
            <input class="form-control" type="text" name="date" placeholder="Search"
            aria-label="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>Search</h5>
            <input class="form-control btn-primary" onclick="deleteRows('table', false)" type="submit" name="submit" value="Search">
        </div>

        <div class="active-red-3 active-cyan-4 mb-4" style="width: 200px;  display: inline; margin-left: 50px;">
            <h5>Clear Filters</h5>
            <input class="form-control btn-danger" onclick="deleteRows('table', false)" type="submit" name="clear" value="Clear">
        </div>
    </div>
</form>




  <table id="table" class="table table-hover sortable">
    <thead>
      <tr>
        <th>#</th>
        <th>IP</th>
        <th>Date</th>
        <th>Count</th>
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
                $ip_s = $_POST['ip'];
                $date_s = $_POST['date'];
                $get_products1 = "Select * from `views_count` where `date` like '%$date_s%' and `ip` like '%$ip_s%' order by `date` desc";
               // error_log($get_products1, 0);
                $run_products1 = mysqli_query($connection, $get_products1);
                $i = 0;
                $sum = 0;
                while($row1 = mysqli_fetch_array($run_products1)) {
                    $i = $i + 1;
                    $ip = $row1['ip'];
                    $date = $row1['date'];
                    $count = $row1['count'];
                    $sum += $row1['count'];
                    echo "
                        <tr>
                            <td>$i</td>
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
                            <td></td>
                            <td>$sum</td>
                        </tr>
                    ";


            } else {
                $get_products = "Select ip, min(`date`), max(`date`), sum(`count`) from `views_count` group by ip limit $start_from, $per_page";
             //   error_log($get_products, 0);
                $run_products = mysqli_query($connection, $get_products);
                $i = 0;
                while($row = mysqli_fetch_array($run_products)) {
                    $i = $i + 1;
                    $ip = $row['ip'];
                    $min_date = $row['min(`date`)'];
                    $count = $row['sum(`count`)'];
                    $max_date = $row['max(`date`)'];

                    echo "
                        <tr>
                            <td>$i</td>
                            <td>$ip</td>
                            <td>$min_date - $max_date</td>
                            <td>$count</td>
                        </tr>
                    ";
                }
            }








        ?>


    </tbody>
  </table>
</div>



<center>
    <ul class="pagination">
        <?php

            $query = "Select * from `views_count`";

            $res = mysqli_query($connection, $query);

            $records = mysqli_num_rows($res);

            $total_pages = ceil($records / $per_page);

            echo "
                <li><a href='view_counts.php?page=1'>".'First Page'."</a></li>
            ";

            for ($i = 1; $i <= $total_pages; $i++) {
                echo "
                    <li><a href='view_counts.php?page=".$i."'>".$i."</a></li>
                ";
            }
                echo "
                <li><a href='view_counts.php?page=$total_pages'>".'Last Page'."</a></li>
            ";


        ?>
    </ul>
</center>

<?php

?>

<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>



</body>
</html>

<?php
    }
 ?>