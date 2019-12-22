<?php class twitter_tagger extends Plugin {
        private $host;
        function about() {
                return array(1.0,
                        "add tags for twitter usernames",
                        "swack");
        }
        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
        }
        function hook_article_filter($article) {

                $matches = array();
                if(strpos($article["link"], "twitter.com") !== FALSE)
                {
                        if(strpos($article["title"], "RT") !== FALSE)
                        {
                                $article["tags"] = array();
                                $matches = explode(' ',$article["title"],PHP_INT_MAX);
                                array_push($article["tags"],reset($matches),end($matches));
                        }
                        else
                        {
                                $matches = explode(" ",$article["title"]);
                                $article["tags"] = array_slice($matches,0,1);
                        }
                }

                return $article;
        }
        function api_version() {
                return 2;
        }
}

