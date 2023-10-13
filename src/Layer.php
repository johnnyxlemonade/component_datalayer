<?php declare(strict_types=1);

namespace Lemonade\DataLayer;
use Exception;
use Stringable;
use function json_encode;
use function str_replace;

final class Layer implements Stringable {

    /**
     * @var array
     */
    protected ?Content $content = null;

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @param Content|null $content
     * @return void
     */
    public function create(Content $content = null): void {

        if (!empty($content)) {

            $this->content = $content;
        }

    }

    /**
     * @return string
     */
    public function render(): string
    {

        try {

            $encoded = json_encode(value: ($this->content ?? []));

        } catch (Exception $e) {

            $encoded = "[]";
        }


        return ($encoded === "[]" ? "" : 'dataLayer.push(' . $encoded . ');');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {

        return $this->content->toArray();
    }

    /**
     * @param string|null $tagManagerId
     * @param array $data
     * @param bool $reset
     * @return string
     */
    public function withTagManager(string $tagManagerId = null, array $data = [], bool $reset = true): string
    {

        $html = "";

        if(!empty($tagManagerId)) {

            $html = PHP_EOL;
            $html .= "\t<!-- DataLayer -->";
            $html .= PHP_EOL;
            $html .= "\t<script>";
            $html .= PHP_EOL;
            $html .= "\t\t" . 'window.dataLayer = window.dataLayer || [];';
            $html .= PHP_EOL;

            if($reset) {

                $html .= PHP_EOL;
                $html .= "\t\t" .'dataLayer.push({"ecommerce": null});';
                $html .= PHP_EOL;
            }

            if(!empty($data)) {
                foreach($data as $val) {
                    $html .= "\t\t" . $val . PHP_EOL;
                }
            }

            $html .= PHP_EOL;
            $html .= "\t</script>";
            $html .= PHP_EOL;
            $html .= "\t<!-- End DataLayer -->";

            $html .= PHP_EOL;
            $html .= (string) str_replace(search: "{tagManagerId}", replace: $tagManagerId, subject: $this->_getTagManager());
            $html .= PHP_EOL;
        }

        return $html;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {

        return $this->render();
    }


    /**
     * @return string
     */
    protected function _getTagManager(): string
    {

        $script = <<<SCRIPT

    <!-- Google Tag Manager -->
    <script>
      (function(w,d,s,l,i){  
          
        w[l]=w[l]||[];
        w[l].push({"gtm.start":new Date().getTime(),event:"gtm.js"});
              
        var f = d.getElementsByTagName(s)[0], 
            j = d.createElement(s), 
            dl=l!='dataLayer'?'&l='+l:'';
                
        j.async=true;
        j.src="https://www.googletagmanager.com/gtm.js?id="+i+dl;   
        f.parentNode.insertBefore(j,f);
           
      })(window,document,"script","dataLayer","{tagManagerId}");
    </script>
    <!-- End Google Tag Manager -->
        
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={tagManagerId}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

SCRIPT;

        return $script;
    }

}