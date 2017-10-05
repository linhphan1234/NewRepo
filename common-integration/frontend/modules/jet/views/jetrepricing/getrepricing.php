<?php 
use yii\helpers\Html;
	$succes_img = yii::$app->request->baseUrl.'/frontend/images/batchupload/fam_bullet_success.gif';
	$error_img = yii::$app->request->baseUrl.'/frontend/images/batchupload/error_msg_icon.gif';
	$loader_img = yii::$app->request->baseUrl.'/frontend/images/batchupload/rule-ajax-loader.gif';
	
	$url=\yii\helpers\Url::toRoute(['jetrepricing/startbatchupdate']);
	$dataUrl=\yii\helpers\Url::toRoute(['jetrepricing/getrepricingdata']);
	$productUrl = \yii\helpers\Url::to(Yii::$app->request->referrer);
	
?>
<style type="text/css" >
   .shopify-api ul { list-style-type:none; padding:0; margin:0; }
   .shopify-api ul li { margin-left:0; border:1px solid #ccc; margin:2px; padding:2px 2px 2px 2px; font:normal 12px sans-serif; }
   .shopify-api img { margin-right:5px; }
   li span ul li{
   	border : 0px !updateant;
   	margin-left:18px !updateant;
   }
</style>
<div class="row">
	<div class="col-md-12" style="margin-top: 10px;">
		<div class="panel panel-default form new-section">
				<div class="jet-pages-heading">
					<div class="title-need-help">
						<h1 class="Jet_Products_style">Fetch Marketplace Pricing</h1>
					</div>
					<div class="product-upload-menu">
						<a href="<?= $productUrl;?>">
							<button class="btn btn-primary uptransform" type="button" title="Back"><span>Back</span></button>
						</a>
					</div>
					<div class="clear"></div>
				</div>
			<div class="block-content panel-body shopify-api ">			
				<ul class="warning-div" style="margin-top: 18px">
					<li style="background-color:#Fff;">
						<img src="<?php echo yii::$app->request->baseUrl.'/frontend/images/batchupload/note_msg_icon.gif';?>" class="v-middle" style="margin-right:5px"/>
						Fetching marketplace pricing, please wait...
					</li>
					<li style="background-color:#FFD;">
						<img src="<?php echo yii::$app->request->baseUrl.'/frontend/images/batchupload/fam_bullet_error.gif';?>" class="v-middle" style="margin-right:5px"/>
						Warning: Please do not close the window during fetch data
					</li>
				</ul>
				<ul id="loadingRow">
					<li style="background-color:#DDF;" id="loadingLi">
						<img class="v-middle" src="<?php echo $loader_img ?>">
						<span class="text">Fetching from Jet...</span>
					</li>
				</ul>	
				<ul style="display:none;" id="profileRows">
					<li style="background-color:#DDF; ">
						<img class="v-middle" src="<?php echo $succes_img ?>">
						<span id="total_record_span"></span>
					</li>
					<li style="background-color:#DDF;" id="update_row">
						<img class="v-middle" id="status_image" src="<?php echo $loader_img ?>">
						<span id="update_status" class="text">Fetching...</span>
					</li>
					<li id="liFinished" style="display:none;background-color:#Fff;">
						<img src="<?php echo yii::$app->request->baseUrl.'/frontend/images/batchupload/note_msg_icon.gif';?>" class="v-middle" style="margin-right:5px"/>
						Execution finished.
					</li>
				</ul>
			</div>
		</div>     
	</div>
</div>
<script type="text/javascript"> 
	var csrfToken = $('meta[name=csrf-token]').attr("content");
	var totalRecords = 0;
	var jsonData ;
	var parsed;
	var pages = 0;
	var countOfSuccess = 0;
	var notSku=0;
	var id = 0;
	var my_id = document.getElementById('liFinished');	
	var update_status = document.getElementById('update_status');
	var update_row = document.getElementById('update_row');
	var status_image = document.getElementById('status_image');
	var loadingLi = document.getElementById('loadingLi');
	var loadingRow = document.getElementById('loadingRow');
	var total_record_span = document.getElementById('total_record_span');
	var profileRows = document.getElementById('profileRows');
	startGetSalesData();
	function startGetSalesData(){
		$.ajax({
            url:"<?= $dataUrl?>",
            method: "post",
            dataType:'json',
            data:{_csrf : csrfToken},
        	success: function(json) {
            	if(json.jsonData){
					jsonData = json.jsonData;
					parsed = jsonData;
					totalRecords = parseInt(json.totalcount);
					pages = parseInt(json.pages);
					/*console.log(typeof parsed);
					console.log(parsed);
					console.log(totalRecords);
					console.log(pages);*/
					$(loadingRow).remove();	
					$(total_record_span).html('Total '+totalRecords+' Sku(s) Found.');
					$(profileRows).css('display', 'block');
					uploaddata();									
				}
				if(json.error)
				{
					var span = document.createElement('li');
					span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">'+json.error+'</span>';
					span.id = 'id-'+id;
					span.style = 'background-color:#FDD';
					$(loadingLi).remove();
					loadingRow.appendChild(span);
				}
				
            },
			error: function()
			{
				var span = document.createElement('li');
				span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">Something Went Wrong.</span>';
				span.id = 'id-'+id;
				span.style = 'background-color:#FDD';
				$(loadingLi).remove();
				loadingRow.appendChild(span);
			}
		});	
	}
	function uploaddata(){
		percent = getPercent();
		update_status.innerHTML = percent+'% of total sku(s) '+totalRecords+' Processing';
		var data = "";
		var length = 0;
		if(parsed.length>0){
			length = Object.keys(parsed[id]).length//  parsed[id].length;
			data = JSON.stringify(parsed[id]);
		}
		console.log(data);
		console.log(length);
		$.ajax({
            url:"<?= $url?>",
            method: "post",
            dataType:'json',
            data:{ index : id,_csrf : csrfToken,data : data},
        	success: function(json) {
            	id++;
				if(json.success){
					var noData = 0;
					if(json.no_data.length>0){
						noData = json.no_data.length;
					}
					countOfSuccess += length;
					var span = document.createElement('li');
					if(noData>0){
						span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span class="text">'+(length-noData)+' sku(s) marketplace pricing fetched & '+noData+' sku(s) data not found...</span>';
					}else{
						span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span class="text">'+length+' sku(s) marketplace pricing fetched...</span>';
					}
					span.id = 'id-'+id;
					span.style = 'background-color:#DDF';
					update_row.parentNode.insertBefore(span, update_row);									
				}
				if(json.error)
				{
					var span = document.createElement('li');
					span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">'+json.error+'</span>';
					span.id = 'id-'+id;
					span.style = 'background-color:#FDD';
					update_row.parentNode.insertBefore(span, update_row);
				}
				if(id < pages){
					uploaddata();
				}else{
					status_image.src = '<?php echo $succes_img ?>';
					var span = document.createElement('li');
					span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span id="update_status" class="text">'+countOfSuccess+' sku(s) marketplace pricing Successfully fetched.'+'</span>';
					
					span.style = 'background-color:#DDF';
					my_id.parentNode.insertBefore(span, my_id);
					document.getElementById("liFinished").style.display="block";
					$(".warning-div").hide();
					$("#profileRows").css({'margin-top':'10px'});
					update_status.innerHTML = percent+'% sku(s) Processed.';					
				}
            },
			error: function()
			{
				id++;
				var span = document.createElement('li');
				span.innerHTML = '<img class="v-middle" src="<?php echo $error_img ?>"><span class="text">Something Went Wrong </span>';
				span.id = 'id-'+id;
				span.style = 'background-color:#FDD';
				update_row.parentNode.insertBefore(span, update_row);
				
				if(id < pages){
					uploaddata();
				}else{
					status_image.src = '<?php echo $succes_img ?>';
					var span = document.createElement('li');
					span.innerHTML = '<img class="v-middle" src="<?php echo $succes_img ?>"><span id="update_status" class="text">'+countOfSuccess+' sku(s) marketplace pricing Successfully fetched.'+'</span>';
					span.style = 'background-color:#DDF';
					my_id.parentNode.insertBefore(span, my_id);
					$(".warning-div").hide();
					$("#profileRows").css({'margin-top':'10px'});
					document.getElementById("liFinished").style.display="block";
				}
			}
		});		
	}

	function getPercent() 
	{		
       return Math.ceil(((id+1)/pages)*1000)/10;
    }	
</script>