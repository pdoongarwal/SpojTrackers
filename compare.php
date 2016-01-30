<html>

	<head>
		<title>Search</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/search.css">
	    <script src="js/html5shiv.min.js"></script>
	    <script src="js/respond.min.js"></script>
	</head>

	<body>
		<nav class = "navbar navbar-default navbar-fixed-top" id ="my-navbar">
			<div class = "container-fluid">
			    <div class = "navbar-header">
			      	<button type="button" class ="navbar-toggle" data-toggle = "collapse" data-target ="#navbar-collapse">
				    	<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				  	</button>
		         	<div class="collapse navbar-collapse" id="navbar-collapse">
		         	<ul class="nav navbar-nav">
				        <li><a href="index.php">Homepage</a>
				        <li><a href="tags_final.php">tags</a>
				        <li><a href="compare.php">Compare</a> 
				        
					</ul>
		      	</div>	
			    </div>
		       
		      	<div class="collapse navbar-collapse" id="navbar-collapse">
		         	<ul class="nav navbar-nav">
					</ul>
		      	</div>
		    </div>
	   	</nav>

	   	<div class="jumbotron" id="search">
	      
	      	<div class="container text-center">
	      		<h1>Compare users by problems</h1>
	      		<p></p>
	      		
	      		<div class="row">
				  	<form action="compare.php" method="post">
					  	<div class="col-lg-6">
						    <div class="input-group">
						      <span class="input-group-addon" id="sizing-addon1">username</span>
						      <input type="text" class="form-control" placeholder="mayank_124" name='coder1'>
						    </div><!-- /input-group -->
					  	</div><!-- /.col-lg-6 -->
						
						<div class="col-lg-6">
							<div class="input-group">
							    <span class="input-group-addon" id="sizing-addon1">username</span>
							    <input type="text" class="form-control" placeholder="kart123" name='coder2'>
							    <span class="input-group-btn">
								    <button class="btn btn-default" type="submit">Go!</button>
							    </span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
					</form>
				</div><!-- /.row -->
			</div>
	    </div>
	    <?php
                include('simple_html_dom.php');
              //  include('proxy.php');
                if(isset($_POST['coder1']) && isset($_POST['coder2'])) {
    		    	
		  

                
			//  $cxt=stream_context_create($Context);
			  			$coder1=$_POST['coder1'];
                        $url1="http://www.spoj.com/users/$coder1";
	        			$user1=file_get_html($url1,false,$cxt);
	        			$list=$user1->find('table[class=table table-condensed]',0);
	        			$list1=$list->find('a');
	        			
				    for($i=0;$i<sizeof($list1);$i++)
				    {
				    

				          $list2[$i] =  $list->find('a',$i)->innertext;
				    }
				    if(isset($list2)){
				    $list2=array_filter($list2);
                    sort($list2);}
                    else
                    	{?><center><h1><?php
                    		echo "$coder1 has solved 0 problems";?> </h1></center><?php
                    		die();
                    		}

                    // for coder 2
                   
                   // $cxt=stream_context_create($Context);
                    $coder2=$_POST['coder2'];
                    $url2="http://www.spoj.com/users/$coder2";
                    $user2=file_get_html($url2,false,$cxt);
                    $list10=$user2->find('table[class=table table-condensed]',0);
                    $list11=$list10->find('a');
                    
                    
                    for($i=0;$i<sizeof($list11);$i++)
                    {
                    
                    	$list12[$i]=$list10->find('a',$i)->innertext;
                    }
                    if(isset($list12)){
                    $list12=array_filter($list12);
                   
                    sort($list12);}
                    else{?><center><h1><?php
                    		echo "$coder2 has solved 0 problems";?> </h1></center><?php
                    		die();
                    }
                    $compare=array_intersect($list2,$list12);
                    sort($compare);
                    $userl2=array_diff($list12,$list2);
                    $userl1=array_diff($list2,$list12);
                    sort($userl2);
                    sort($userl1);
                    //print_r($compare);
                $z=count($compare);
                if($z<count($userl1))
                	$z=count($userl1);
                if($z<count($userl2))
                	$z=count($userl2);
                $lik="http://www.spoj.com/problems/";
                    ?>
                     <table class="table" width='100%'>
					<thead>
						<tr>
						<th><center>#</center></th>
           				<th><center>Comman Problems</center></th>
           				<th><center><?php echo "Problems only by ".$coder1; ?></center></th>
           				<th><center><?php echo "Problems only by ".$coder2; ?></center></th>
           				</tr>

           				</thead>
           				<tbody>
                    <?php
                     
                     for($i=0;$i<$z;$i++)
                     {
                     		?>  
                     				<tr>
						 		 	<center>
						 		 	<td><center><?php echo $i+1; ?></center></td>
						 		 	<?php
						if(isset($compare[$i]))
							{
								?>
									
						 		 	<td><center><font style="color : blue"> 
                              		<a href="<?php echo $lik.$compare[$i];  ?>" target="_blank">
                                			<?php echo $compare[$i] ?>
                                			</a></font></center></td>
						 		 	
						 		 	
						 		 	<?php
							}else {
								?> <td><center>----</center></td>
								<?php 
							}	
							
					
						?>
						

                   
                     	<!--<center><h3>
                     	<?php //echo "Problems only by ".$coder1; ?></h3></center>
                   <table class="table" width='70%'>
					<thead>
						<tr>
						<th><center>#</center></th>
           				<th><center>PId</center></th>
           				</tr>

           				</thead>
           				<tbody>-->
           				<?php
           			
           			  
           			
						if(isset($userl1[$i]))
							{
								?>
								
						 		 	
						 		 <!--	<td><center><?php //echo $i+1; ?></center></td> -->
						 		 	<td><center><font style="color : blue"> 
                              		<a href="<?php echo $lik.$userl1[$i];  ?>" target="_blank">
                                			<?php echo $userl1[$i] ?>
                                			</a></font></center></td>
						 		 	
						 		 	
						 		 	<?php
							}	
							else {
								?> <td><center>----</center></td>
								<?php 
							}	
						
				
						?>
						

                    <?php
                     if(isset($userl2[$i]))
                     	{
                     		?>
                   <!-- <center><h3>
                     	<?php// echo "Problems only by ".$coder2; ?></h3></center>
                   <table class="table" width='70%'>
					<thead>
						<tr>
						<th><center>#</center></th>
           				<th><center>PId</center></th>
           				</tr>

           				</thead>
           				<tbody> -->
           			
								
						 		 	
						 	<!--	 	<td><center><?php// echo $i+1; ?></center></td> -->
						 		 	<td><center><font style="color : blue"> 
                              		<a href="<?php echo $lik.$userl2[$i];  ?>" target="_blank">
                                			<?php echo $userl2[$i] ?>
                                			</a></font></center></td>
						 		 	</center></tr>
						 		 	<?php
							}
							else {
								?> <td><center>----</center></td></tr>
								<?php 
							}		
							
						}
				
						?>
						</tbody>
						</table>
						<?php
						}
?>	   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	</body>
</html> 
