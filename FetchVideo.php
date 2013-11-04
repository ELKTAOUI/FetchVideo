<?php
/**
* 
*/
class FetchVideo 
{

	//Youtube Video
	static public function getInfoYoutube($id)
	{
		$info=array();
		$link='http://gdata.youtube.com/feeds/api/videos/'.$id.'?v=2&alt=rss';
		$xml=@simplexml_load_file($link);
		if(!$xml){
			exit('Error: no video with id "' . $id . '" was found. Please specify the id of a existing video.');
		}
			$media = $xml->children('http://search.yahoo.com/mrss/');
		    $gd=$xml->children('http://schemas.google.com/g/2005');
		    $yt = $media->group->children('http://gdata.youtube.com/schemas/2007');
		    $yt1=$xml->children('http://gdata.youtube.com/schemas/2007');
		    $atom=$xml->children('http://www.w3.org/2005/Atom');
		    //Duré de video
		    foreach ($yt->attributes() as $key => $value) {
		    	$info['dure']=$value.' seconds';
		    }
		    //Nombre de Likes
		
		    foreach ($yt1->rating->attributes() as $key => $value) {
		    	if($key=='numLikes'){
		    		$info['likes']=$value;
		    	}
		    		
		    }
		    //Description du video:
		    $info['description']=$media->group->description;
    
		    //Nombres de vues
		    foreach ($yt1->statistics->attributes() as $key => $value) {
		    	if($key=='viewCount'){
		    	$info['view']=$value;
		    }
		}
		    //Info User
		    $info['user']=$xml->author;
		    //Titre de Video
		    $info['titre']=$xml->title;
		    //URL
		    $info['url']=$xml->link;
    
		    //Picture of video
		    $pic=$media->group->thumbnail;
		    foreach ($pic->attributes() as $key => $value) {
		    	if($key=='url'){
		    		$info['image']=$value;
		    	}
		    }
		    // Categorie
		    foreach ($media->group->category->attributes() as $key => $value) {
		    	if($key=='label'){
		    	$info['categorie']=$value;
		    }
		    }
		    //date de publication + date de mise a jour
		    $info['update_date']=substr($atom->updated, 0,10).' '.substr($atom->updated, 11,11);
		    $info['add_date']=substr($xml->pubDate, 0,10).' '.substr($xml->pubDate, 12,13);
    
		    return $info;
	}

	//Vimeo video
	static function getInfoVimeo($id)
	{	
		$link='http://vimeo.com/api/v2/video/'.$id.'.xml';
		$xml=@simplexml_load_file($link);
		if(!$xml){
			exit('Error: no video with id "' . $id . '" was found. Please specify the id of a existing video.');
		}
		$info['title']=$xml->video->title;
		$info['description']=$xml->video->description;

		$info['url']=array('web_url'=>$xml->video->url,
			                     'mobile_url'=>$xml->video->mobile_url);
		$info['pic']=array('petit'=>$xml->video->thumbnail_small,
			                     'moyen'=>$xml->video->thumbnail_medium,
			                     'grand'=>$xml->video->thumbnail_large);

		$info['user']=array('user_id'=>$xml->video->user_id,
			                      'user_name'=>$xml->video->user_name,
			                      'user_url'=>$xml->video->user_url,
			                      'user_pic'=>$xml->video->user_portrait_medium);

		$info['statistiques']=array('likes'=>$xml->video->stats_number_of_likes,
										  'plays'=>$xml->video->stats_number_of_plays,
										  'comments'=>$xml->video->stats_number_of_comments);

		$info['duré']=$xml->video->duration;
		$info['upload_date']=$xml->video->upload_date;
		$info['tags']=explode(',', $xml->video->tags);
		return $info;
	}

	//Youtube Channel
	static function getInfoYoutubeChanel($name)
	{
		$info=array();
		$link='https://gdata.youtube.com/feeds/api/channels/'.$name.'?v=2&alt=rss';
		$xml=@simplexml_load_file($link);
		if(!$xml){
			exit('Error: no video with id "' . $name . '" was found. Please specify the id of a existing video.');
		}
		$media = $xml->children('http://search.yahoo.com/mrss/');
		$gd=$xml->children('http://schemas.google.com/g/2005');
		$atom=$xml->children('http://www.w3.org/2005/Atom');
		$yt = $xml->children('http://gdata.youtube.com/schemas/2007');
		$info['channel_name']=$xml->title;
		$info['channel_description']=$atom->summary;
		$info['channel_url']=$xml->link;
		$info['channel_user']=$xml->author;
		foreach ($yt->channelStatistics->attributes() as $key => $value) {
			if($key=='subscriberCount'){ 
				$info['subscribers']=$value; 
			}
		}
		foreach ($gd->feedLink->attributes() as $key => $value) {
			# code...
			if($key=='countHint'){ $info['nombre_videos']=$value;}
		}
		$info['channel_pic']=$media->thumbnail->attributes();
		return $info;

	}

	//Vimeo Channel
	static function getInfVimeoChanel($name)
	{
		$link='http://vimeo.com/api/v2/channel/'.$name.'/info.xml';
		$xml=@simplexml_load_file($link);
		if(!$xml){
			exit('Error: no video with id "' . $name . '" was found. Please specify the id of a existing video.');
		}
		$info['channel_name']=$xml->channel->name;
		$info['channel_description']=$xml->channel->description;
		$info['channel_url']=$xml->channel->url;
		$info['channel_user']=array('user_id'=>$xml->channel->creator_id,
										  'user_name'=>$xml->channel->creator_display_name,
										  'user_url'=>$xml->channel->creator_url);
		$info['channel_stat']=array('videos_number'=>$xml->channel->total_videos,
										  'videos_subsribers'=>$xml->channel->total_subscribers);
		return $info;

	}
}
?>
