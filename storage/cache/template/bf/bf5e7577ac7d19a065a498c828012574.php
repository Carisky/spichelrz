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

/* default/template/common/cart_list.twig */
class __TwigTemplate_f5a009fa81195032599676ec94e25536 extends Template
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
        if (($context["products"] ?? null)) {
            // line 2
            echo "<div class=\"inner\">
\t";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 4
                echo "\t<div class=\"cart-item df\" data-cart-item>
\t\t<a class=\"cart-image\" href=\"";
                // line 5
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 5);
                echo "\"><img src=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 5);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 5);
                echo "\"></a>
\t\t<div class=\"cart-center df fdc ais jcsb\">
\t\t\t<a class=\"cart-name\" href=\"";
                // line 7
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 7);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 7);
                echo "</a>
\t\t\t<div class=\"cart-quantity quantity df\" data-quantity data-cart=\"";
                // line 8
                echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 8);
                echo "\">
\t\t\t\t<div class=\"gnt-btn df jcc aic\" data-qnt-btn=\"0\">-</div>
\t\t\t\t<input type=\"number\" name=\"quantity\" value=\"";
                // line 10
                echo twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 10);
                echo "\" data-input-quantity class=\"form-control cnt\">
\t\t\t\t<div class=\"gnt-btn df jcc aic\" data-qnt-btn=\"1\">+</div>
\t\t\t</div>
\t\t\t<div class=\"cart-sum\">";
                // line 13
                echo twig_get_attribute($this->env, $this->source, $context["product"], "total", [], "any", false, false, false, 13);
                echo "</div>
\t\t</div>
\t\t<div class=\"cart-right df aie jce posr\">
\t\t\t<button type=\"button\" class=\"btn-hidden posa\" onclick=\"cart.remove(";
                // line 16
                echo twig_get_attribute($this->env, $this->source, $context["product"], "cart_id", [], "any", false, false, false, 16);
                echo ");\">
\t\t\t\t<svg width=\"16\" height=\"24\"><use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#trash\"></use></svg>
\t\t\t</button>
\t\t</div>
\t</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "</div>
<div class=\"cart-total-wrap\">
\t<div class=\"totals  df aic jcsb\">
\t\t<label>Wszystko</label>
\t\t<div class=\"cart-total\">";
            // line 26
            echo ($context["total"] ?? null);
            echo "</div>
\t</div>
\t<a href=\"";
            // line 28
            echo ($context["checkout"] ?? null);
            echo "\" class=\"btn dif aic jcc\">
\t\tZŁÓŻ ZAMÓWIENIE
\t\t<svg><use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#btn-arrow\"></use></svg>
\t</a>
</div>
";
        } else {
            // line 34
            echo "<p>Wózek jest pusty</p>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/common/cart_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 34,  104 => 28,  99 => 26,  93 => 22,  81 => 16,  75 => 13,  69 => 10,  64 => 8,  58 => 7,  49 => 5,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/cart_list.twig", "");
    }
}
