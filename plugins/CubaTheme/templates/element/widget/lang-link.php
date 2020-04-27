<?php 
use Cake\Core\Configure;

$other = array('en' => 'es', 'es' => 'en');
$lang = Configure::read('App.language');

$lang_changed_url             = $this->request->getParam('pass');
//$lang_changed_url             = array_merge($lang_changed_url, $this->request->getParam('named'));
$lang_changed_url['?']        = $this->request->getQueryParams();
$lang_changed_url['language'] = $other[$lang];

if($lang != null && $lang == 'en') echo $this->Html->link($this->Html->image('Spain.png', array('style'=>'max-width:21px;max-height:16px')).'<span class="d-none d-sm-block">&nbsp;'.'Español</span>', $lang_changed_url, array('class' => 'nav-link link text-white display-4', 'title'=>'Traducir al Español', 'escape'=>false));
else echo $this->Html->link($this->Html->image('UK.png', array('style'=>'max-width:21px;max-height:16px')).'<span class="d-none d-sm-block">&nbsp;'.'English</span>', $lang_changed_url, array('class' => 'nav-link link text-white display-4', 'title'=>'Translate to English', 'escape'=>false));
?>