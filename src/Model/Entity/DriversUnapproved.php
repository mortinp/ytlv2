<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DriversUnapproved Entity
 *
 * @property string $username
 * @property int $id
 * @property string $full_name
 * @property string $car_model
 * @property string $avatar_path
 * @property string $featured_img_url
 * @property string $about
 * @property string $profile_img_url
 * @property string $phone 
 * @property int $max_people_count
 * 
 *
 * 
 */
class DriversUnapproved extends Entity
{
    
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'full_name' => true,
        'car_model' => true,
        'phone'=>true,
        'max_people_count' => true,
        'about' => true,
        'province_id' => true,
        'has_air_conditioner' => true,
        'speaks_english' => true,
        
        'image1_path' => true,
        'image2_path' => true,
        'image3_path' => true,
        
        'image1' => true,
        'image2' => true,
        'image3' => true,
    ];
    
}
