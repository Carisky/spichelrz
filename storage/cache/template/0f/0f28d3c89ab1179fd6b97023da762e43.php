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

/* default/template/error/not_found.twig */
class __TwigTemplate_b631ccfb30af448929f1500fb8fcca82 extends Template
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
        echo ($context["header"] ?? null);
        echo "
<div id=\"error-not-found\" class=\"container\">
\t<div class=\"not-found-page\">

\t\t<div class=\"element text\">4</div>
\t\t<div class=\"element image\">

\t\t\t<img src=\"image/catalog/assets/error_page.png\"/>
\t\t\t<div class=\"over\">
\t\t\t\t<div class=\"error\">Ojej! Coś poszło nie tak.
\t\t\t\t</div>
\t\t\t\t<div class=\"description\">
\t\t\t\t\t<p>Nie znaleziono żądanej strony lub strona nie istnieje.</p>
\t\t\t\t\t<p>Prosimy użyć menu lub opcji wyszukiwania w portalu.</p>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"element text\">4</div>

\t</div>
</div>
";
        // line 22
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/error/not_found.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 22,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/error/not_found.twig", "");
    }
}
