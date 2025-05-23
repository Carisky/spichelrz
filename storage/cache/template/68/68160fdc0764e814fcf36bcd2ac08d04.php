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

/* default/template/account/login.twig */
class __TwigTemplate_01bddbc8d621ea5e0597bed9238dda86 extends Template
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
<div id=\"account-login\" class=\"container\">
\t<div class=\"row\">
\t\t<div class=\"col mb-3\">
\t\t\t<div class=\"border rounded p-3 d-flex flex-column h-100\">
\t\t\t\t<form id=\"form-login\" action=\"";
        // line 6
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" data-oc-toggle=\"ajax\">
\t\t\t\t\t<h2>ZALOGUJ SIĘ</h2>
\t\t\t\t\t<p>WITAMY Z POWROTEM DO NAS</p>
\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t<input type=\"text\" name=\"email\" value=\"";
        // line 10
        echo ($context["email"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\"/>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t<input type=\"password\" name=\"password\" value=\"";
        // line 13
        echo ($context["password"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_password"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control mb-1\"/>
\t\t\t\t\t</div>

\t\t\t\t\t<div class=\"text-end\">
\t\t\t\t\t\t<button type=\"submit\">";
        // line 17
        echo ($context["button_login"] ?? null);
        echo "</button>
\t\t\t\t\t</div>
\t\t\t\t\t";
        // line 19
        if (($context["redirect"] ?? null)) {
            // line 20
            echo "\t\t\t\t\t\t<input type=\"hidden\" name=\"redirect\" value=\"";
            echo ($context["redirect"] ?? null);
            echo "\"/>
\t\t\t\t\t";
        }
        // line 22
        echo "\t\t\t\t</form>
\t\t\t\t<br>
\t\t\t\t<div class=\"text-center mt-3\">
\t\t\t\t\t<a class=\"btn\" href=\"";
        // line 25
        echo ($context["register"] ?? null);
        echo "\" >Zarejestruj sie</a>
\t\t\t\t\t&nbsp;&nbsp;&nbsp;
\t\t\t\t\t<a class=\"btn\" href=\"/index.php?route=account/forgotten\" >Nie pamiętasz hasła?</a>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        // line 33
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/account/login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 33,  87 => 25,  82 => 22,  76 => 20,  74 => 19,  69 => 17,  60 => 13,  52 => 10,  45 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/account/login.twig", "");
    }
}
