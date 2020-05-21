<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;


setlocale(LC_ALL, "en_US.utf8");


?>
<?php
$userLoggedIn = true;
$userRole = 'admin'

?>
  
<?php $lang = Configure::read('App.language');?>


<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>YoTeLlevoCuba | Panel de Administración</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!--<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400|Montserrat:400,700" rel="stylesheet">-->
	
	<!-- Animate.css -->
	<?= $this->Html->css("theme/css/animate.css") ?>
	<!-- Icomoon Icon Fonts-->
	
	<!-- Bootstrap  -->
	<?= $this->Html->css("theme/css/bootstrap.min.css") ?>
        <!-- FontAwesome  -->
	<?= $this->Html->css("font-awesome/css/font-awesome.min.css") ?>
        
        <!-- FooTable -->
        <?= $this->Html->css("theme/css/plugins/footable/footable.core.css") ?>

	<!-- Morris -->
        <?= $this->Html->css("theme/css/plugins/morris/morris-0.4.3.min.css") ?>

	<!-- Admin Theme style  -->
	<?= $this->Html->css("theme/css/style.css") ?>
        
        <!-- Sweet alert  -->
	<?= $this->Html->css("sweetalert/sweetalert.min.css") ?>
        
        <!-- iCheck  -->
	<?= $this->Html->css("theme/css/plugins/iCheck/custom.css") ?>
        
        <!-- Jasny  -->
	<?= $this->Html->css("theme/css/plugins/jasny/jasny-bootstrap.min.css") ?>
        
        <!--Datepicker-->
        <?= $this->Html->css('datepicker/css/datepicker'); ?>
        
        
        
        <!-- jQuery -->
	<?= $this->Html->script("theme/js/jquery-3.1.1.min.js") ?>
	
	<!-- Bootstrap -->
	<?= $this->Html->script("theme/js/bootstrap.min.js") ?>        
        
        
        <?= $this->Html->script('datepicker/js/datepicker'); ?>
        
        <?= $this->Html->script('jquery-validation-1.10.0/dist/jquery.validate.min', array('inline' => false));?>
        
        <?php echo $this->fetch('scripts'); ?>
        
        <!-- Admin Main -->        
        <?= $this->Html->script("theme/js/plugins/metisMenu/jquery.metisMenu.js") ?>
        <?= $this->Html->script("theme/js/plugins/slimscroll/jquery.slimscroll.min.js") ?>  
         <!-- FooTable -->
        <?= $this->Html->script("theme/js/plugins/footable/footable.all.min.js") ?>
        
        <!-- Morris -->
    <?= $this->Html->script("theme/js/plugins/morris/raphael-2.1.0.min.js") ?>
    <?= $this->Html->script("theme/js/plugins/morris/morris.js") ?>
        
	<?= $this->Html->script("theme/js/inspinia.js") ?>
        <?= $this->Html->script("theme/js/plugins/pace/pace.min.js") ?>
        
        <script>
        $(document).ready(function(){
            
            /*Logica para el mensaje directo en conv. cerrada*/
                $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                /*language: '<?php /*echo Configure::read('Config.language')*/?>',*/
                startDate: 'today',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
            });

            /*$('#CDirectForm').validate({
                wrapper: 'div',
                errorClass: 'text-danger',
                errorElement: 'div'
            });*/


            $('#CDirectForm').submit(function () {
               /* if (!$(this).valid())
                    return false;*/

                //$('#TravelForm :input').prop('disabled', true);
                //$('#TravelFormDiv').prop('disabled', true);

                $('#CDirectSubmit').attr('disabled', true);
                $('#CDirectSubmit').val('<?php echo __d('mobirise/default', 'Espera')?> ...');
            });
               /*---------------------------------------------------------------------------------*/ 
                $.each($('.info'), function(pos, obj) {
                    var placement = 'bottom';
                    if($(obj).attr('data-placement') !== undefined) placement = $(obj).attr('data-placement');
                    $(obj).tooltip({placement:placement, html:true});
                });
                
                //$('.info').tooltip({placement:'bottom', html:true});
                });
         </script>
	

	
        <?php
          $dir = "";
            echo "<script> home ='$dir'; </script>";
        ?>
	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                                <img alt="image" class="img-circle" src="<?php /*if($this->request->session()->read('Auth.User')['id']!=null) echo $this->request->webroot."/img/users/".$this->request->session()->read('Auth.User')['id'].".jpg"; else echo $this->request->webroot."img/avatar.png" */?>" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold"><?php /*echo $this->request->session()->read('Auth.User')['name']*/ ?></strong>
                                    </span>
                                    <!--<span class="text-muted text-xs block">Art Director <b class="caret"></b></span>-->
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>                                
                                <li class="divider"></li>
                                <?php if($userLoggedIn): ?>
                                <li><a href="users/logout">Logout</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="logo-element">
                            YTL
                        </div>
                    </li>
                    <?php if( ($userLoggedIn && $userRole === 'admin') ):?>
                    <li id="main" class="active">
                        <a href="admin">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Administraci&oacute;n</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li id="panel"><a href="admin">Index</a></li>
                            <li id="users"><a href="users">Users</a></li>
                            <li id="roles"><a href="roles">Roles</a></li>                            
                        </ul>
                    </li>
                    <li id="members">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Equipo</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="all-members"><a href="team">View all</a></li>                                              
                        </ul>
                    </li> 
                    <?php endif; ?>
                    <?php if( ($userLoggedIn && ($userRole === 'operator' || $userRole === 'admin') ) ):?>
                    <li id="messages">
                        <a href="contact">
                            <i class="fa fa-envelope"></i>
                            <span class="nav-label">Conversaciones </span>
                            <?php if(strpos($this->request->getData('page'),'administration')): ?>
                            <span class="label label-warning pull-right"><?php echo $total_unread_messages; ?></span>
                            <?php else: ?>
                            <span class="fa arrow"></span>
                            <?php endif; ?>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <li id="inbox"><a href="ontact">Inbox</a></li>                            
                            <li id="unread"><a href="contact/view_unread">Unread email</a></li>                            
                        </ul>
                    </li>                    
                    <li id="testimonials">
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Testimonios</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="all"><a href="testimonials">View all</a></li>                            
                            <li id="filtered"><a href="testimonials/view_filtered">View rejected</a></li>                            
                        </ul>
                    </li>                    
                    <li id="works">
                        <a href="#"><i class="fa fa-car"></i> <span class="nav-label">Viajes</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li id="all-works"><a href="work">View all</a></li>                         
                                                        
                        </ul>
                    </li>                    
                 <?php endif; ?>                
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
                        <div class="minimalize-styl-2"><a href="/" target="_blank"><span style="color: #FFF" class="fa fa-2x fa-home" title="Go to landing page"></span></a></div>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Panel de Administraci&oacute;n</span>
                        </li>
                        <?php if(strpos($this->request->getData('page'),'administration')): ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning"><?php echo $total_unread_messages; ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                             <?php foreach($unread_messages as $unread): ?>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="contact" class="pull-left">
                                            <span class="fa fa-envelope fa-3x"></span>
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right"><b><?php echo TimeUtil::daysFrom($unread->created) ?> day(s) ago</b></small>
                                            <strong><?=h($unread->mfrom) ?></strong> sent you a message. <br> <br>                                            
                                        </div>
                                    </div>
                                </li>  
                                <li class="divider"></li>
                             <?php endforeach; ?>                                
                                <li>
                                    <div class="text-center link-block">
                                        <a href="contact">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>             
                        <?php endif; ?>

                        <li>
                            <a href="users/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>                        
                    </ul>

                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="success">
                            <?php /*$this->Flash->render() */ ?>
                        </div>
                        <div class="row">                            
                            <div id="content" class="container-fluid">
                            <?php echo $this->Flash->render(); ?>
                            <?php echo $this->fetch('content'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if( ROOT != 'C:\wamp\www\yotellevo' && (!$userLoggedIn || $userRole === 'regular') ):?>
                    <!-- Google Analytics -->
                    <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                    ga('create', 'UA-60694533-1', 'auto');
                    ga('send', 'pageview');
                    </script>

                <?php endif;?>   
                    <div class="footer">
                        <div class="pull-right">
                            
                        </div>
                        <div>
                            <strong>Copyright</strong> YoTellevoCuba &copy; <?php echo Date("Y"); ?>
                        </div>
                    </div>
                    <script type="text/javascript">
                        function goTo(id, time, offset) {
                            $('html, body').animate({
                                scrollTop: $('#' + id).offset().top + offset
                            }, time);
                        };

                        <?php if(isset($this->request->query['highlight'])):?>
                            $(document).ready(function() {
                                goTo('<?php echo $this->request->query['highlight']?>', 500, -70);
                            });
                        <?php endif?>
                     </script>
                </div>
            </div>

        </div>
        
    </div>
        
	
        
        <!-- Peity -->
        <?= $this->Html->script("theme/js/plugins/peity/jquery.peity.min.js") ?>      
       
        
        
        <!-- jQuery UI -->
        <?php /*$this->Html->script("admin/plugins/jquery-ui/jquery-ui.min.js")*/ ?> 
        
        <!-- iCheck -->
        <?= $this->Html->script("theme/js/plugins/iCheck/icheck.min.js") ?> 
        
        <!-- jasny -->
        <?= $this->Html->script("theme/js/plugins/jasny/jasny-bootstrap.min.js") ?>
        
         <!-- Sparkline -->
         <?= $this->Html->script("theme/js/plugins/sparkline/jquery.sparkline.min.js") ?>
         
         
        
        <!-- Sweetalert -->
	<?= $this->Html->script("sweetalert/sweetalert.min.js") ?>
        
        
        
        <script type="text/javascript">                
               /*  $('.nav > li').removeClass('active');
                 $('#'+active).addClass('active');
                 $('#'+active2).addClass('active'); 
                 */
        </script>
        <script>
        $(document).ready(function(){
            
            /*Logica para el mensaje directo en conv. cerrada*/
                $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                /*language: '<?php /*echo Configure::read('Config.language')*/?>',*/
                startDate: 'today',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
            });

            /*$('#CDirectForm').validate({
                wrapper: 'div',
                errorClass: 'text-danger',
                errorElement: 'div'
            });*/


            $('#CDirectForm').submit(function () {
               /* if (!$(this).valid())
                    return false;*/

                //$('#TravelForm :input').prop('disabled', true);
                //$('#TravelFormDiv').prop('disabled', true);

                $('#CDirectSubmit').attr('disabled', true);
                $('#CDirectSubmit').val('<?php echo __d('mobirise/default', 'Espera')?> ...');
            });
               /*---------------------------------------------------------------------------------*/ 
                $.each($('.info'), function(pos, obj) {
                    var placement = 'bottom';
                    if($(obj).attr('data-placement') !== undefined) placement = $(obj).attr('data-placement');
                    $(obj).tooltip({placement:placement, html:true});
                });
                
                //$('.info').tooltip({placement:'bottom', html:true});
            
           /*Checkbox personalized and check event*/             
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            }).on('ifChanged', function(){
                
                var notification= '';
                var table = '';
            
            if(this.name=="testimonial"){
             if(this.checked)
                 var state = 'A';
             else 
                 var state = 'P'
             data = {'state':state};
             notification = 'review';
             table = 'testimonials';
          }
           if(this.name=="user"){
                if(this.checked)
                 var active = 1;
               else 
                 var active = 0;
               data = {'active':active};
               notification = 'user';
               table = 'users';
            }
            if(this.name=="team"){
                if(this.checked)
                 var active = 1;
               else 
                 var active = 0;
               data = {'active':active};
               notification = 'team member';
               table = 'team';
            }
            if(this.name=="work"){
                if(this.checked)
                 var visible = 1;
               else 
                 var visible = 0;
               data = {'visible':visible};
               notification = 'project';
               table = 'work';
            }
            
          if(this.name=="user" || this.name=="testimonial" || this.name=="team" || this.name=="work"){
           /*Logics for ajax update of testimonials and users*/
           $.ajax({
                url: home+"/"+table+"/edit/"+this.value,
                type: "POST",
                data: data,
                cache: false,
                success: function(msg) {
                    // Success message                    
                    if(msg=='true' || msg=='1'){
                    
                    swal({
                        title: "Thank you!",
                        text: "The "+notification+" have been updated! Please close this window",
                        type: "success"
                    });
                
                //clear all fields
                    $('#testimonialForm').trigger("reset");
                   }else{
                       swal({
                        title: "We sorry!",
                        text: "Sorry, the "+notification+" can't be updated, please try again",
                        type: "warning",
                        confirmButtonColor: "#DD6B55"
                    });                       
                   }

                    
                },
                error: function(msg) {
                   
                     swal({
                        title: "We're sorry!",
                        text: "Sorry, the "+notification+" can't be updated, please try again",
                        type: "warning",
                        confirmButtonColor: "#DD6B55"
                    });  
                },
            });
         }
        
          });
          
          
                 
        });
       </script>
       
       
       
	</body>
</html>