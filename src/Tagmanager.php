<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

use Lemonade\Cookie\CookieForm;
use Lemonade\Cookie\CookieTracking;
use Stringable;
use function str_replace;

final class Tagmanager implements Stringable
{

    /**
     * @param string|null $code
     * @param array $data
     * @param CookieForm $cookie
     */
    protected function __construct(
        protected readonly ?string $code = null,
        protected readonly array   $data = [],
        protected readonly CookieForm $cookie = new CookieForm()
    )
    {
    }


    /**
     * @return string
     */
    public function __toString(): string
    {

        return $this->_render();
    }

    /**
     * @param string|null $code
     * @param array $data
     * @param CookieForm|null $cookie
     * @return string
     */
    public static function render(string $code = null, array $data = [], CookieForm $cookie = null): string
    {

        return (new self(code: $code, data: $data, cookie: $cookie))->_render();
    }

    /**
     * @return string
     */
    protected function _render(): string
    {

        $html = "";

        if (!empty($this->code)) {

            $html .= PHP_EOL;
            $html .= "\t<!-- DataLayer -->";
            $html .= PHP_EOL;
            $html .= "\t<script>\n";
            $html .= PHP_EOL;
            $html .= "\t\t" . 'window.dataLayer = window.dataLayer || [];';
            $html .= PHP_EOL;
            $html .= "\t\t" . 'function gtag(){dataLayer.push(arguments);}';
            $html .= PHP_EOL;

            // gtag
            if($this->cookie instanceof CookieForm) {

                $html .= PHP_EOL;
                $html .= "\t\t" . sprintf('gtag("consent", "default", %s);', json_encode(value: $this->cookie->getDataLayer()));
                $html .= PHP_EOL;
            }

            $html .= PHP_EOL;
            
            // ostatni
            if (!empty($this->data)) {
                foreach ($this->data as $val) {
                    $html .= "\t\t" . $val . PHP_EOL;
                }
            }


            $html .= PHP_EOL;
            $html .= "\t</script>";
            $html .= PHP_EOL;
            $html .= "\t<!-- End DataLayer -->";
            $html .= PHP_EOL;
            $html .= (string)str_replace(search: "{code}", replace: $this->code, subject: $this->_getScript());
            $html .= PHP_EOL;
        }

        return $html;
    }

    /**
     * @return string
     */
    protected function _getScript(): string
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
           
      })(window,document,"script","dataLayer","{code}");
    </script>
    
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={code}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager -->

SCRIPT;

        return $script;
    }

}