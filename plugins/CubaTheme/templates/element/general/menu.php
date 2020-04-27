<?php 
use Cake\Core\Configure;

$mainCTA = __d('default', 'Contactar choferes en Cuba');
if(isset($cta)) $mainCTA = $cta;
?>

<section class="menu cid-r8XWEle1z2" once="menu" id="menu1-0">

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm bg-color transparent">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <?php echo $this->Html->link($this->Html->image('logo37.png', array('alt'=>'Yo Te Llevo Cuba logo', 'style'=>'height:3.8rem')), '/'.Configure::read('App.language'), array('escape'=>false));?>
                </span>
                <span class="navbar-caption-wrap">
                    <?php echo $this->Html->link('YO TE LLEVO - CUBA', '/'. Configure::read('App.language'), array('class'=>'navbar-caption text-white display-4'));?>
                </span>
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <?php echo $this->element('widget/lang-link')?>
                    </li>
                </ul>
                
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <?php echo $this->Html->link(__d('default', 'Opiniones'), array('controller'=>'testimonials', 'action'=>'featured', '?'=>array('also'=>Configure::read('App.language') == 'es'?'en':'es')), array('class'=>'nav-link link text-white display-4', 'escape'=>false)); ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-white dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="false">
                        + <?php echo __('Servicios')?>
                    </a>
                    <div class="dropdown-menu">
                        <?php echo $this->Html->link(__('Taxi privado con descuentos'), array('controller'=>'discount_rides', 'action'=>'home'), array('class'=>'text-white dropdown-item display-4')); ?>
                        <a class="text-white dropdown-item display-4" href="https://pickocar.com/<?php echo Configure::read('Config.language');?>" aria-expanded="true" target="_blank"><?php echo __('Taxi compartido en PickoCar')?></a>
                    </div>
                </li>
            </ul>
            <div class="navbar-buttons mbr-section-btn">
                <a class="btn btn-sm btn-secondary display-4" href="#<?php echo __d('default', 'solicitar')?>">
                    <span class="mbri-cust-feedback mbr-iconfont mbr-iconfont-btn"></span>
                    <?php echo __d('default', $mainCTA)?>
                </a>
            </div>
            
            <?php if(!$isUserLoggedIn):?>
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <?php echo $this->Html->link('<span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span> '.__('Entrar'), array('controller' => 'users', 'action' => 'login'), array('class' => 'nav-link link text-white display-4', 'rel'=>'nofollow', 'escape'=>false)) ?>
                </li>
            </ul>
            <?php endif?>
            
        </div>
    </nav>
</section>