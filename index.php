<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Loan Amortization</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="css/animate.min.css" rel="stylesheet"> 
	<link href="css/animate.css" rel="stylesheet" />
	<link href="css/prettyPhoto.css" rel="stylesheet"> 
	<link href="css/style.css" rel="stylesheet">
	
    <!-- =======================================================
        Theme Name: OnePage
        Theme URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
    ======================================================= -->
  </head>
  <body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="row">
					<div class="site-logo">
						<a href="index.php" class="brand">Loan Amortization Calculator</a>
					</div>

					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
							<i class="fa fa-bars"></i>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="menu">
						<ul class="nav navbar-nav navbar-right">
							 			                                                                  								  
							 


							  <li><a href="#loan" style="color:#c92800;">To Get Your Detailed Estimate, Select Proper Type</a></li>
						</ul>
					</div>
					<!-- /.Navbar-collapse -->		 
			</div>
		</div>		
	</nav>
   

   </br></br>
	<section id="loan">
		</br></br></br>
	
        <div class="container">
            <div class="row">
                <div class="col-sm-6 wow fadeInRight">
					<img src="images/1.png" class="img-responsive" />
					



                </div><!--/.col-sm-6-->

                <div class="col-sm-6 wow fadeInDown">
                    </br></br></br>
                    
                    <div class="accordion">
                        <div class="panel-group" id="accordion1">
                          

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" style="color:#c92800;"	>
                                  Unsecured Business Loan
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
								              <div class="panel-body">
                                <form method="post" name="loancal_ubl" action="loancalculation.php">
									             <div class="row">
                				        	<div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Value :</label>
								                  	<input type="number" name="loanamtubl" placeholder="Enter Your Amount Here" class="form-control" min="10000" step="100" required/> 
									               </div>
								                 <div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Rate of Interest :</label>
								                  <input type="number" name="roi" placeholder="Rate of Interest" class="form-control" min="5" step=".01" required/>
									               </div>
									             </div>
									
									             <div class="row">
                				      	<div class="col-md-6">
										              <label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Tenure</label>  
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" value="Year" name="tentype" checked="checked" class="radiogr1">Year</input>&nbsp;&nbsp;
                                      <input type="radio" value="Month" name="tentype" class="radiogr1">Month</input>
                                    </span>
                                  <input type="number" name="tenure" id="amount1" class="form-control" min="1" step="1" required/>
                                </div>
								              	 </div>
									                <div class="col-md-6" ><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Start Date:</label>
								                	   <input type="date" name="begin" class="form-control" required/>
							               	   	</div>
									
								          	   </div>
                             <br>
                
                              <div class="row">
                                 <div class="col-md-1"></div>
                                 <input type="hidden" name="prepay" value="0" />
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Regular Prepay ?</label><input type="checkbox" name="prepay" value="1" class="form-control"/></div>

                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Prepayment Date :</label><input type="date" name="prebegin" class="form-control"/></div>

                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;"> Amount:</label><input type="text" name="preamount" class="form-control" placeholder="Amount"/></div>

                              </div>

                              <div class="row">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Frequency:</label>
                                     <select name="recur" class="form-control">
                                        <option value="0">One Time</option>
                                        <option value="4">Quaterly</option>
                                        <option value="6">Semi Anually</option>
                                        <option value="12">Anually</option>
                                     </select>

                                 </div>
                      
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">EMI/tenure:</label>
                                   <select name="prepayopt" class="form-control">
                                    <option value="tc">Tenure Fix</option>
                                     <option value="ec">EMI Fix</option>
                                  </select>

                                </div>

                            </div>

                            <div class="row">
                               <div class="col-md-1"></div>
                                  <input type="hidden" name="finprepay" value="0" />
                               <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Full Prepay ?</label>   
                                  <input type="checkbox" name="finprepay" value="1" class="form-control" /></div>

                                <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Final Prepayment Date :</label>
                                   <input type="date" name="findate" class="form-control"/></div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Foreclosure % :</label>
                                   <input type="number" name="forper" class="form-control" min="0" step=".01" value="0"/></div>   
                            </div>
                  
                            <div class="row">
                              <div class="col-md-8"> </div>
                              <div class="col-md-4"><button type="submit" value="submit" name="btn_cal_ubl" style="margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 26px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Submit</button></div>
                              
                              <input type="hidden" name="inspay" value="100" />
                               <input type="hidden" name="downpaymenthl" value="" />
                                <input type="hidden" name="downpaymentlap" value="" />
                                
                            </div>

								
                            </form>
                          </div> 
                          </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" style="color:#c92800;">
                                  Home Loan
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <form method="post" name="loancal_hl" action="loancalculation.php">
                               <div class="row">
                                  <div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Agreement Value :</label>
                                    <input type="number" name="loanamthl" placeholder="Enter Your Amount Here" class="form-control" min="10000" step="100" required/> 
                                    <input type="hidden" name="loanamtubl" value="" />
                                 </div>
                                 <div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Rate of Interest :</label>
                                  <input type="number" name="roi" placeholder="Rate of Interest" class="form-control" min="5" step=".01" required/>
                                 </div>
                               </div>

                              <div class="row">
                                <div class="col-md-6">
                                   <label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Margin Money :</label>  
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" value="Percentage" name="dpopt" checked="checked" class="downrd2">Percent</input>&nbsp;&nbsp;
                                      <input type="radio" value="Amount" name="dpopt" class="downrd2">Amount</input>
                                    </span>
                                  <input type="number" name="downpaymenthl" id="down2" class="form-control" min="1" step=".01" required/>
                                </div>
                               
                                </div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Insurance</label>  
                                <input type="text" name="loanins" class="form-control" placeholder="Amount" required/>
                                </div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Insurance Pay</label>  
                                  <select name="inspay" class="form-control">
                                        <option value="0">With Loan</option>
                                        <option value="1">Separate</option>
                                  </select>
                                </div>


                              </div>


                  
                               <div class="row">
                                <div class="col-md-6">
                                  <label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Tenure</label>  
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" value="Year" name="tentype" checked="checked" class="radiogr2">Year</input>&nbsp;&nbsp;
                                      <input type="radio" value="Month" name="tentype" class="radiogr2">Month</input>
                                    </span>
                                  <input type="number" name="tenure" id="amount2" class="form-control" min="1" step="1" required/>
                                </div>


                                 </div>
                                  <div class="col-md-6" ><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Start Date:</label>
                                     <input type="date" name="begin" class="form-control" required/>
                                  </div>
                  
                               </div>
                             <br>
                
                              <div class="row">
                                 <div class="col-md-1"></div>
                                 <input type="hidden" name="prepay" value="0" />
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Regular Prepay ?</label><input type="checkbox" name="prepay" value="1" class="form-control"/></div>

                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Prepayment Date :</label><input type="date" name="prebegin" class="form-control"/></div>

                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;"> Amount:</label><input type="text" name="preamount" class="form-control" placeholder="Amount"/></div>

                              </div>

                              <div class="row">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Frequency:</label>
                                     <select name="recur" class="form-control">
                                        <option value="0">One Time</option>
                                        <option value="4">Quaterly</option>
                                        <option value="6">Semi Anually</option>
                                        <option value="12">Anually</option>
                                     </select>

                                 </div>
                      
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">EMI/tenure:</label>
                                   <select name="prepayopt" class="form-control">
                                    <option value="tc">Tenure Fix</option>
                                     <option value="ec">EMI Fix</option>
                                  </select>

                                </div>

                            </div>

                            <div class="row">
                               <div class="col-md-1"></div>
                                  <input type="hidden" name="finprepay" value="0" />
                               <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Full Prepay ?</label>   
                                  <input type="checkbox" name="finprepay" value="1" class="form-control" /></div>

                                <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Final Prepayment Date :</label>
                                   <input type="date" name="findate" class="form-control"/></div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Foreclosure % :</label>
                                   <input type="number" name="forper" class="form-control" min="0" step=".01" value="0"/></div>   
                            </div>
                             
                            <div class="row">
                              <div class="col-md-8"> </div>
                              <div class="col-md-4"><button type="submit" value="submit" name="btn_cal_hl" style="margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 26px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Submit</button></div>
                            
                            </div>

                
                            </form>
                          </div> 
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1" style="color:#c92800;">
                                  Loan Against Property
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
								              <div class="panel-body">
                              <form method="post" name="loancal_lap" action="loancalculation.php">
                               <div class="row">
                                  <div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Market Value :</label>
                                    <input type="number" name="loanamtlap" placeholder="Enter Your Amount Here" class="form-control" min="10000" step="100" required/> 
                                     <input type="hidden" name="loanamtubl" value="" />
                                      <input type="hidden" name="loanamthl" value="" />
                                 </div>
                                 <div class="col-md-6"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Rate of Interest :</label>
                                  <input type="number" name="roi" placeholder="Rate of Interest" class="form-control" min="5" step=".01" required/>
                                 </div>
                               </div>

                               <div class="row">
                                <div class="col-md-6">
                                <label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan To Value :</label>  
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" value="Percentage" name="dpoptlap" checked="checked" class="downrd3">Percent</input>&nbsp;&nbsp;
                                      <input type="radio" value="Amount" name="dpoptlap" class="downrd3">Amount</input>
                                    </span>
                                  <input type="number" name="downpaymentlap" id="down3" class="form-control" min="1" step=".01" required/>
                                </div>

                                </div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Insurance</label>  
                                <input type="text" name="loanins" class="form-control" placeholder="Amount" required/>
                                </div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Insurance Pay</label>  
                                  <select name="inspay" class="form-control">
                                        <option value="0">With Loan</option>
                                        <option value="1">Separate</option>
                                  </select>
                                </div>


                              </div>


                  
                               <div class="row">
                                <div class="col-md-6">
                                  <label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Tenure</label>  
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" value="Year" name="tentype" checked="checked" class="radiogr3">Year</input>&nbsp;&nbsp;
                                      <input type="radio" value="Month" name="tentype" class="radiogr3">Month</input>
                                    </span>
                                  <input type="number" name="tenure" id="amount3" class="form-control" min="1" step="1" required/>
                                </div>

                                 </div>
                                  <div class="col-md-6" ><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Loan Start Date:</label>
                                     <input type="date" name="begin" class="form-control" required/>
                                  </div>
                  
                               </div>
                             <br>
                
                              <div class="row">
                                 <div class="col-md-1"></div>
                                 <input type="hidden" name="prepay" value="0" />
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Regular Prepay ?</label><input type="checkbox" name="prepay" value="1" class="form-control"/></div>

                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Prepayment Date :</label><input type="date" name="prebegin" class="form-control"/></div>

                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;"> Amount:</label><input type="text" name="preamount" class="form-control" placeholder="Amount"/></div>

                              </div>

                              <div class="row">
                                 <div class="col-md-4"></div>
                                 <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Frequency:</label>
                                     <select name="recur" class="form-control">
                                        <option value="0">One Time</option>
                                        <option value="4">Quaterly</option>
                                        <option value="6">Semi Anually</option>
                                        <option value="12">Anually</option>
                                     </select>

                                 </div>
                      
                                 <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">EMI/tenure:</label>
                                   <select name="prepayopt" class="form-control">
                                    <option value="tc">Tenure Fix</option>
                                     <option value="ec">EMI Fix</option>
                                  </select>

                                </div>

                            </div>

                            <div class="row">
                               <div class="col-md-1"></div>
                                  <input type="hidden" name="finprepay" value="0" />
                               <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Full Prepay ?</label>   
                                  <input type="checkbox" name="finprepay" value="1" class="form-control" /></div>

                                <div class="col-md-4"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Final Prepayment Date :</label>
                                   <input type="date" name="findate" class="form-control"/></div>

                                <div class="col-md-3"><label style="display: block;padding-top: 7px;font-size: 14px;line-height: 1.42857143;color: #555;">Foreclosure % :</label>
                                   <input type="number" name="forper" class="form-control" min="0" step=".01" value="0"/></div>   
                            </div>
                  
                            <div class="row">
                              <div class="col-md-8"> </div>
                              <div class="col-md-4"><button type="submit" value="submit" name="btn_cal_lap" style="margin-top: 20px; background-color: #4CAF50; /* Green */border: none;color: white;padding: 15px 26px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Submit</button></div>
                               
                           <input type="hidden" name="downpaymenthl" value="" />
                            </div>

                
                            </form>
                          </div> 
                            </div>
                          </div>
                        </div><!--/#accordion1-->
                    </div>
                    
                    
                </div>

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#about-->

    <section id="portfolio">
       <div class="container">
       <?php
        if (isset($_POST['btn_cal']))
        { 
          echo $_POST["loanamtubl"];
          echo $_POST["roi"];
          echo $_POST["test"];


        }

       ?>
       </div>

    </section>
	
	
	<footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
					<div class="text-center">
						<a href="#home" class="scrollup" style="color:#c92800;"><i class="fa fa-angle-up fa-3x"></i></a>
					</div>
                    &copy; Company Name. All Rights Reserved.
                    <div class="credits">
                       
                        <a href="#">Company Calculator</a> by <a href="#">CompanyMade</a>
                    </div>
                </div>
				
                <div class="top-bar">			
					<div class="col-lg-12">
					   <div class="social">
							<ul class="social-share">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-skype"></i></a></li>
							</ul>
					   </div>
					</div>
				</div>
			</div>
		</div>
    </footer><!--/#footer-->
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script> 
	<script src="js/wow.min.js"></script>
	<script src="js/jquery.easing.min.js"></script>	
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="js/main.js"></script>
    <script src="contactform/contactform.js"></script>
    <script>
    $('.radiogr1').change(function(e){
    var selectedValue = $(this).val();
    var amt=$('#amount1').val();
    if(selectedValue=="Year")
    $('#amount1').val(Math.round(amt/12))
    if(selectedValue=="Month")
    $('#amount1').val(Math.round(amt*12))
});

	</script>
   <script>
    $('.radiogr2').change(function(e){
    var selectedValue = $(this).val();
    var amt=$('#amount2').val();
    if(selectedValue=="Year")
    $('#amount2').val(Math.round(amt/12))
    if(selectedValue=="Month")
    $('#amount2').val(Math.round(amt*12))
});

  </script>
   <script>
    $('.radiogr3').change(function(e){
    var selectedValue = $(this).val();
    var amt=$('#amount3').val();
    if(selectedValue=="Year")
    $('#amount3').val(Math.round(amt/12))
    if(selectedValue=="Month")
    $('#amount3').val(Math.round(amt*12))
});

  </script>
    
</body>
</html>

