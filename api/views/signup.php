<!doctype html>
<html class="no-js" lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sparkies Dinning Hall Survey</title>
      <link rel="stylesheet" href="/assets/css/foundation.css">
      <script src="/assets/js/vendor/modernizr.js"></script>
    <meta class="foundation-data-attribute-namespace"><meta class="foundation-mq-xxlarge"><meta class="foundation-mq-xlarge-only"><meta class="foundation-mq-xlarge"><meta class="foundation-mq-large-only"><meta class="foundation-mq-large"><meta class="foundation-mq-medium-only"><meta class="foundation-mq-medium"><meta class="foundation-mq-small-only"><meta class="foundation-mq-small">
	<link rel="stylesheet" href="/assets/css/font-awesome.min.css">
	<style>
		.switch-on { position: absolute;left: -55px;top: 10px; color: white;font-weight: bold;font-size: 9px; }
		.switch-off {position: absolute; left: -25px;top: 10px;color: white;font-weight: bold;font-size: 9px;}
		.switch label { background-color:#E1D819; }
		label {padding: 0 0 20px 0;}
		
	</style>
	<meta class="foundation-mq-topbar">
</head>
    <body>


      <div class="row">
        <div class="large-8	 large-centered medium-12 medium-centered small-12 small-centered columns">
          <!-- Grid Example -->

         
          <div class="row">
			  	<div class="large-12 medium-12 columns">
		          	 <h3>Sparkies Dinning Hall Survey</h3>
		            <hr>
				</div>
          </div>
        <?php if(isset($success)):?>
			<h5 style="color: #007BA4">Thanks for completing this survey! The information you provided will help us improve dinning here.</h5>
		<?php else:?>
          <h5>Dear Student, We Need Your Help!<br>Our team is conducting marketing research to better understand how satisfied Merrimack Students are with Sodexo in Sparkies. The research will be conducted through the collection of questionnaires. This questionnaire is anonymous, so please answer honestly.<br>Thanks for you time!</h5>
		  
		  <?php if(isset($fail)) :?><h5 style="color:#ff0000">Please complete the entire form. <br>If you keep having issues contact, Ryan: kacenskir@merrimack.edu</h5><?php endif?>
			  <hr/>
          <form style="padding-top: 20px;" action="" name="survey" method="post" enctype="application/x-www-form-urlencoded">
            <div class="row">
              <div class="large-12 columns">
				<div class="row">
					<div class="medium-6 columns">
						<label>Have you ever eaten at Sparkies?</label>
					</div>
					<div class="medium-6 columns switch round">
					  <input name="ever_eaten" id="yes-no" type="checkbox" value="1" checked>
					    <label for="yes-no">
					      <span class="switch-on">Yes</span>
					      <span class="switch-off">No</span>
					  </label>
					</div>
				</div>
				
				<hr/> 
				
				<div id="regular">
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>What meal plan do you have?</label>
		                </div>
		                <div class="medium-6 columns">
		                 <select name="meal_plan">
		 					<option value="0" default>No meal plan</option>
		                   <option value="5">5 meals</option>
		                   <option value="9">9 meals</option>
		 				  <option value="13">13 meals</option>
						  <option value="19">19 meals</option>
		                 </select>
		              	</div>
					</div>
			
					<hr/> 
				  
								
					<div class="row collapse">
		                <div class="medium-6 columns">
		                  <label>When did you first start eating at Sparkies?</label>
		                </div>
		                <div class="medium-6 columns collapse">
							<div class="small-5 columns">
		                		<select name="first_eat_semester">
									<option value="0" default>Semester</option>
		 							<option value="1" default>Fall</option>
		                   			<option value="2">Spring</option>
		                 		</select>
					 		</div>
							<div class="small-5 columns">
		                 	   <select name="first_eat_year">
								   <option value="0" default>Year</option>
		 						   <option value="2012" >2012</option>
		                   		   <option value="2013">2013</option>
		 						   <option value="2014" >2014</option>
		                   		   <option value="2015">2015</option>
		                 	   </select>
					 		</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>What’s your favorite meal of the day?</label>
		                </div>
		                <div class="medium-6 columns">
		                 <select name="favorite_meal">
		 					<option value="0" default>Select one:</option>
		                   	<option value="1">Breakfast</option>
		                   	<option value="2">Lunch</option>
		 				  	<option value="3">Dinner</option>
		                 </select>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>In your time eating at Sparkies, what direction has the food quality gone?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="slider" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="food_quality">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="slider-val" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>I would prefer to serve myself at the deli station rather than having an employee prepare my food for me:</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="deli-slider" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="deli_station">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="deli-val" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with Cleaniness?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-1" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="cleaniness">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-1" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with the amount of food options?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-2" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="food_options">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-2" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with the Protein options (chicken, steak, pork)?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-3" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="protein">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-3" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with the Vegetarian options?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-4" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="vegetarian">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-4" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
				
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with the staff's friendliness?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-5" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="friendliness">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-5" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>How satisfied are you with freshness & taste of food?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="satisfaction-slider-6" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="freshness">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="satisfaction-val-6" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					
					
				</div>
				
				<div id="newbie" >
					
					<div class="row">
		                <div class="medium-6 columns">
		                  <label>What is the reputation you have heard about the food quality at Sparkies?</label>
		                </div>
		                <div class="medium-6 columns">
							<div class="small-1 columns"><i class="fa fa-frown-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="small-10 columns">
								<div id="reputation-slider" class="range-slider" data-slider data-options="start: 1; end: 5;">
								  <span class="range-slider-handle" role="slider" tabindex="0"></span>
								  <span class="range-slider-active-segment"></span>
								  <input type="hidden" name="reputation">
								</div>
							</div>
							<div class="small-1 columns"><i class="fa fa-smile-o" style="font-size: 24px; padding: 15px 0px 0px;"></i></div>
							<div class="row">
								<div class="small-12 columns ">
									<p id="reputation-val" class="text-center"></p>
								</div>
							</div>
		              	</div>
					</div>
					
					<hr/>
					
					<div class="row">
						<div class="medium-6 columns">
							<label>Would you try a free meal at Sparkies?</label>
						</div>
						<div class="medium-6 columns switch round">
						  <input id="free-meal" type="checkbox" value="1" name="free_meal" checked>
						    <label for="free-meal">
						      <span class="switch-on">Yes</span>
						      <span class="switch-off">No</span>
						  </label>
						</div>
					</div>
					
					<hr/>
					
					
				</div>
				
				<div class="row collapse">
	                <div class="medium-6 columns">
	                  <label>What is your anticipated graduation year?</label>
	                </div>
	                <div class="medium-6 columns collapse">
						<div class="small-5 columns">
	                		<select name="graduation_semester">
								<option value="" default>Semester</option>
	 							<option value="1" default>Fall</option>
	                   			<option value="2">Spring</option>
	                 		</select>
				 		</div>
						<div class="small-5 columns">
	                 	   <select name="graduation_year">
							   <option value="" default>Year</option>
							   <option value="2015" >2015</option>
	 						   <option value="2016" >2016</option>
	                   		   <option value="2017">2017</option>
	 						   <option value="2018" >2018</option>
	                   		   <option value="2019">2019</option>
							   <option value="2020">2020</option>
	                 	   </select>
				 		</div>
	              	</div>
				</div>
				
				<hr/>
				
				<div class="row">
	                <div class="medium-6 columns">
	                  <label>Are you a commuter or resident student?</label>
	                </div>
	                <div class="medium-6 columns">
	                 <select name="resident" id="student-type">
	 					<option value="" default>Select one:</option>
	                   <option value="1">Resident</option>
	                   <option value="2">Commuter</option>
	 				  <option value="3">Non student</option>
	                 </select>
	              	</div>
				</div>
				
				<hr/>
				
				<div class="row">
	                <div class="small-3 columns small-centered">
						<input type="submit" class="button text-center" value="Submit Survey">
					</div>
				</div>
				
			</div>
				
            </div>
            
			
          </form>
		 <?php endif?>
        </div>     

      
      </div>
    
      <script src="/assets/js/vendor/jquery.js"></script>
      <script src="/assets/js/foundation.min.js"></script>
      <script>
        $(document).foundation();
		$( document ).ready(function() {
			
			
			$("#yes-no").click(function(){
				if($("#yes-no").is(':checked')){
					$("#regular").show();
					$("#newbie").hide();
				} else {
					$("#regular").hide();
					$("#newbie").show();
				}
			});
		
			var emotion = new Array("", "Much worse", "Worse", "No Change", "Better", "Much better"); 
		
			$('#slider').on('change.fndtn.slider', function(){
				var val = $('#slider').attr('data-slider');
				$('#slider-val').text(emotion[val]);
			
			});
		
			var reputation = new Array("", "Very poor", "Poor", "Fair", "Good", "Very Good"); 
		
			$('#reputation-slider').on('change.fndtn.slider', function(){
				var val = $('#reputation-slider').attr('data-slider');
				$('#reputation-val').text(reputation[val]);
			
			});
			
			var agree = new Array("", "Strongly Disagree", "Disagree", "Neutral", "Agree", "Strongly Agree"); 
			
			$('#deli-slider').on('change.fndtn.slider', function(){
				var val = $('#deli-slider').attr('data-slider');
				$('#deli-val').text(agree[val]);
			
			});
			
			var satisfaction = new Array("", "Very Dissatisfied ", "Dissatisfied", "Neutral", "Satisfied", "Very Satisfied"); 
			
			$('#satisfaction-slider-1').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-1').attr('data-slider');
				$('#satisfaction-val-1').text(satisfaction[val]);
			
			});
			
			$('#satisfaction-slider-2').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-2').attr('data-slider');
				$('#satisfaction-val-2').text(satisfaction[val]);
			
			});
			
			$('#satisfaction-slider-3').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-3').attr('data-slider');
				$('#satisfaction-val-3').text(satisfaction[val]);
			
			});
			
			$('#satisfaction-slider-4').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-4').attr('data-slider');
				$('#satisfaction-val-4').text(satisfaction[val]);
			
			});
			
			$('#satisfaction-slider-5').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-5').attr('data-slider');
				$('#satisfaction-val-5').text(satisfaction[val]);
			
			});
			
			$('#satisfaction-slider-6').on('change.fndtn.slider', function(){
				var val = $('#satisfaction-slider-6').attr('data-slider');
				$('#satisfaction-val-6').text(satisfaction[val]);
			
			});
		});
		
		
		
      </script>
  

  </body>
</html>