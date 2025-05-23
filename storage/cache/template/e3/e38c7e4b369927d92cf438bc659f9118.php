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

/* default/template/common/header.twig */
class __TwigTemplate_3c66d652d7fdf1c2b413b3e4bf589a2d extends Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
\t<head>
\t\t<meta charset=\"UTF-8\"/>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t\t <script type=\"text/javascript\" src=\"/catalog/view/javascript/jquery/jquery-3.7.0.min.js\"></script>
\t\t <script src=\"/catalog/view/javascript/bootstrap/js/bootstrap.min.js\" type=\"text/javascript\"></script>
\t\t\t";
        // line 9
        if (($context["scripts"] ?? null)) {
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
                // line 10
                echo "\t\t\t\t <script src=\"";
                echo $context["script"];
                echo "\" type=\"text/javascript\"></script>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "\t\t";
        }
        // line 13
        echo "\t\t<link href=\"/catalog/view/theme/default/stylesheet/stylesheet.css\" type=\"text/css\" rel=\"stylesheet\"/>
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap\" rel=\"stylesheet\">
\t\t<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
\t\t<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
\t\t<script src=\"https://www.google.com/recaptcha/api.js?onload=onloadReviewCaptcha&render=explicit\" async defer></script>
\t\t<link href=\"https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap\" rel=\"stylesheet\">
\t\t<meta property=\"og:image\" content=\"";
        // line 21
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb", [], "any", false, false, false, 21);
        echo "\">
\t\t<title>";
        // line 22
        echo ($context["title"] ?? null);
        echo "</title>
\t\t<base href=\"";
        // line 23
        echo ($context["base"] ?? null);
        echo "\"/>
\t\t";
        // line 24
        if (($context["description"] ?? null)) {
            // line 25
            echo "\t\t\t<meta name=\"description\" content=\"";
            echo ($context["description"] ?? null);
            echo "\"/>
\t\t";
        }
        // line 27
        echo "\t\t";
        if (($context["keywords"] ?? null)) {
            // line 28
            echo "\t\t\t<meta name=\"keywords\" content=\"";
            echo ($context["keywords"] ?? null);
            echo "\"/>
\t\t";
        }
        // line 30
        echo "\t\t <script src=\"/catalog/view/javascript/common.js\" type=\"text/javascript\"></script>

\t\t";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 33
            echo "\t\t\t<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 33);
            echo "\" type=\"text/css\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 33);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 33);
            echo "\"/>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 36
            echo "\t\t\t <script src=\"";
            echo twig_get_attribute($this->env, $this->source, $context["script"], "href", [], "any", false, false, false, 36);
            echo "\" type=\"text/javascript\"></script>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 39
            echo "\t\t\t<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 39);
            echo "\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 39);
            echo "\"/>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 42
            echo "\t\t\t";
            echo $context["analytic"];
            echo "
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['analytic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "\t\t";
        echo ($context["schemas_org"] ?? null);
        echo "

\t</head>
\t<body>
\t\t<header class=\"container\">

\t\t\t<div id=\"search-input-container\" class=\"search-input-container\">
\t\t\t\t<div class=\"wrapper\">
\t\t\t\t\t<input type=\"text\" id=\"search-input\" placeholder=\"Szukaj...\">
\t\t\t\t\t<span class=\"close-btn\" id=\"close-search\">&times;</span>
\t\t\t\t</div>
\t\t\t\t<div id=\"live-search\" class=\"live-search\">
\t\t\t\t\t<ul></ul>
\t\t\t\t\t<div class=\"result-text\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div>
\t\t\t\t<img id=\"menu-icon\" src=\"image/catalog/assets/menu_icon.svg\">
\t\t\t</div>
\t\t\t<div class=\"logo\">
\t\t\t\t<a href=\"/\">
\t\t\t\t\t<img src=\"image/catalog/assets/logo.svg\">
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<div class=\"right-group\">
\t\t\t\t<img id=\"search-icon\" src=\"image/catalog/assets/search.svg\"/>
\t\t\t\t<div id=\"cart-button\" class=\"cart-button\">
\t\t\t\t\t<div id=\"cart-count-wrap\">
\t\t\t\t\t\t<div id=\"cart-count\">0</div>
\t\t\t\t\t</div>
\t\t\t\t\t<img height=\"25\" src=\"image/catalog/assets/add_to_cart_ico.svg\">
\t\t\t\t</div>
\t\t\t</div>
\t\t</header>


\t\t<div id=\"modalCart\" class=\"modal-cart\">
\t\t\t<span class=\"close-btn\" id=\"closeCart\">&times;</span>

\t\t\t<div class=\"top\">
\t\t\t\t<p>Zawartość koszyka</p>
\t\t\t</div>
\t\t\t<div id=\"cart-list\" class=\"list\"></div>
\t\t\t<div class=\"bottom\">

\t\t\t\t<div class=\"left\">
\t\t\t\t\t<p>Wzystko</p>
\t\t\t\t\t<p id=\"total\">0</p>
\t\t\t\t</div>
\t\t\t\t<div class=\"right\">
\t\t\t\t\t<a class=\"checkout\" href=\"/index.php?route=checkout/buy\">
\t\t\t\t\t\t<div>
\t\t\t\t\t\t\tZŁOŻ ZAMÓWIENIE
\t\t\t\t\t\t</div>
\t\t\t\t\t</a>
\t\t\t\t</div>

\t\t\t</div>
\t\t</div>
\t\t<div id=\"modalMenu\" class=\"modal-menu\">
\t\t\t<span class=\"close-btn\" id=\"closeMenu\">&times;</span>
\t\t\t<div class=\"toggle-page-btn\" id=\"togglePage\"><img src=\"image/catalog/assets/arrow_right.svg\"/></div>
\t\t\t<div id=\"first-page\" class=\"left\">
\t\t\t\t<ul>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/sklep\">Sklep</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/hurtownia\">Platforma B2B</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/wspolpraca\">Współpraca</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/blog\">Blog</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/kontakt\">Kontakt</a>
\t\t\t\t\t</li>
\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"/konto\">Moje konto</a>
\t\t\t\t\t</li>
\t\t\t\t</ul>

\t\t\t\t<div id=\"socials\" class=\"bottom\">
\t\t\t\t\t<a href=\"https://allegro.pl/uzytkownik/spichlerz24pl?order=m\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/allegro_icon_brown.svg\"/></a>
\t\t\t\t\t<a href=\"https://www.instagram.com/spichlerz24.pl/\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/instagram_icon_brown.svg\"/></a>
\t\t\t\t\t<a href=\"https://www.facebook.com/spichlerz24\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/facebook_icon_brown.svg\"/></a>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div id=\"second-page\" class=\"right\">
\t\t\t\t<ul>
\t\t\t\t\t";
        // line 136
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["shop_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 137
            echo "\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a href=\"";
            // line 138
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 138);
            echo "\">";
            echo twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 138));
            echo "</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        echo "\t\t\t\t</ul>
\t\t\t\t<div id=\"menu-bottom\" class=\"bottom\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<div>Masz Pytania? Zadzwoń</div>
\t\t\t\t\t\t<div>+48 502 879 474</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<div>Poland, woj. Małopolskie,</div>
\t\t\t\t\t\t<div>Kraków, ul. Blokowa 2</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>

\t\t</div>
\t</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 141,  276 => 138,  273 => 137,  269 => 136,  173 => 44,  164 => 42,  159 => 41,  148 => 39,  143 => 38,  134 => 36,  129 => 35,  116 => 33,  112 => 32,  108 => 30,  102 => 28,  99 => 27,  93 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  69 => 13,  66 => 12,  57 => 10,  52 => 9,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/header.twig", "");
    }
}
