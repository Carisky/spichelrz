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

/* default/template/checkout/shipping_method.twig */
class __TwigTemplate_ed658e7763b73fe1477b83d0c5f566d5 extends Template
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
        if (($context["shipping_methods"] ?? null)) {
            // line 2
            $context["i"] = 0;
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["shipping_methods"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["shipping_method"]) {
                // line 4
                if ( !twig_get_attribute($this->env, $this->source, $context["shipping_method"], "error", [], "any", false, false, false, 4)) {
                    // line 5
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["shipping_method"], "quote", [], "any", false, false, false, 5));
                    foreach ($context['_seq'] as $context["_key"] => $context["quote"]) {
                        // line 6
                        echo "<div data-shipping-methods class=\"method posr df aic jcsb\">
\t<div class=\"name\">
\t\t<label class=\"radio df aic\">
\t\t\t<input type=\"radio\" name=\"shipping_method\" value=\"";
                        // line 9
                        echo twig_get_attribute($this->env, $this->source, $context["quote"], "code", [], "any", false, false, false, 9);
                        echo "\"";
                        echo ((((twig_get_attribute($this->env, $this->source, $context["quote"], "code", [], "any", false, false, false, 9) == ($context["code"] ?? null)) || ( !($context["code"] ?? null) &&  !($context["i"] ?? null)))) ? (" checked") : (""));
                        echo " >
\t\t\t<b></b>
\t\t\t<span style=\"margin-left: 6px;\" >";
                        // line 11
                        echo twig_get_attribute($this->env, $this->source, $context["quote"], "title", [], "any", false, false, false, 11);
                        echo ((twig_get_attribute($this->env, $this->source, $context["quote"], "html", [], "any", false, false, false, 11)) ? (twig_get_attribute($this->env, $this->source, $context["quote"], "html", [], "any", false, false, false, 11)) : (""));
                        echo "</span>
\t\t</label>
\t</div>
\t<div class=\"price\" style=\"margin-left: 6px;\" >";
                        // line 14
                        echo twig_get_attribute($this->env, $this->source, $context["quote"], "text", [], "any", false, false, false, 14);
                        echo "</div>
</div>
";
                        // line 16
                        $context["i"] = (($context["i"] ?? null) + 1);
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quote'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                } else {
                    // line 19
                    echo "<div class=\"method df aic\"><span class=\"method-error\">";
                    echo twig_get_attribute($this->env, $this->source, $context["shipping_method"], "error", [], "any", false, false, false, 19);
                    echo "</span></div>
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['shipping_method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "</table>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/checkout/shipping_method.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 22,  82 => 19,  75 => 16,  70 => 14,  63 => 11,  56 => 9,  51 => 6,  47 => 5,  45 => 4,  41 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/shipping_method.twig", "");
    }
}
