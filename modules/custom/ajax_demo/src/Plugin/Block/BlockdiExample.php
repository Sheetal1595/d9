<?php
namespace Drupal\ajax_demo\Plugin\Block;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Block\BlockBase;

/*
*@Block( * = "di_injection_Block",
admin_label = @Translation("admin_label")),
*/
class BlockdiExample extends BlockBase implements ContainerFactoryPluginInterface{
    protected $formBuilder;
    public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder){
        $this->formBuilder = $formBuilder;
    }

    public static function create(ContainerInterface $container,array $configuration,$plugin_id,$plugin_definition){
    return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->get('form_builder')
    );
    }
    public function build(){
        $form = $this->formBuilder->getform('\Drupal\ajax_demo\Form\diForm');
        return $form;
    }
    
}
?>