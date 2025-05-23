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

/* default/template/checkout/address.twig */
class __TwigTemplate_101e017b12071291712ebb5a96d26553 extends Template
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
        echo "<h3>Podstawowe dane</h3>

";
        // line 3
        if (($context["addresses"] ?? null)) {
            // line 4
            echo "<div class=\"form-block\">
\t<select name=\"address[address_id]\" id=\"input-address\" data-nice-select>
\t\t<option value=\"\" disabled";
            // line 6
            echo (( !twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "address_id", [], "any", false, false, false, 6)) ? (" selected") : (""));
            echo "> --- Wybierz adres --- </option>
\t\t";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["addresses"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 8
                echo "\t\t<option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "address_id", [], "any", false, false, false, 8);
                echo "\"";
                echo (((twig_get_attribute($this->env, $this->source, $context["item"], "address_id", [], "any", false, false, false, 8) == twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "address_id", [], "any", false, false, false, 8))) ? (" selected") : (""));
                echo ">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "city", [], "any", false, false, false, 8);
                echo ", ";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "address_1", [], "any", false, false, false, 8);
                echo "</option>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "    </select>
</div>
";
        }
        // line 13
        echo "<div class=\"df jcsb fww\">
\t<div class=\"popup-input w50\" data-error=\"firstname\">
\t\t<input type=\"text\" name=\"address[firstname]\" value=\"";
        // line 15
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "firstname", [], "any", false, false, false, 15);
        echo "\" placeholder=\"";
        echo ($context["entry_firstname"] ?? null);
        echo "\">
\t\t<div class=\"form-error\"></div>
\t</div>
\t<div class=\"popup-input w50\" data-error=\"lastname\" style=\"margin-left: 18px;\">
\t\t<input type=\"text\" name=\"address[lastname]\" value=\"";
        // line 19
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "lastname", [], "any", false, false, false, 19);
        echo "\" placeholder=\"";
        echo ($context["entry_lastname"] ?? null);
        echo "\">
\t\t<div class=\"form-error\"></div>
\t</div>
</div>
<div class=\"form-block\" data-error=\"address_1\">
    <input type=\"text\" name=\"address[address_1]\" value=\"";
        // line 24
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "address_1", [], "any", false, false, false, 24);
        echo "\" placeholder=\"";
        echo ($context["entry_address_1"] ?? null);
        echo "\" />
\t<div class=\"form-error\"></div>
</div>
<div class=\"form-block\" data-error=\"city\">
\t<input type=\"text\" name=\"address[city]\" value=\"";
        // line 28
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "city", [], "any", false, false, false, 28);
        echo "\" placeholder=\"";
        echo ($context["entry_city"] ?? null);
        echo "\" />
\t<div class=\"form-error\"></div>
</div>
<div class=\"form-block\" data-error=\"postcode\">
\t<input type=\"text\" name=\"address[postcode]\" value=\"";
        // line 32
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "postcode", [], "any", false, false, false, 32);
        echo "\" placeholder=\"";
        echo ($context["entry_postcode"] ?? null);
        echo "\" />
\t<div class=\"form-error\"></div>
</div>
<input type=\"hidden\" name=\"address[zone_id]\" value=\"0\">
<!--
<div class=\"form-block\" data-error=\"zone\">
\t<select name=\"address[zone_id]\" id=\"input-zone\" data-nice-select>
\t\t<option value=\"\" disabled";
        // line 39
        echo (( !twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "zone_id", [], "any", false, false, false, 39)) ? (" selected") : (""));
        echo ">--- Wybierz państwo ---</option>
\t\t";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["zones"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["zone"]) {
            // line 41
            echo "\t\t<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 41);
            echo "\"";
            echo (((twig_get_attribute($this->env, $this->source, $context["zone"], "zone_id", [], "any", false, false, false, 41) == twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "zone_id", [], "any", false, false, false, 41))) ? (" selected") : (""));
            echo ">";
            echo twig_get_attribute($this->env, $this->source, $context["zone"], "name", [], "any", false, false, false, 41);
            echo "</option>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "\t</select>
\t<div class=\"form-error\"></div>
</div>
-->
<div class=\"form-block\" data-error=\"telephone\">
\t<input type=\"text\" name=\"address[telephone]\" value=\"";
        // line 48
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "telephone", [], "any", false, false, false, 48);
        echo "\"\" placeholder=\"Telefon\">
\t<div class=\"form-error\"></div>
</div>
<div class=\"form-block\" data-error=\"email\">
\t<input type=\"text\" name=\"address[email]\" value=\"";
        // line 52
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "email", [], "any", false, false, false, 52);
        echo "\" placeholder=\"";
        echo ($context["entry_email_address"] ?? null);
        echo "\" />
\t<div class=\"form-error\"></div>
</div>

<div class=\"form-block\">
\t<input type=\"text\" name=\"address[company]\" value=\"";
        // line 57
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "company", [], "any", false, false, false, 57);
        echo "\" placeholder=\"";
        echo ($context["entry_company"] ?? null);
        echo "\" id=\"input-shipping-company\" class=\"form-control\" />
</div>
<div class=\"form-block\">
\t<input type=\"text\" name=\"address[nip]\" value=\"";
        // line 60
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "nip", [], "any", false, false, false, 60);
        echo "\" placeholder=\"NIP\" id=\"input-shipping-nip\" class=\"form-control\" />
</div>

<div class=\"comment-block\">
\t<h3>Uwagi do zamówienia (opcjonalne)</h3>
\t<div class=\"textarea-wrapper\">
\t\t<textarea name=\"comment\" rows=\"4\" class=\"form-control\">";
        // line 66
        echo ($context["comment"] ?? null);
        echo ($context["commenta"] ?? null);
        echo "</textarea>
\t</div>
</div>
<input type=\"hidden\" name=\"address[country_id]\" value=\"";
        // line 69
        echo twig_get_attribute($this->env, $this->source, ($context["shipping_address"] ?? null), "country_id", [], "any", false, false, false, 69);
        echo "\">";
    }

    public function getTemplateName()
    {
        return "default/template/checkout/address.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  197 => 69,  190 => 66,  181 => 60,  173 => 57,  163 => 52,  156 => 48,  149 => 43,  136 => 41,  132 => 40,  128 => 39,  116 => 32,  107 => 28,  98 => 24,  88 => 19,  79 => 15,  75 => 13,  70 => 10,  55 => 8,  51 => 7,  47 => 6,  43 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/address.twig", "");
    }
}
