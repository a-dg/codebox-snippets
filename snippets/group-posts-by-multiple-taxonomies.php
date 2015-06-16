/**
 * Get lists of posts grouped by multiple taxonomies
 * @return string HTML
 */
public static function getLists() {
  global $wpdb;
  
  $post_type = Str::machine(Str::camelToHuman(get_called_class()), \Taco\Base::SEPARATOR);
  $taxonomies = array(
    "topic",
    "talkee",
  );
  $join_by_taxonomies = array();
  foreach($taxonomies as $taxonomy) {
    $join_by_taxonomies[] = sprintf(
      "INNER JOIN (
        SELECT DISTINCT
          p.ID,
          p.post_title,
          t.slug AS %s
        FROM %s AS p
          INNER JOIN %s AS tr ON p.ID = tr.object_id
          INNER JOIN %s AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
          INNER JOIN %s AS t ON t.term_id = tt.term_id
        WHERE tt.taxonomy = '%s'
        GROUP BY p.ID
      ) %s_subquery ON pp.ID = %s_subquery.ID",
      $taxonomy,
      $wpdb->posts,
      $wpdb->term_relationships,
      $wpdb->term_taxonomy,
      $wpdb->terms,
      $taxonomy,
      $taxonomy,
      $taxonomy
    );
  }
  
  $sql = sprintf(
    "SELECT
      pp.ID,
      pp.post_title,
      %s, /* taxonomies */
      pp.menu_order
    FROM %s AS pp
    %s /* join_by_taxonomies */
    WHERE pp.post_type = '%s'
    AND pp.post_status = 'publish'
    ORDER BY %s, pp.menu_order ASC",
    
    join(', ', $taxonomies),
    $wpdb->posts,
    join("\n", $join_by_taxonomies),
    $post_type,
    join(', ', $taxonomies)
  );
  $results = $wpdb->get_results($sql, ARRAY_A);
  
  $post_lists = array();
  $results_by_topic = Collection::groupBy($results, 'topic');
  foreach($results_by_topic as $topic => $topic_group) {
    $results_by_talkee = Collection::groupBy($topic_group, 'talkee');
    foreach($results_by_talkee as $talkee => $talkee_group) {
      $talk_item_post_ids = Collection::pluck($talkee_group, 'ID');
      $talk_items = \Taco\Post\Factory::createMultiple($talk_item_post_ids, false);
      $post_list_items = array();
      foreach($talk_items as $talk_item) {
        $post_list_items[] = $talk_item->getListItem();
      }
      $post_lists[] = sprintf(
        '<ul class="accordion" data-topic="%s" data-talkee="%s">
          %s
        </ul>',
        $topic,
        $talkee,
        join('', $post_list_items)
      );
    }
  }
  return join('', $post_lists);
}
