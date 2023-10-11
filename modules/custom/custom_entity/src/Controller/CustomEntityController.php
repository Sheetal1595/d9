<?php

namespace Drupal\custom_entity\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\Core\Entity\EntityInterface;

/**
 * Returns responses for custom_entity routes.
 */
class CustomEntityController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
//create 
$p = \Drupal::entityTypeManager()->getStorage("My_profile")->create([
  'type'=>'My_profile',
  'label'=>'About_us',
  'description__value' => 'test',
]);
$p->save();
    //read
    $profile = \Drupal::entityTypeManager()->getStorage("My_profile")->load(3);

    $title = $profile->label->value;
    $ststus = $profile->status->value;
    $description = $profile->description__value->value;
    // $uid = $profile->uid->getValue()[0]['target_id'];
    
    dpm($title );
    dpm($ststus );
    dpm($description );
    dpm($uid );

    //update

    // $profile->set('label', 'testing...!!!');
    // $profile->save();

    //delete
    $profile = \Drupal::entityTypeManager()->getStorage("My_profile")->load(2);
    // $profile->delete();


    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
