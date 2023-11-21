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
            $tongdm=count($listthongkebl);
            $i=1;
            foreach ($listthongkebl as $thongkebl){
                extract($thongkebl);
                if($i==$tongdm) $dauphay=""; else $dauphay=",";
                echo "['".$thongkebl['tensp']."', ".$thongkebl['countcm']."]".$dauphay;
                $i+=1;
            }
            ?>
        ]);

        var options = {
            'title': 'THỐNG KÊ BÌNH LUẬN',
            'width': 1100,
            'height': 800
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
    </script>

</div>