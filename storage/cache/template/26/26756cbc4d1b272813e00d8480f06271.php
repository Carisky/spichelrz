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

/* default/template/product/review.twig */
class __TwigTemplate_474858170ce4c57a7852fa752e38fe7c extends Template
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
        if (($context["reviews"] ?? null)) {
            // line 2
            echo "\t<div class=\"reviews-list\">
\t\t";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["reviews"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                // line 4
                echo "\t\t\t<div class=\"review-item\">
\t\t\t\t<div class=\"review-date\">";
                // line 5
                echo twig_get_attribute($this->env, $this->source, $context["review"], "date_added", [], "any", false, false, false, 5);
                echo "</div>
\t\t\t\t<div class=\"review-author\">";
                // line 6
                echo twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 6);
                echo "</div>
\t\t\t\t<div class=\"review-text\">";
                // line 7
                echo twig_get_attribute($this->env, $this->source, $context["review"], "text", [], "any", false, false, false, 7);
                echo "</div>
\t\t\t\t<div class=\"review-rating\">
\t\t\t\t\t";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 5));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 10
                    echo "\t\t\t\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 10) < $context["i"])) {
                        // line 11
                        echo "\t\t\t\t\t\t\t";
                        // line 12
                        echo "\t\t\t\t\t\t\t<svg width=\"33\" height=\"15\" viewbox=\"0 0 13 12\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
\t\t\t\t\t\t\t\t<path d=\"M6.5 0.618034L7.59607 3.99139C7.72994 4.40341 8.1139 4.68237 8.54713 4.68237H12.0941L9.22453 6.76722C8.87405 7.02186 8.72739 7.47323 8.86126 7.88526L9.95733 11.2586L7.08779 9.17376C6.7373 8.91912 6.2627 8.91912 5.91221 9.17376L3.04267 11.2586L4.13874 7.88525C4.27261 7.47323 4.12595 7.02186 3.77547 6.76722L0.905918 4.68237H4.45287C4.8861 4.68237 5.27006 4.40341 5.40393 3.99139L6.5 0.618034Z\" stroke=\"#C7A992\"/>
\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t";
                    } else {
                        // line 16
                        echo "\t\t\t\t\t\t\t";
                        // line 17
                        echo "\t\t\t\t\t\t\t<svg width=\"33\" height=\"15\" viewbox=\"0 0 13 12\" fill=\"#C7A992\" xmlns=\"http://www.w3.org/2000/svg\">
\t\t\t\t\t\t\t\t<path d=\"M6.5 0.618034L7.59607 3.99139C7.72994 4.40341 8.1139 4.68237 8.54713 4.68237H12.0941L9.22453 6.76722C8.87405 7.02186 8.72739 7.47323 8.86126 7.88526L9.95733 11.2586L7.08779 9.17376C6.7373 8.91912 6.2627 8.91912 5.91221 9.17376L3.04267 11.2586L4.13874 7.88525C4.27261 7.47323 4.12595 7.02186 3.77547 6.76722L0.905918 4.68237H4.45287C4.8861 4.68237 5.27006 4.40341 5.40393 3.99139L6.5 0.618034Z\" stroke=\"#C7A992\"/>
\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t";
                    }
                    // line 21
                    echo "\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "
\t\t\t\t</div>
\t\t\t</div>
      <div class=\"separator\"></div>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "\t</div>
\t<div class=\"reviews-footer\">
\t\t<!--<div class=\"reviews-pagination\">";
            // line 29
            echo ($context["pagination"] ?? null);
            echo "</div>-->
\t\t<!--<div class=\"reviews-results\">";
            // line 30
            echo ($context["results"] ?? null);
            echo "</div>-->
\t</div>
";
        } else {
            // line 33
            echo "\t<p>";
            echo ($context["text_no_reviews"] ?? null);
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/product/review.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  115 => 33,  109 => 30,  105 => 29,  101 => 27,  91 => 22,  85 => 21,  79 => 17,  77 => 16,  71 => 12,  69 => 11,  66 => 10,  62 => 9,  57 => 7,  53 => 6,  49 => 5,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/product/review.twig", "");
    }
}
