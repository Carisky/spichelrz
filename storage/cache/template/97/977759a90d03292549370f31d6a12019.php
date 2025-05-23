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

/* default/template/common/footer.twig */
class __TwigTemplate_798133b0023324ba980591c1df9c39f1 extends Template
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
        echo "<footer>
\t";
        // line 2
        if (($context["schemas_org"] ?? null)) {
            // line 3
            echo "\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["schemas_org"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["schema"]) {
                // line 4
                echo "\t\t\t <script type=\"application/ld+json\">
\t\t\t        ";
                // line 5
                echo $context["schema"];
                echo "
\t\t\t        </script>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['schema'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 8
            echo "\t";
        }
        // line 9
        echo "\t<div class=\"desktop\">
\t\t<div class=\"footer-top\">
\t\t\t<div class=\"footer-list\">
\t\t\t\t<div class=\"footer-logo\">
\t\t\t\t\t<img src=\"image/catalog/assets/white_logo.svg\">
\t\t\t\t</div>
\t\t\t\t<div class=\"social-networks\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<a href=\"https://allegro.pl/uzytkownik/spichlerz24pl?order=m\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/allegro_icon.svg\"/></a>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<a href=\"https://www.instagram.com/spichlerz24.pl/\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/instagram_icon.svg\"/></a>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<a href=\"https://www.facebook.com/spichlerz24\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/facebook_icon.svg\"/></a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"footer-list\">
\t\t\t\t<a href=\"/o-nas\">O NAS</a>
\t\t\t\t<a href=\"/sklep\">SKLEP</a>
\t\t\t\t<a href=\"/hurtownia\">Platforma B2B</a>
\t\t\t\t<a href=\"/wspolpraca\">WSPÓŁPRACA</a>
\t\t\t</div>
\t\t\t<div class=\"footer-list\">
\t\t\t\t<a href=\"/regulamin-sklepu\">REGULAMIN SKLEPU</a>
\t\t\t\t<a href=\"/najczesciej-zadawane-pytania\">NAJCZĘŚCIEJ ZADAWANE PYTANIA</a>
\t\t\t\t<a href=\"/dostawa-i-platnosc\">KOSZT I SPOSÓB DOSTAWY</a>
\t\t\t\t<a href=\"/kontakt\">KONTAKT</a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"footer-separator\"></div>
\t\t<div class=\"footer-bottom\">
\t\t\t<div>
\t\t\t\tCopyright 2023. Wszelkie prawa zastrzeżone.
\t\t\t</div>
\t\t</div>
\t</div>
\t<div class=\"footer-mobile\">
\t\t<div class=\"top\">
\t\t\t<img src=\"image/catalog/assets/white_logo.svg\">
\t\t</div>
\t\t<div class=\"midle\">
\t\t\t<div class=\"footer-list\">
\t\t\t\t<a href=\"/o-nas\">O NAS</a>
\t\t\t\t<a href=\"/sklep\">SKLEP</a>
\t\t\t\t<a href=\"/hurtownia\">Platforma B2B</a>
\t\t\t\t<a href=\"/wspolpraca\">WSPÓŁPRACA</a>
\t\t\t</div>
\t\t\t<div class=\"footer-list\">
\t\t\t\t<a href=\"/regulamin-sklepu\">REGULAMIN SKLEPU</a>
\t\t\t\t<a href=\"/najczesciej-zadawane-pytania\">NAJCZĘŚCIEJ ZADAWANE PYTANIA</a>
\t\t\t\t<a href=\"/dostawa-i-platnosc\">KOSZT I SPOSÓB DOSTAWY</a>
\t\t\t\t<a href=\"/kontakt\">KONTAKT</a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"bottom\">
\t\t\t<div class=\"social-networks\">
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://allegro.pl/uzytkownik/spichlerz24pl?order=m\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/allegro_icon.svg\"/></a>
\t\t\t\t</div>
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://www.instagram.com/spichlerz24.pl/\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/instagram_icon.svg\"/></a>
\t\t\t\t</div>
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://www.facebook.com/spichlerz24\" target=\"_blank\" rel=\"noopener\"><img src=\"image/catalog/assets/facebook_icon.svg\"/></a>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 79
        if (($context["scripts"] ?? null)) {
            // line 80
            echo "\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
                // line 81
                echo "\t\t\t <script src=\"";
                echo $context["script"];
                echo "\" type=\"text/javascript\"></script>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 83
            echo "\t";
        }
        // line 84
        echo "</footer>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 84,  150 => 83,  141 => 81,  136 => 80,  134 => 79,  62 => 9,  59 => 8,  50 => 5,  47 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/footer.twig", "");
    }
}
