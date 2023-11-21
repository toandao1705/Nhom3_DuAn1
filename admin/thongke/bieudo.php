<div class="row">
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