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

/* default/template/account/order_list.twig */
class __TwigTemplate_d9a7953522f939a905a4495df6137eb8 extends Template
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
<div id=\"account-order\" class=\"container\">
  <!-- <ul class=\"breadcrumb\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 5
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 5);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 5);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "  </ul> -->
  <div class=\"row\">";
        // line 8
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 9
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 10
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 11
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 12
            echo "    ";
            $context["class"] = "col-sm-9";
            // line 13
            echo "    ";
        } else {
            // line 14
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 15
            echo "    ";
        }
        // line 16
        echo "    <aside id=\"column-right\" style=\"padding: 20px;\" class=\"col-sm-3 hidden-xs\">
      <div class=\"list-group\">
      <a href=\"/index.php?route=account/order\" class=\"list-group-item\">Moje konto</a>
      <a href=\"/index.php?route=account/edit\" class=\"list-group-item\">Ustawienia konta</a> 
      <a href=\"/index.php?route=account/password\" class=\"list-group-item\">Hasło</a>
      <a href=\"/index.php?route=account/logout\" class=\"list-group-item\">Wyloguj się</a>
      </div>
    </aside>
    <div id=\"content\" style=\"padding: 20px;\" class=\"";
        // line 24
        echo ($context["class"] ?? null);
        echo "\">";
        echo ($context["content_top"] ?? null);
        echo "
      <h1>";
        // line 25
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <br>
      <br>
      ";
        // line 28
        if (($context["orders"] ?? null)) {
            // line 29
            echo "      <div class=\"table-responsive\">
        <table class=\"table table-bordered table-hover\">
          <thead>
            <tr>
              <td class=\"text-right\">";
            // line 33
            echo ($context["column_order_id"] ?? null);
            echo "</td>
              <td class=\"text-left\">";
            // line 34
            echo ($context["column_customer"] ?? null);
            echo "</td>
              <td class=\"text-right\">";
            // line 35
            echo ($context["column_product"] ?? null);
            echo "</td>
              <td class=\"text-left\">";
            // line 36
            echo ($context["column_status"] ?? null);
            echo "</td>
              <td class=\"text-right\">";
            // line 37
            echo ($context["column_total"] ?? null);
            echo "</td>
              <td class=\"text-left\">";
            // line 38
            echo ($context["column_date_added"] ?? null);
            echo "</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
           ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["orders"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["order"]) {
                // line 44
                echo "            <tr>
              <td class=\"text-right\">#";
                // line 45
                echo twig_get_attribute($this->env, $this->source, $context["order"], "order_id", [], "any", false, false, false, 45);
                echo "</td>
              <td class=\"text-left\">";
                // line 46
                echo twig_get_attribute($this->env, $this->source, $context["order"], "name", [], "any", false, false, false, 46);
                echo "</td>
              <td class=\"text-right\">";
                // line 47
                echo twig_get_attribute($this->env, $this->source, $context["order"], "products", [], "any", false, false, false, 47);
                echo "</td>
              <td class=\"text-left\">";
                // line 48
                echo twig_get_attribute($this->env, $this->source, $context["order"], "status", [], "any", false, false, false, 48);
                echo "</td>
              <td class=\"text-right\">";
                // line 49
                echo twig_get_attribute($this->env, $this->source, $context["order"], "total", [], "any", false, false, false, 49);
                echo "</td>
              <td class=\"text-left\">";
                // line 50
                echo twig_get_attribute($this->env, $this->source, $context["order"], "date_added", [], "any", false, false, false, 50);
                echo "</td>
              <td class=\"text-right\"><a href=\"";
                // line 51
                echo twig_get_attribute($this->env, $this->source, $context["order"], "view", [], "any", false, false, false, 51);
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo ($context["button_view"] ?? null);
                echo "\" class=\"btn btn-info blk\"><i class=\"fa fa-eye\"></i></a></td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 54
            echo "          </tbody>
        </table>
      </div>
      <div class=\"row\">
        <div class=\"col-sm-6 text-left\">";
            // line 58
            echo ($context["pagination"] ?? null);
            echo "</div>
        <div class=\"col-sm-6 text-right\">";
            // line 59
            echo ($context["results"] ?? null);
            echo "</div>
      </div>
      ";
        } else {
            // line 62
            echo "      <p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
      ";
        }
        // line 64
        echo "      <!-- <div class=\"buttons clearfix\">
        <div class=\"pull-right\"><a href=\"";
        // line 65
        echo ($context["continue"] ?? null);
        echo "\" class=\"btn\">";
        echo ($context["button_continue"] ?? null);
        echo "</a></div>
      </div> -->
      <!-- ";
        // line 67
        echo ($context["content_bottom"] ?? null);
        echo " -->
      </div>
    <!-- ";
        // line 69
        echo ($context["column_right"] ?? null);
        echo " -->
    </div>
</div>
";
        // line 72
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/account/order_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 72,  222 => 69,  217 => 67,  210 => 65,  207 => 64,  201 => 62,  195 => 59,  191 => 58,  185 => 54,  174 => 51,  170 => 50,  166 => 49,  162 => 48,  158 => 47,  154 => 46,  150 => 45,  147 => 44,  143 => 43,  135 => 38,  131 => 37,  127 => 36,  123 => 35,  119 => 34,  115 => 33,  109 => 29,  107 => 28,  101 => 25,  95 => 24,  85 => 16,  82 => 15,  79 => 14,  76 => 13,  73 => 12,  70 => 11,  67 => 10,  65 => 9,  61 => 8,  58 => 7,  47 => 5,  43 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/account/order_list.twig", "");
    }
}
