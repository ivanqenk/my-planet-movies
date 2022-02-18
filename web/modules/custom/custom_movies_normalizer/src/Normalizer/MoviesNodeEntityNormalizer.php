<?php

namespace Drupal\custom_movies_normalizer\Normalizer;

use Drupal\serialization\Normalizer\ContentEntityNormalizer;
use Drupal\taxonomy\Entity\Term;

/**
 * Converts the Drupal entity object structures to a normalized array.
 */
class MoviesNodeEntityNormalizer extends ContentEntityNormalizer {
  /**
   * The interface or class that this Normalizer supports.
   *
   * @var string
   */
  protected $supportedInterfaceOrClass = 'Drupal\node\NodeInterface';

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = array()) {
    $attributes = parent::normalize($entity, $format, $context);

    // We make sure that it only affects movie entities.
    if ($entity->bundle() == 'movie') {
      // Unsetting the original attributes array.
      unset($attributes);
      // Building it from scratch.
      $attributes = [];
      $attributes['id'] = $entity->id();
      $attributes['title'] = $entity->getTitle();
      $attributes['release_date'] = $entity->get('field_release_date')->getString();
      $genre = Term::load($entity->get('field_genre')->getString())->get('name')->value;
      $attributes['genre'] = $genre;
    }

    // Return the $attributes with our new values.
    return $attributes;
  }
}