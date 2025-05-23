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

/* default/template/checkout/cart.twig */
class __TwigTemplate_820eb127b8773ffdf37e0e64189e43cc extends Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 2
            echo "<tr class=\"checkout-cart-item\" data-cart-item>
\t<div class=\"cart-image-mobile hidden\">
\t\t<a  href=\"";
            // line 4
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 4);
            echo "\"><img src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 4);
            echo "\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 4);
            echo "\"></a>
\t</div>
\t<td class=\"cart-name\">
\t\t<a  href=\"";
            // line 7
            echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 7);
            echo "\" class=\"df aic\">
\t\t\t<img src=\"";
            // line 8
            echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 8);
            echo "\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 8);
            echo "\">
\t\t\t<span>";
            // line 9
            echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 9);
            echo "</span>
\t\t</a>
\t<td class=\"cart-quantity-cell\">
\t\t<div class=\"cart-quantity df\" data-quantity data-min=\"";
            // line 12
            echo twig_get_attribute($this->env, $this->source, $context["product"], "minimum", [], "any", false, false, false, 12);
            echo "\" data-max=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "stock", [], "any", false, false, false, 12);
            echo "\" data-cart=\"";
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 12);
            echo "\">
\t\t\t<div class=\"gnt-btn df jcc aic\" data-qnt-btn=\"0\">-</div>
\t\t\t<input type=\"number\" name=\"quantity\" value=\"";
            // line 14
            echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 14);
            echo "\" data-input-quantity class=\"form-control cnt\">
\t\t\t<div class=\"gnt-btn df jcc aic\" data-qnt-btn=\"1\">+</div>
\t\t</div>
\t</td>
\t<td class=\"cart-price\">";
            // line 18
            echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 18);
            echo "</td>
\t<td class=\"cart-sum\">";
            // line 19
            echo twig_get_attribute($this->env, $this->source, $context["product"], "total", [], "any", false, false, false, 19);
            echo "</td>
\t<td class=\"cart-remove\">
\t\t<button type=\"button\" class=\"btn-hidden\" onclick=\"cart.remove(";
            // line 21
            echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 21);
            echo ");\">
\t\t\t<svg width=\"20\" height=\"28\"><use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#trash\"></use></svg>
\t\t</button>
\t</td>
</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "default/template/checkout/cart.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 21,  91 => 19,  87 => 18,  80 => 14,  71 => 12,  65 => 9,  59 => 8,  55 => 7,  45 => 4,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/cart.twig", "");
    }
}
