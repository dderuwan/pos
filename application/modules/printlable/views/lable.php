<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<style>
div.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: A4;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body>
	<div style="margin-left: 5%">
	
		<?php
		
		for($i=1;$i<=$count;$i++){
			echo "<div class='inline' style='width: 200px;padding:10px;border: 1px solid #ebebe0;'>".
					"<div style='margin-bottom:5px'><span style='font-size:15px;text-transform: uppercase;' ><b>$product_name </b></span></div>".
					"<div style='margin-bottom:5px'><span style='font-size:9px'>M/D/Y</span><span style='font-size:10px;padding-left:3px' ><b>$exdate</b></span><span style='font-size:9px;padding-left:30px'>NET WT:</span><span style='font-size:10px;padding-left:10px' ><b>$unit </b></span></div>".
					"<div style='margin-bottom:5px'><span style='font-size:9px'>Exp.D.</span><span style='font-size:10px;padding-left:3px' ><b>$mdate</b></span></div>".
					"<div style='margin-bottom:5px'><span style='font-size:9px'>Import By:</span><span style='font-size:9px;padding-left:35px'>M.R.P.</span><span style='font-size:25px;padding-left:5px' ><b>$price</b></span></div>".
					"</div>";
		}
	
		?>
	</div>
</body>
<script>
	$(window).on('load', function(){
		window.print();  
		window.close();
		 setTimeout(function(){ 
				self.close();
				window.history.back()
			 }, 3000); 
	});
	</script>
</html>