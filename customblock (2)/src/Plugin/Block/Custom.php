<?php

/**
 * @file
 * Contains \Drupal\yourmodule\Plugin\Block\YourBlockName.
 */

namespace Drupal\customblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides my custom block.
 *
 * @Block(
 *   id = "my_custom_block",
 *   admin_label = @Translation("My Custom Block"),
 *   category = @Translation("Blocks")
 * )
 */
class Custom extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() 
    {
     echo "Dsa";
     $renderer = \Drupal::service('renderer');  
     $result = views_embed_view('upcoming_appointments', 'default', 1);
     //$result=$result.view_embed_view('content','default',1);
     //print_r($renderer->renderPlain($result));
        return array(
            '#markup' => '<h4>'. 'FGddCFGG'.$renderer->renderPlain($result).'</h4>',
            //'#markup' => $this->t('My custom block content'),
            '#cache' => array(
                'contexts' => array('user'),
            ),
        );
     
     }

}
