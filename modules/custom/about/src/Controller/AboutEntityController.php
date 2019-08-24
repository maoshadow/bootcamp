<?php

namespace Drupal\about\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Render\Renderer;
use Drupal\Core\Url;
use Drupal\about\Entity\AboutEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AboutEntityController.
 *
 *  Returns responses for About entity routes.
 */
class AboutEntityController extends ControllerBase implements ContainerInjectionInterface {


  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * Constructs a new AboutEntityController.
   *
   * @param \Drupal\Core\Datetime\DateFormatter $date_formatter
   *   The date formatter.
   * @param \Drupal\Core\Render\Renderer $renderer
   *   The renderer.
   */
  public function __construct(DateFormatter $date_formatter, Renderer $renderer) {
    $this->dateFormatter = $date_formatter;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter'),
      $container->get('renderer')
    );
  }

  /**
   * Displays a About entity revision.
   *
   * @param int $about_entity_revision
   *   The About entity revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($about_entity_revision) {
    $about_entity = $this->entityTypeManager()->getStorage('about_entity')
      ->loadRevision($about_entity_revision);
    $view_builder = $this->entityTypeManager()->getViewBuilder('about_entity');

    return $view_builder->view($about_entity);
  }

  /**
   * Page title callback for a About entity revision.
   *
   * @param int $about_entity_revision
   *   The About entity revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($about_entity_revision) {
    $about_entity = $this->entityTypeManager()->getStorage('about_entity')
      ->loadRevision($about_entity_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $about_entity->label(),
      '%date' => $this->dateFormatter->format($about_entity->getRevisionCreationTime()),
    ]);
  }

  /**
   * Generates an overview table of older revisions of a About entity.
   *
   * @param \Drupal\about\Entity\AboutEntityInterface $about_entity
   *   A About entity object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(AboutEntityInterface $about_entity) {
    $account = $this->currentUser();
    $about_entity_storage = $this->entityTypeManager()->getStorage('about_entity');

    $build['#title'] = $this->t('Revisions for %title', ['%title' => $about_entity->label()]);

    $header = [$this->t('Revision'), $this->t('Operations')];
    $revert_permission = (($account->hasPermission("revert all about entity revisions") || $account->hasPermission('administer about entity entities')));
    $delete_permission = (($account->hasPermission("delete all about entity revisions") || $account->hasPermission('administer about entity entities')));

    $rows = [];

    $vids = $about_entity_storage->revisionIds($about_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\about\AboutEntityInterface $revision */
      $revision = $about_entity_storage->loadRevision($vid);
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = $this->dateFormatter->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $about_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.about_entity.revision', [
            'about_entity' => $about_entity->id(),
            'about_entity_revision' => $vid,
          ]));
        }
        else {
          $link = $about_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => $this->renderer->renderPlain($username),
              'message' => [
                '#markup' => $revision->getRevisionLogMessage(),
                '#allowed_tags' => Xss::getHtmlTagList(),
              ],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => Url::fromRoute('entity.about_entity.revision_revert', [
                'about_entity' => $about_entity->id(),
                'about_entity_revision' => $vid,
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.about_entity.revision_delete', [
                'about_entity' => $about_entity->id(),
                'about_entity_revision' => $vid,
              ]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
    }

    $build['about_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
