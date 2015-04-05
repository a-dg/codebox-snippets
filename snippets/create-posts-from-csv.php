foreach($records as $record) {  $new_post = new Post;  $new_post->assign($record);  $new_post->setTerms(array($record['taxonomy']), 'name-of-taxonomy');
  $new_post->save();}
