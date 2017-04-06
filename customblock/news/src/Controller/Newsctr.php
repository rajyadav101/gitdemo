<?php
namespace Drupal\news\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use Drupal\Component\Utility\UrlHelper;

class Newsctr extends ControllerBase{
    public function newsload($nid){
        $node_obj = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
//        $act_date = $node_obj->field_activities_date->value;
       $act_desc = $node_obj->body->value;
       $act_title=$node_obj->field_newslink->uri;
//        $file = File::load($node_obj->field_image->target_id);
//        $act_imageUri = ImageStyle::load('large')->buildUrl($file->getFileUri(), TRUE);
//        \Drupal::logger('activity-node-data')->debug('<pre>' . print_r($act_date, true) . '</pre>');
//        \Drupal::logger('activity-node-html')->debug('<pre>' . print_r($act_desc, true) . '</pre>');
//        \Drupal::logger('activity-node-html')->debug('<pre>' . print_r($act_imageUri, true) . '</pre>');
        $element = array();
//        $element['activityDate']=$act_date;
        $element['activityDesc']=$act_desc;
        $element['newslink']=$act_title;
//        return array(
//                '#title' => 'Reent Activity',
//                '#markup' => $nid,
//            );
        echo json_encode($element);
        exit();
    }
       
}

