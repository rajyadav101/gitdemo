<?php

/**
 * @file
 * Contains \Drupal\yourmodule\Plugin\Block\YourBlockName.
 */

namespace Drupal\customblock\Plugin\Block\myblock;

use Drupal\Core\Block\BlockBase;

/**
 * Provides my custom block.
 *
 * @Block(
 *   id = "newsBlock",
 *   admin_label = @Translation("My Custom Block"),
 *   category = @Translation("Blocks")
 * )
 */
class myblock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
      /*  $userId=\Drupal::currentUser()->id();        
        $query= \Drupal::database()->select('user__field_name','n');
        $query->fields('n', array('field_name_value'))
                ->condition('n.entity_id', $userId);
        $userName = $query->execute()->fetchAll();
        $result_string = ltrim($userName[0]->field_name_value);
        $resultName=  explode(' ', $result_string);*/
        //dpm($userName[0]->field_name_value);
        return array(
            '#markup' => '<h4><spam>Hello, </spam> </h4>',
    
        );
    }

}
