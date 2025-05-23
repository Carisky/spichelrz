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

/* default/template/checkout/coupon.twig */
class __TwigTemplate_b9674fe92ae6123c4748a9c5b83c0961 extends Template
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
        echo "<div class=\"form-block df aic\"data-error=\"coupon\">
\t<div class=\"form-block-label\">Mam kupon</div>
\t<div class=\"form-block-box\" >
\t\t<input type=\"text\" name=\"coupon\" value=\"";
        // line 4
        echo ($context["coupon"] ?? null);
        echo "\" />
\t\t<div class=\"form-error\"></div>
\t</div>
\t<button type=\"button\" class=\"btn\" onclick=\"saveCoupon()\">ok</button>
</div>
";
    }

    public function getTemplateName()
    {
        return "default/template/checkout/coupon.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/coupon.twig", "");
    }
}
