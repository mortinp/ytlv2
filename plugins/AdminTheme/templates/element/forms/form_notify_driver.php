<?php
use App\Model\Entity\Conversation;
use App\Model\Entity\Driver;
?>

<?php 
if(!isset ($isArranged)) $isArranged = false;
if(!isset ($notificationType)) $notificationType = Conversation::NOTIFICATION_TYPES['BY_ADMIN'];
?>
<div>
    <?php echo $this->Form->create(null, array('default'=>false, 'url' => array('plugin'=>null, 'controller' => 'conversations', 'action' =>'notify-driver', $travel_id, $notificationType),'class'=>'driver-notification-form', 'data-travel-id'=>$travel_id, 'data-notification-type'=>$notificationType, 'id'=>false)); ?>
    <div class="ajax-msg"></div>
    <fieldset>
        <?php
        $valor = ($isArranged) ? 1 : 0;
        echo $this->Form->input('driver_id', array('type' => 'text', 'class'=>"driver-typeahead {$travel_id}input{$valor}", 'label' => 'Chofer', 'required'=>true, 'value'=>'', 'placeholder'=>'Nombre, correo o provincia'));
        if($isArranged) echo $this->Form->input('TravelConversationMeta.arrangement', array('type' => 'textarea', 'label' => 'Envía una nota al chofer con los detalles del acuerdo (recorridos, precios, etc.) y todos los detalles que se tengan del viaje (nombres de los clientes, datos del vuelo, nacionalidad o idioma, lugar de recogida inicial, etc.). <big>Esta nota la recibe el chofer junto con la notificación</big>.', 'required'=>true, 'value'=>''));        
        echo $this->Form->submit('Notificar', array('onclick'=>"return validar($travel_id, $valor)"));
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>