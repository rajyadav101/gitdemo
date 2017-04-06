<?php
namespace Drupal\recentblock\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal;
use Drupal\Core\Database\Database;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
/**
 * Provides a 'recent block' block.
 *
 * @Block(
 *   id = "recent_block",
 *   admin_label = @Translation("recent: recent block")
 * )
 */
class RecentBlock extends BlockBase{
    public function build() {
        $query = db_select('node', 'n')
                ->fields('n', array('nid'))
                ->condition('n.type', 'activity')
                ->orderBy('nid','DESC')
                ->range(0,3);
        $result =  $query->execute();
        $nid    = array();
        foreach($result as $res){
            $nid[] = $res;
        }
        $first_nid = $nid[0];
        $first_node_data = \Drupal::entityTypeManager()->getStorage('node')->load($first_nid->nid);
        $first_desc = $first_node_data->body->value;
        $act_date = $first_node_data->field_activities_date->value;
        $file = File::load($first_node_data->field_image->target_id);
        $act_imageUri = ImageStyle::load('large')->buildUrl($file->getFileUri(), TRUE);
        $imghtml="<img src=".$act_imageUri."/>";
       //             \Drupal::logger('node-list')->debug('<pre>' . print_r($nid, true) . '</pre>');

        $html = '<div class="col-md-12 recentactivitylist"><div class="col-md-4 img-container">'.$imghtml.'</div>';
        $html .='<div class="col-md-8 "><div class="recent-act-title">Recent Activities</div>';
        $html .='<div class="col-md-6 desc-date"><div class="activity-load-date">'.$act_date.'</div><div class="activity-desc-load">'.$first_desc.'</div><a class="more-act" href="/activities">More</a></div>';
        $html .='<div class="col-md-6 title-link">';
        
        foreach($nid as $key => $value){
            $node_storage = \Drupal::entityTypeManager()->getStorage('node')->load($value->nid);
            $act_date =  $node_storage->field_activities_date->value;
            $html .='<div id="'.$value->nid.'"class="act-date-link cdf">';
            $html .="<a class='load-detail' href='#' id=".$value->nid.">".$act_date."</a></div>";
           
        }
        $html .='</div></div></div>';
       //
                return array (
            '#type' => 'markup',
            '#markup' => $html,
            '#attached' => array(
            'library' => array('recentblock/mylab'),
            ),
        );
    }

}
