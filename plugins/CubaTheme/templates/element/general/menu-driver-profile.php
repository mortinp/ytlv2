<?php
use Cake\Core\Configure;
$userLoggedIn = $Auth->user()? true : false;

if($userLoggedIn) {
    $user = $Auth->user();
    $userRole = $user['role'];
    $pretty_user_name = User::prettyName($user, true);
}
?>

<?php 
    $mainCTA = __d('default', 'Contactar choferes en Cuba');
    if(isset($cta)) $mainCTA = $cta;
?>


<section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-0">

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
                    <?php echo $this->Html->link($this->Html->image('logo37.png', array('alt'=>'Yo Te Llevo Cuba logo', 'style'=>'height:3.8rem')), '/'.SessionComponent::read('App.language'), array('escape'=>false));?>
                </span>
                <span class="navbar-caption-wrap">
                    <?php echo $this->Html->link('YO TE LLEVO - CUBA', '/'.Configure::read('App.language'), array('class'=>'navbar-caption text-white display-4'));?>
                </span>
                
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item pull-left">
                        <?php echo $this->element('widgets/lang-link')?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <?php echo $this->Html->link(__d('default', 'Sobre Nosotros'), array('controller'=>'testimonials', 'action'=>'featured', '?'=>array('also'=>Configure::read('App.language') == 'es'?'en':'es')), array('class'=>'nav-link link text-white display-4', 'escape'=>false)); ?>
                </li>
            </ul>
            <div class="navbar-buttons mbr-section-btn">
                <?php $talkingToDriver = $this->Session->read('visited-driver-'.$profile['Driver']['id']);?>
                <?php if (!$talkingToDriver): ?>
                    <a class="btn btn-sm btn-primary display-4" href="#<?php echo __d('default', 'solicitar')?>">
                        <span class="mbri-cust-feedback mbr-iconfont mbr-iconfont-btn"></span>
                        <?php echo __d('driver_profile', 'Contactar a %s', $profile['DriverProfile']['driver_name'])?>
                    </a>
                <?php else:?>
                    <?php echo $this->Html->link('<span class="mbri-cust-feedback mbr-iconfont mbr-iconfont-btn"></span> '.__d('driver_profile', 'Ver mis mensajes con %s', Driver::shortenName($profile['DriverProfile']['driver_name'])), array('controller'=>'conversations', 'action'=>'messages', $talkingToDriver), array('escape'=>false, 'class'=>'btn btn-sm btn-primary display-4'))?>
                <?php endif ?>
            </div>
            
            <?php if(!$userLoggedIn):?>
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                <li class="nav-item">
                    <?php echo $this->Html->link('<span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span> '.__('Entrar'), array('controller' => 'users', 'action' => 'login'), array('class' => 'nav-link link text-white display-4', 'rel'=>'nofollow', 'escape'=>false)) ?>
                </li>
            </ul>
            <?php endif?>
            
        </div>
    </nav>
</section>