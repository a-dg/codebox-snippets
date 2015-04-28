require_once(__DIR__.'/../_bootstrap_wp.php');
$search_term = $_GET['search_term'];
$post_type = $_GET['post_type'];

if(strlen($search_term) && strlen($post_type)) {
  global $wpdb;
  
  $select_catalog_id = null;
  $join_by_meta = null;
  if($post_type == 'course') {
    $select_catalog_id = ", pm_catalog_id.meta_value AS catalog_id";
    $join_by_meta = sprintf(
      "INNER JOIN %s AS pm_catalog_id ON p.ID = pm_catalog_id.post_id
      WHERE pm_catalog_id.meta_key = 'catalog_id'",
      $wpdb->postmeta
    );
  }
  
  $sql_autocomplete = sprintf(
    "SELECT
      p.ID AS post_id,
      p.post_title AS post_title,
      p.post_name AS post_name
      %s /* select_catalog_id */
    FROM (
      SELECT
        ID,
        post_title,
        post_name
      FROM %s /* posts */
      WHERE post_title LIKE '%s%%' /* search_term */
      AND post_type = '%s' /* post_type */
      AND post_status = 'publish'
      LIMIT 5
      
      UNION
      
      SELECT
        ID,
        post_title,
        post_name
      FROM %s /* posts */
      WHERE post_title LIKE '%%%s%%' /* search_term */
      AND post_type = '%s' /* post_type */
      AND post_status = 'publish'
      LIMIT 5
    ) AS p
    
    %s /* join_by_meta */",
    
    $select_catalog_id,
    
    $wpdb->posts,
    like_escape(esc_sql($search_term)),
    $post_type,
    
    $wpdb->posts,
    like_escape(esc_sql($search_term)),
    $post_type,
    
    $join_by_meta
  );
  
  $results = $wpdb->get_results($sql_autocomplete, ARRAY_A);
  if(Arr::iterable($results)) {
    foreach($results as $result) {
      $result_data = array(
        'data-post-id="'.$result['post_id'].'"'
      );
      $result_title = array(
        $result['post_title']
      );
      if($post_type == 'course') {
        $catalog_id = $result['catalog_id'];
        // $result_data[] = 'data-catalog-id="'.$catalog_id.'"';
        // $result_title[] = '('.$catalog_id.')';
        array_unshift($result_title, $catalog_id);
      } elseif($post_type == 'instructor') {
        $result_title[] = '('.$result['post_name'].')';
      }
      echo '<div class="autocomplete-suggestion" '.join(' ', $result_data).'>'.join(' ', $result_title).'</div>';
    }
  }
} else {
  echo '';
}
