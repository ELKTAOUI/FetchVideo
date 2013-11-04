FetchVideo
==========

This Class can be used to retrieve informations about a single video on Youtube/Vimeo Or Youtube/Vimeo Channel. 
It uses the Youtube and Vimeo Data API.

Gets all information from a YouTube/Vimeo video Or Youtube/Vimeo Channel as 
(title, description, duration,url,Likes,Views,Subscribers, etc..) 


FetchVideo::getInfoYoutubeChanel('UCqyku6Kdofy1nV86yh9R8n8A');
This is a Static method which return an array contain all informations you need about a channel on Youtube (title,subscriber,number of videos,etc ...)
you can simply modify the name of key of the array
$info['titre'] to $info['title']


FetchVideo::getInfVimeoChanel('delicioussandwich');
This is a Static method return an array contain all informations you need about a channel on Vimeo (title,subscriber,number of videos,etc ...)
you can simply modify the name of key of the array
$info['titre'] to $info['title']


FetchVideo::getInfoVimeo('7811489');
This is a Static method which return an array contain all informations you need about a video on Vimeo (title,like,views,etc ...)
you can simply modify the name of key of the array
$info['titre'] to $info['title']


FetchVideo::getInfoYoutube('89ScoHpaZaw');
This is a Static method which return an array contain all informations you need about a video on Youtube (title,likes,views,etc ...)
you can simply modify the name of key of the array
$info['titre'] to $info['title']
