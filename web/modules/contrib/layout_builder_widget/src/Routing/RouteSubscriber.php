<?php

namespace Drupal\layout_builder_widget\Routing;

use Drupal\Component\Uuid\Uuid;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 * Subscriber for layout_builder routes.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a RouteSubscriber object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    foreach ($this->entityTypeManager->getDefinitions() as $entity_type_id => $entity_type) {
      $route_name = "layout_builder.overrides.$entity_type_id.view";
      // Try to get the route from the current collection.
      if (!$layout_builder_route = $collection->get($route_name)) {
        continue;
      }

      $requirements = [];

      $defaults_requirement = $layout_builder_route->getRequirement($entity_type_id);
      if ($defaults_requirement) {
        // When using Layout Builder, route parameters are inherited from
        // the corresponding entity view route. For example,
        // the route "layout_builder.overrides.node.view" inherits the parameter
        // "node: \d+" from the "node.view" route. However, new entities that
        // use UUID as the parameter cause issues, so we add a regex pattern
        // for UUID as an OR condition to prevent problems.
        $requirements[$entity_type_id] = $defaults_requirement . '|' . UUID::VALID_PATTERN;
        $layout_builder_route->addRequirements($requirements);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -120];
    return $events;
  }

}
