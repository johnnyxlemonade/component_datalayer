<?php declare(strict_types=1);

namespace Lemonade\DataLayer;
use Exception;
use Stringable;
use function json_encode;

final class Layer implements Stringable {

    /**
     * @var Content|null
     */
    private ?Content $content = null;

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
    public function render(): string {

        try {

            $encoded = json_encode($this->content ?? [], JSON_PRETTY_PRINT);

        } catch (Exception $e) {

            $encoded = "[]";
        }


        return ($encoded === "[]" ? "" : 'dataLayer.push(' . $encoded . ');');
    }

    /**
     * @return array
     */
    public function toArray(): array {

        return $this->content->toArray();
    }

    /**
     * @param string|null $tagManagerId
     * @return string
     */
    public function withTagManager(string $tagManagerId = null): string {

        $html = "";

        if(!empty($tagManagerId)) {

            $html = "<script>";
            $html .= PHP_EOL;
            $html .= "window.dataLayer = window.dataLayer || [];";
            $html .= PHP_EOL;
            $html .= 'dataLayer.push({"ecommerce": null});';
            $html .= PHP_EOL;
            $html .= $this->render();
            $html .= PHP_EOL;
            $html .= "</script>";

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

SCRIPT;

            $html .= PHP_EOL;
            $html .= str_replace("{tagManagerId}", $tagManagerId, $script);
            $html .= PHP_EOL;
        }

        return $html;
    }

    /**
     * @return string
     */
    public function __toString(): string {

        return $this->render();
    }


}