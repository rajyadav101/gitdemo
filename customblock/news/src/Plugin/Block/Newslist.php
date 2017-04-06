<?php
namespace Drupal\news\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal;
use Drupal\Core\Database\Database;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
/**
 * Provides a 'News' block.
 *
 * @Block(
 *   id = "USAIDews",
 *   admin_label = @Translation("Usaid news")
 * )
 */


class Newslist extends BlockBase{

    public function build() {
        $query = db_select('node', 'n')
                ->fields('n', array('nid'))
                ->condition('n.type', 'news')
                ->orderBy('nid','DESC');
                
        $result =  $query->execute();
        $nid    = array();
        foreach($result as $res){
            $nid[] = $res;
        }
//        $nodeobj = Drupal\node\Entity\Node::load(46);
//        $ntitle = $nodeobj->title->value;
//        $ndisc = $nodeobj->body->value;
//        \Drupal::logger('news-ti')->debug('<pre>' . print_r($nodeobj->field_newslink->uri , true) . '</pre>');
        $counter = 0;
        $html   = '<div class="col-md-6 news-list">';
        $html2 = '<div class="col-md-6 news-img-link">';
        $html3 = "<div class='news-right-img'>";
        $newstitle = '';
        foreach ($nid as $kye => $act) {
             
           $nodeData = \Drupal\node\Entity\Node::load($act->nid);
           $newstitle = $nodeData -> title->value;
          $newsdesc  = $nodeData->body->value;
          $nouterlink = $nodeData->field_newslink->uri;
          
           \Drupal::logger('news-title')->debug('<pre>' . print_r($newstitle, true) . '</pre>');
           \Drupal::logger('news-desc')->debug('<pre>' . print_r($newsdesc, true) . '</pre>');
           
            if($counter < 3){
          $file = File::load($nodeData->field_image->target_id);
          $act_imageUri = file_create_url($file->getFileUri()); 
 //         \Drupal::logger('news-img')->debug('<pre>' . print_r($act_imageUri, true) . '</pre>');
//              $file = File::load($node_obj->field_image->target_id);
//               $act_imageUri = ImageStyle::load('large')->buildUrl($file->getFileUri(), TRUE); 
              if($counter == 0){
                   $html2 .= "<div class='left-img'> <a class='loadnewsdesc' href='#' id=".$act->nid."> <img src=".$act_imageUri."/><div class='news-title'>".$newstitle."</div></a></div>";
               }
               else{
               $html3 .= "<a class='loadnewsdesc' href='#' id=".$act->nid."> <img src=".$act_imageUri."/><div class='news-title'>".$newstitle."</div></a>";
            }
            }
            else{
                $html .= "<div class='outer-news'><a target='_blank' href=".$nouterlink.">".$newstitle."</a></div>";
                $html .="<div class='news-desc'>".$newsdesc."</div>";
            }
            $counter++;
        }
        
        $html2 .= $html3.'</div></div>';
        $html .='</div><div class="col-md-12"><div class="loadnews"></div><div class="loadlink"></div></div>';
        $rowdata = $html2;
        $rowdata .= $html;
                return array (
            '#type' => 'markup',
            '#markup' => $rowdata,
            '#attached' => array(
            'library' => array('news/mylabjs'),
            ),
        );
    }

}
