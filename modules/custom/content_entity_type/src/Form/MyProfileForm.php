<?php

namespace Drupal\content_entity_type\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the profile[d[d[d[d[d[d[dmy_profile entity edit forms.
 */
class MyProfileForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New profile[d[d[d[d[d[d[dmy_profile %label has been created.', $message_arguments));
        $this->logger('content_entity_type')->notice('Created new profile[d[d[d[d[d[d[dmy_profile %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The profile[d[d[d[d[d[d[dmy_profile %label has been updated.', $message_arguments));
        $this->logger('content_entity_type')->notice('Updated profile[d[d[d[d[d[d[dmy_profile %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.My_Profile.canonical', ['My_Profile' => $entity->id()]);

    return $result;
  }

}
