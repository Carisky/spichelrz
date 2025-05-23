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

/* default/template/common/work_with_us.twig */
class __TwigTemplate_828c5f6c74ed3b872e84208f087e2186 extends Template
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
        echo "<head>
    <link href=\"catalog/view/theme/default/stylesheet/common/breadcrumbs.css\" type=\"text/css\" rel=\"stylesheet\"/>
    <link href=\"catalog/view/theme/default/stylesheet/common/work_with_us.css\" type=\"text/css\" rel=\"stylesheet\"/>
</head>

";
        // line 6
        echo ($context["header"] ?? null);
        echo "
<div class=\"work-with-us\">
    ";
        // line 8
        if (($context["breadcrumbs"] ?? null)) {
            // line 9
            echo "    <div class=\"breadcrumbs\">
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
                // line 11
                echo "        <div>
            ";
                // line 12
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 12)) {
                    // line 13
                    echo "            <span class=\"last\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 13);
                    echo "</span>
            ";
                } else {
                    // line 15
                    echo "            <a class=\"link\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 15);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 15);
                    echo "</a>
            <span>/</span>
            <!-- Разделитель -->
            ";
                }
                // line 19
                echo "        </div>
        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "    </div>
    ";
        }
        // line 23
        echo "
    <div class=\"content\" style=\"display: block;\">
        <p class=\"content-title\">Korzyści ze współpracy z nami</p>
        <div class=\"list\">
            <div class=\"block\">
                <img src=\"image/catalog/assets/smiling_man.svg\"/>
                <p class=\"title\">Produkcja własna</p>
                <p class=\"text\">Jesteśmy producentem, co gwarantuje szybkie rozwiązywanie wszelkich problemów</p>
            </div>
            <div class=\"block\">
                <img src=\"image/catalog/assets/coin.svg\"/>
                <p class=\"title\">Oszczędzasz na kosztach dostawy</p>
                <p class=\"text\">Darmowa wysyłka już dla nieco większych zamówień</p>
            </div>
            <div class=\"block\">
                <img src=\"image/catalog/assets/storage.svg\"/>
                <p class=\"title\">Brak minimum logistycznego</p>
                <p class=\"text\">Zamawiasz tylko to, co chcesz, ile chcesz i kiedy potrzebujesz – bez zamrażania pieniędzy.</p>
            </div>
            <div class=\"block\">
                <img src=\"image/catalog/assets/courier2.svg\"/>
                <p class=\"title\">Szybka dostawa. Nawet w 24h</p>
                <p class=\"text\">Wszystkie produkty zamawiasz od producenta</p>
            </div>
        </div>
    </div>
</div>
";
        // line 50
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/common/work_with_us.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  140 => 50,  111 => 23,  107 => 21,  92 => 19,  82 => 15,  76 => 13,  74 => 12,  71 => 11,  54 => 10,  51 => 9,  49 => 8,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/work_with_us.twig", "");
    }
}
