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

/* default/template/checkout/payment_method.twig */
class __TwigTemplate_84983161289ecfdbecdab6bc8b6bfe41 extends Template
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
        if (($context["payment_methods"] ?? null)) {
            // line 2
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["payment_methods"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["payment_method"]) {
                // line 3
                $context["i"] = 0;
                // line 4
                echo "<div class=\"method posr df aic jcsb\">
\t<label class=\"radio df aic\">
\t\t<input type=\"radio\" name=\"payment_method\" value=\"";
                // line 6
                echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 6);
                echo "\"";
                echo ((((twig_get_attribute($this->env, $this->source, $context["payment_method"], "code", [], "any", false, false, false, 6) == ($context["code"] ?? null)) || ( !($context["code"] ?? null) &&  !($context["i"] ?? null)))) ? (" checked") : (""));
                echo " >
\t\t<b></b>
\t\t<span>
\t\t\t";
                // line 9
                echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "title", [], "any", false, false, false, 9);
                echo "
\t\t\t";
                // line 10
                if (twig_get_attribute($this->env, $this->source, $context["payment_method"], "terms", [], "any", false, false, false, 10)) {
                    // line 11
                    echo "\t\t\t<span>(";
                    echo twig_get_attribute($this->env, $this->source, $context["payment_method"], "terms", [], "any", false, false, false, 11);
                    echo ")</span>
\t\t\t";
                }
                // line 13
                echo "\t\t</span>
\t</label>
</div>
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['payment_method'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "default/template/checkout/payment_method.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 13,  63 => 11,  61 => 10,  57 => 9,  49 => 6,  45 => 4,  43 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/payment_method.twig", "");
    }
}
