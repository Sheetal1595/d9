<?php

namespace Drupal\custom_content_entity_example\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the profile entity edit forms.
 */
class ProfileForm extends ContentEntityForm {

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
        $this->messenger()->addStatus($this->t('New profile %label has been created.', $message_arguments));
        $this->logger('custom_content_entity_example')->notice('Created new profile %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The profile %label has been updated.', $message_arguments));
        $this->logger('custom_content_entity_example')->notice('Updated profile %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.profile.canonical', ['profile' => $entity->id()]);

    return $result;
  }

}
