<?php
namespace App\Traits;

trait AutoLink {

    var $urlPattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
    var $urlReplace = '<a href="$1">Link</a>'; 

    public function getMemoAttribute() {
		return nl2br(preg_replace($this->urlPattern, $this->urlReplace, $this->attributes['memo']));
    }
}
?>
