<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* default/template/common/carousel.twig */
class __TwigTemplate_dd496061893f322bc8d74be86e480b35 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
<div class=\"carousel-desktop\">
\t<div class=\"carousel-lower\">
\t\t<div class=\"lower-text\">
\t\t\t<p class=\"line-1\">Spichlerz -</p>
\t\t\t<p class=\"line-2\">tradycyjne</p>
\t\t\t<p class=\"line-3\">jedzenie</p>
\t\t\t<p class=\"line-4\">Producent naturalnych konfitur, przetworów i syropów</p>
\t\t</div>
\t\t<div class=\"lower-background\">
\t\t\t<img id=\"carousel-bg\" src=\"image/catalog/assets/cherry_bg.jpg\" alt=\"cherry\"/>
\t\t</div>
\t</div>
\t<div class=\"carousel-upper\">
\t\t<div class=\"upper-slide active\">
\t\t\t<img src=\"image/catalog/assets/cherry.png\" alt=\"cherry\"/>
\t\t</div>
\t\t<div class=\"upper-slide\">
\t\t\t<img src=\"image/catalog/assets/honey.png\" alt=\"honey\"/>
\t\t</div>
\t\t<div class=\"upper-slide\">
\t\t\t<img src=\"image/catalog/assets/chocolate.png\" alt=\"chocolate\"/>
\t\t</div>
\t\t<div class=\"upper-slide\">
\t\t\t<img src=\"image/catalog/assets/currant.png\" alt=\"currant\"/>
\t\t</div>
\t\t<div class=\"upper-slide\">
\t\t\t<img src=\"image/catalog/assets/lemon.png\" alt=\"lemon\"/>
\t\t</div>
\t</div>
</div>

<div class=\"carousel-mobile\">
\t<div class=\"top\">
\t\t<div class=\"background\">
\t\t\t<img id=\"carousel-bg\" src=\"image/catalog/assets/cherry_bg.jpg\" alt=\"cherry\"/>
\t\t</div>
\t</div>
\t<div class=\"slider\">
\t\t<div class=\"slide\">
\t\t\t<img src=\"image/catalog/assets/cherry.png\" alt=\"cherry\"/>
\t\t</div>
\t</div>
\t<div class=\"bottom\">
\t\t<div class=\"text-mobile\">
\t\t\t<p class=\"line-1\">Spichlerz -</p>
\t\t\t<p class=\"line-2\">tradycyjne</p>
\t\t\t<p class=\"line-3\">jedzenie</p>
\t\t\t<p class=\"line-4\">Producent naturalnych konfitur,</p>
\t\t\t<p class=\"line-4\"> przetworów i syropów</p>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "default/template/common/carousel.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/carousel.twig", "");
    }
}
