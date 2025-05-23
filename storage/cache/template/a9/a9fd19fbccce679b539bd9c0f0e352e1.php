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

/* default/template/common/categories_list.twig */
class __TwigTemplate_02b46189d8ba4a00be2b705b10adec0a extends Template
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
        echo "<div class=\"categories-list row\">
\t<div class=\"container\">
\t\t<a href=\"/konfitury\">
\t\t\t<img src=\"/image/catalog/assets/konfitury--2048x2048.png\"/>
\t\t\t<a href=\"/konfitury\">KONFITURY</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/mini40g\">
\t\t\t<img src=\"/image/catalog/assets/maluchy-2048x2048.png\"/>
\t\t\t<a href=\"/mini40g\">MALUCHY W
\t\t\t\t<br>SPICHLERZU</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/miody\">
\t\t\t<img src=\"/image/catalog/assets/Miody-2048x2048.png\"/>
\t\t\t<a href=\"/miody\">MIODY</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/owoce-w-syropi\">
\t\t\t<img src=\"/image/catalog/assets/owoce-w-syropie-2048x2048.png\"/>
\t\t\t<a href=\"/owoce-w-syropie\">OWOCE W
\t\t\t\t<br>
\t\t\t\tSYROPIE</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/przetwory-warzywne\">
\t\t\t<img src=\"/image/catalog/assets/przetwory.jpg\"/>
\t\t\t<a href=\"/przetwory-warzywne\">PRZETWORY
\t\t\t\t<br>
\t\t\t\tWARZYWNE</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/syropy\">
\t\t\t<img src=\"/image/catalog/assets/syropy-2048x2048.png\"/>
\t\t\t<a href=\"/syropy\">SYROPY</a>
\t\t</a>
\t</div>
\t<div class=\"container\">
\t\t<a href=\"/zestawy-prezentowe\">
\t\t\t<img src=\"/image/catalog/assets/gift_packs.jpeg\"/>
\t\t\t<a href=\"/zestawy-prezentowe\">ZESTAWY
\t\t\t\t<br>
\t\t\t\tPREZENTOWE</a>
\t\t</a>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/categories_list.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/categories_list.twig", "");
    }
}
