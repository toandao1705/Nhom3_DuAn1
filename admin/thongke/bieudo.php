<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Biểu đồ thống kê sản phẩm theo danh mục</h3>
                <h3 class="card-title ml-auto"><a href="index.php?act=listthongke">trở về</a></h3>
            </div>
            <div id="piechart"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Loại', 'Số Lượng'],
                    <?php
            $tongdm=count($listthongke);
            $i=1;
            foreach ($listthongke as $thongke){
                extract($thongke);
                if($i==$tongdm) $dauphay=""; else $dauphay=",";
                echo "['".$thongke['tendm']."', ".$thongke['countsp']."]".$dauphay;
                $i+=1;
            }
            ?>
                ]);

                var options = {
                    'title': 'THỐNG KÊ HÀNG HÓA',
                    'width': 1100,
                    'height': 800
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
            </script>

        </div>
    </div>
</div>