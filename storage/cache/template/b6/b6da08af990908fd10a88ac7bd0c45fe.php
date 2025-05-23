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

/* default/template/checkout/checkout_totals.twig */
class __TwigTemplate_817a86e38f52d9a1e23877d1b1d12e88 extends Template
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
        $context['_seq'] = twig_ensure_traversable(($context["totals"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["total"]) {
            // line 2
            echo "<div class=\"total-row  df jcsb\">
\t<div class=\"total-item\">";
            // line 3
            echo twig_get_attribute($this->env, $this->source, $context["total"], "title", [], "any", false, false, false, 3);
            echo ":</div>
\t";
            // line 4
            if ((twig_get_attribute($this->env, $this->source, $context["total"], "code", [], "any", false, false, false, 4) == $context["total"])) {
                // line 5
                echo "\t<div class=\"total-price total-price-small\">";
                echo twig_get_attribute($this->env, $this->source, $context["total"], "value", [], "any", false, false, false, 5);
                echo "</div>
\t";
            } else {
                // line 7
                echo "\t<span class=\"total-price\">";
                echo twig_get_attribute($this->env, $this->source, $context["total"], "value", [], "any", false, false, false, 7);
                echo "</span>
\t";
            }
            // line 9
            echo "</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['total'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "default/template/checkout/checkout_totals.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 9,  56 => 7,  50 => 5,  48 => 4,  44 => 3,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/checkout_totals.twig", "");
    }
}
