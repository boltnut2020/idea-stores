<?php
namespace App\Traits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\HtmlString;

trait HtmlDisplay {

    var $urlPattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
    var $urlReplace = '<a href="$1">Link</a>'; 

    public function displayHtml($target = "memo") {
		$setLinkText = preg_replace($this->urlPattern, $this->urlReplace, $this->attributes[$target]);
        $setLinkTextBr = nl2br($setLinkText);
        return preg_replace_callback(
                                    '/<pre>(.*?)<\/pre>/s',
                                    function($m){
                                        return "<pre>" . htmlspecialchars(str_replace("<br />", "", $m[1])) . "</pre>";
                                    }, $setLinkTextBr);
    }

    /**
     * Get the Article's content as HTML
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getContentAttribute($value)
    {
        if (!$value) return null;
        // Hash the text with the lowest computational hasher available.
        $key = 'article|'.$this->id . '|' . hash('sha256', $value);
        // If the cache with this hash exists, return it, otherwise
        // parse it again and save it into the cache for 1 day.       
        return Cache::remember($key, 86400, function () use ($value) {
            return $this->parseMarkdownToHtml($value);
        });
    }
   /**
     * Get the Article's description as HTML
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function getDescriptionAttribute($value)
    {
        if (!$value) return null;
        // Hash the text with the lowest computational hasher available.
        $key = 'article|'.$this->id . '|' . hash('sha256', $value);
        // If the cache with this hash exists, return it, otherwise
        // parse it again and save it into the cache for 1 day.       
        return Cache::remember($key, 86400, function () use ($value) {
            return $this->parseMarkdownToHtml($value);
        });
    }

    /**
     * Get the Article's text as HTML
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function parseMarkdownToHtml($value)
    {
        return new HtmlString(app(\Parsedown::class)->text($value));
    }
}
?>
