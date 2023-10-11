<?php

namespace Drupal\alter_url\Controller;

use Drupal\Component\Utility\Html;
use Drupal\taxonomy\Entity\Term;

/**
 * Generate URL aliases for articles.
 */
class urlController
{
    protected $pattern = '/%term%/%name%';

    public function generate($context)
    {

        if ($context['bundle'] === 'article' && ($context['op'] == 'insert' || $context['op'] == 'update')) {
            return $this->assembleAlias($context['data']['node']);
        }
    }

    protected function assembleAlias($entity)
    {

        if ($entity->getEntityTypeId() === 'node') {

            if ($entity->bundle() === 'article') {

                if ($texo = $entity->get('field_course_name')->getValue()) {
                    foreach ($texo as $data) {
                        $term = Term::load($data['target_id']);
                        $name = $term->getName();
                        $taxonomy_name = $term->bundle();

                    }
                }
               
                $url = '/' . $taxonomy_name . '/' . $name;
                
                return $url;

            }
        }
    }



}
