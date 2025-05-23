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

/* default/template/blog/article.twig */
class __TwigTemplate_eda3697f2db8704053d00c62f152c3dc extends Template
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

<div id=\"blog\" class=\"blog-article\">
  <!-- Breadcrumbs -->
  <div class=\"container\">
    <div class=\"breadcrumbs\">
      ";
        // line 7
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
            // line 8
            echo "        ";
            if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 8)) {
                // line 9
                echo "          <span class=\"last\">";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 9);
                echo "</span>
        ";
            } elseif ((twig_get_attribute($this->env, $this->source,             // line 10
$context["loop"], "index", [], "any", false, false, false, 10) != 2)) {
                // line 11
                echo "          <a class=\"link\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
                echo "</a>
          <i>/</i>
        ";
            }
            // line 14
            echo "      ";
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
        // line 15
        echo "    </div>
  </div>

  <!-- Картинка с наложенным заголовком -->
  <div class=\"image-wrapper\" style=\"position: relative;\">
    <!-- Фоновая картинка с z-index: 0 -->
    <img src=\"image/";
        // line 21
        echo ($context["image"] ?? null);
        echo "\"  style=\"width: 100%;
    max-height: 360px;
    position: relative;
    object-fit: cover;
    filter: brightness(60%);
    z-index: 0;\">
    <!-- Заголовок, наложенный на картинку (z-index выше) -->
    <div class=\"heading-overlay\" style=\"
          position: absolute;
          top: 15%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: 1;
          text-align: center;
          width: 100%;
          color: #fff;\">
      <h1 class=\"heading-title\">";
        // line 37
        echo ($context["heading_title"] ?? null);
        echo "</h1>
    </div>
  </div>

  <!-- Описание -->
  <div class=\"container\">
    <article>
      <div class=\"content\">
        ";
        // line 45
        echo ($context["description"] ?? null);
        echo "
      </div>
    </article>
  </div>

  ";
        // line 50
        echo ($context["content_top"] ?? null);
        echo "
  ";
        // line 51
        echo ($context["column_left"] ?? null);
        echo "
  ";
        // line 52
        echo ($context["column_right"] ?? null);
        echo "
  ";
        // line 53
        echo ($context["content_bottom"] ?? null);
        echo "
</div>

";
        // line 56
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/blog/article.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 56,  154 => 53,  150 => 52,  146 => 51,  142 => 50,  134 => 45,  123 => 37,  104 => 21,  96 => 15,  82 => 14,  73 => 11,  71 => 10,  66 => 9,  63 => 8,  46 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/blog/article.twig", "");
    }
}
