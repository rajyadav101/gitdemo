<?php
namespace Drupal\activities\Plugin\Block\activities;
use Drupal\Core\Block\BlockBase;

class activities extends BlockBase{
    public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }
}
