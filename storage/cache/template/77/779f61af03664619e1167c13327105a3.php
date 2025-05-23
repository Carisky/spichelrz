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

/* default/template/common/cart_pannel.twig */
class __TwigTemplate_ad20beac26f50229de0347c2708c3bea extends Template
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
        echo "<div class=\"cart-pannel ta\" data-cart-pannel>
\t<div class=\"cart-close posa\" data-cart-close>
\t\t<svg width=\"40\" height=\"40\"><use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#cross\"></use></svg>
\t</div>
\t<div class=\"cart-title\">ZAWARTOŚĆ KOSZYKA</div>
\t<div class=\"cart-list\" data-cart-list>";
        // line 6
        echo ($context["cart_list"] ?? null);
        echo "</div>
</div>\t";
    }

    public function getTemplateName()
    {
        return "default/template/common/cart_pannel.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/cart_pannel.twig", "");
    }
}
