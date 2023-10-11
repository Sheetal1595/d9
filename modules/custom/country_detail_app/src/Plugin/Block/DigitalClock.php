<?
namespace Drupal\country_detail_app\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 * id = "digital_clock",
 * admin_label = @Translation("Digital Clock"),)
 */

class DigitalClock extends BlockBase{

    /**
     * {@inheritdoc}
     */
    public function build(){
        $build = [];
        $build['#theme'] = 'digital_clock';
        $build['digital_clock']['#markup'] ='Implement DigitalClock';
        return $build;
    }
}