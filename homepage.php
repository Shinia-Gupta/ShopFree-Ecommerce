<?php
date_default_timezone_set('Asia/Dhaka');
require_once 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html lang="en">
   <head>

	<br>
	<br>
	<br>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Aresa Chatbot</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link href="style.css" rel="stylesheet">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>

<style>
body 
{
  background-image: url('https://media.istockphoto.com/id/1403848173/vector/vector-online-chatting-pattern-online-chatting-seamless-background.jpg?s=612x612&w=0&k=20&c=W3O15mtJiNlJuIgU6S9ZlnzM_yCE27eqwTCfXGYwCSo=' );
   background-repeat: repeat;
  background-attachment: fixed;
  /* background-size: 100% 100%; */
}


.showQuery{
	display:none;
}

.queryList{
	background-color: rgba(0, 0, 0, 0.7); 
    color: white; 
    padding: 10px; 
    border-radius: 10px;
}

.queryList li{
	font-size:20px;

}
</style>
   <body>
      <div class="container">
         <div class="row justify-content-md-center mb-8">
            <div class="col-md-8">
            	<form class="myform" action="homepage.php" method="post">
			<input name="logout" type="submit" id="logout_btn" value="Back to ShopFree"/><br>
			
		</form>
		
		<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header('location:index.php');
			}
		?>
               <!--start code-->
               <div class="card">
                  <div class="card-body messages-box">
					 <ul class="list-unstyled messages-list">
							<?php
							$sql = "SELECT * FROM tbl_message";
							$stmt = $db->prepare($sql);
							$stmt->execute();
							if($stmt->rowCount()>0){
								$content='';
								while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									$message = $row['message'];
									$added_on = $row['added_on'];
									$strtotime = strtotime($added_on);
									$time = date('h:i A',$strtotime);
									$type = $row['type'];
									if($type == 'user'){
										$class = "messages-me";
										$imgAvatar = "user_avatar.png";
										$name = "Me";
									}else{
										$class="messages-you";
										$imgAvatar="bot_avatar.png";
										$name="Chatbot";
									}
									$content .= '<li class="'.$class.' clearfix"><span class="message-img"><img src="image/'.$imgAvatar.'" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">'.$name.'</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'.$time.'</span></small> </div><p class="messages-p">'.$message.'</p></div></li>';
								}
								//echo $html;
							}else{
								?>
								<li class="messages-me clearfix start_chat">
								   Hello User! How can I help?
								</li>
								<?php
							}
							$stmt->closeCursor();
							?>
                    
                     </ul>
                  </div>
                  <div class="card-header">
                    <div class="input-group">
					   <input id="input-me" type="text" name="messages" class="form-control input-sm" placeholder="Type your message here..." />

					   <span class="input-group-append">
					   <input type="button" class="btn btn-primary" value="Send" onclick="send_msg()">
					   </span>
					</div> 
                  </div>
               </div>
			   <button style='background-color:#037BFC; padding:10px;border-radius:5px;margin-top:20px;color:white;border:none ' onclick='showQueries()'>User Help</button>
			   <div class="showQuery" >
			   <ul class='queryList'>
    <li>What products do you offer?</li>
    <li>Can you tell me about your company?</li>
    <li>How can I contact customer support?</li>
    <li>Do you offer international shipping?</li>
    <li>How can I track my order?</li>
    <li>Can I return or exchange a product?</li>
    <li>What payment methods do you accept?</li>
    <li>Do you offer free shipping?</li>
    <li>How can I create an account?</li>
    <li>What is your return policy?</li>
    <li>Can I cancel my order?</li>
    <li>How do I change my shipping address?</li>
    <li>Do you have a loyalty program?</li>
    <li>Are your products eco-friendly?</li>
    <li>What sizes do your clothing items come in?</li>
    <li>How can I unsubscribe from your newsletter?</li>
    <li>Do you offer gift wrapping?</li>
    <li>Can I track my order without an account?</li>
    <li>What is your price match guarantee?</li>
    <li>How do I apply a coupon code?</li>
    <li>Are your products cruelty-free?</li>
    <li>Do you offer wholesale pricing?</li>
    <li>What security measures do you have in place to protect my personal information?</li>
    <li>How can I leave a product review?</li>
    <li>Do you offer gift cards?</li>
    <li>Can I place an order over the phone?</li>
    <li>What is your shipping policy?</li>
    <li>Do you offer express shipping?</li>
    <li>Are your products made in the USA?</li>
    <li>How can I check the status of my order?</li>
    <li>Do you offer price adjustments?</li>
    <li>What is your email newsletter about?</li>
    <li>Can I ship to multiple addresses in one order?</li>
    <li>How can I reset my password?</li>
    <li>What is your privacy policy?</li>
    <li>Do you offer installation services for your products?</li>
    <li>Can I change or cancel my order after it has been placed?</li>
    <li>Do you offer expedited shipping options?</li>
</ul>


			   </div>
               <!--end code--> 
            </div>
         </div>
      </div>
      <script type="text/javascript">
		 function getCurrentTime(){
			var now = new Date();
			var hh = now.getHours();
			var min = now.getMinutes();
			var ampm = (hh>=12)?'PM':'AM';
			hh = hh%12;
			hh = hh?hh:12;
			hh = hh<10?'0'+hh:hh;
			min = min<10?'0'+min:min;
			var time = hh+":"+min+" "+ampm;
			return time;
		 }
		 const queryDiv=document.querySelector('.showQuery');
		 function showQueries(){
			if(queryDiv.style.display=='none'){
				queryDiv.style.display='block';
			}else{
				queryDiv.style.display='none';
			}
		 }
		 function send_msg(){
			jQuery('.start_chat').hide();
			var txt=jQuery('#input-me').val();
			var html='<li class="messages-me clearfix"><span class="message-img"><img src="image/user_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'+getCurrentTime()+'</span></small> </div><p class="messages-p">'+txt+'</p></div></li>';





			jQuery('.messages-list').append(html);
			jQuery('#input-me').val('');
			if(txt){
				jQuery.ajax({
					url:'get_bot_message.php',
					type:'post',
					data:'txt='+txt,
					success:function(result){



						var html='<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_avatar.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'+getCurrentTime()+'</span></small> </div><p class="messages-p">'+result+'</p></div></li><a href="invalidans.php" id="invalid_btn"><i></i></a>';
						
						jQuery('.messages-list').append(html);
						jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);
					}
				});
			}
		 }
      </script>
   </body>
</html>