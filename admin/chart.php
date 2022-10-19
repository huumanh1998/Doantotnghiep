<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


        <div class="grid_10">
            <div class="box round first grid">

                <h2>Thống kê đơn hàng</h2>
                <div class="block">     
                    <div id="chart" style="height: 250px;"></div>
               </div>
            </div>
        </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
		new Morris.Area({
		  // ID of the element in which to draw the chart.
		  element: 'chart',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
		    { year: '2022-07-01', order:5,sales:15000, quantity: 20 },
		    { year: '2022-07-02', order:5,sales:20000, quantity: 25 },
		    { year: '2022-07-03', order:5,sales:25000, quantity: 30 }
		   
		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'year',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['order','sales','quantity'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Đơn hàng','Doanh thu','Số lượng bán']
		});
</script>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

