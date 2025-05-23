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

/* default/template/extension/module/nr_wholesale.twig */
class __TwigTemplate_6334c9f534eb2d4b254de3816c15e768 extends Template
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
        if (($context["redirect"] ?? null)) {
            // line 2
            echo "\t <script>
\t\t\t\t\t\t\t\t\tvar redi = '";
            // line 3
            echo ($context["redirect"] ?? null);
            echo "';
\t\t\t\t\t\t\t\t\t//window.location.href = '";
            // line 4
            echo ($context["redirect"] ?? null);
            echo "';
\t\t\t\t\t\t\t\t</script>
\t";
            // line 6
            if (($context["logged"] ?? null)) {
                // line 7
                echo "
\t\t";
            } else {
                // line 9
                echo "
\t\t\t<h2>Zaloguj się lub zarejestruj</h2>
\t\t\t<div class=\"wholsale-auth-wrapper\">
\t\t\t\t<div class=\"popup-bottomRegister\" style=\"display: inline-block; margin-bottom:10px\">
\t\t\t\t\t<a class=\"icon-wrap account-icon df aic jcc ta2\" href=\"/login\" style=\"width:250px\" data-fancybox>
\t\t\t\t\t\t<svg>
\t\t\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#user\"></use>
\t\t\t\t\t\t</svg>&nbsp;
\t\t\t\t\t\t<h3>Zaloguj się</h3>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"popup-bottomRegister\" style=\"display: inline-block; margin-bottom:10px\">
\t\t\t\t\t<a class=\"icon-wrap account-icon df aic jcc ta2\" href=\"/register\" style=\"width:250px\" data-fancybox=\"\" data-close-popup=\"\">
\t\t\t\t\t\t<svg>
\t\t\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#user\"></use>
\t\t\t\t\t\t</svg>&nbsp;
\t\t\t\t\t\t<h3>Zarejestruj się</h3>
\t\t\t\t\t</a>
\t\t\t\t</div>
\t\t\t</div>
\t";
            }
        } else {
            // line 31
            echo "\t<style>
\t\t.checkout-payment {
\t\t\tmargin-left: 20%;
\t\t}
\t\t.total-item {
\t\t\tmargin-left: 20%;
\t\t}
\t\t.shipping-info {
\t\t\tmargin-left: 20%;
\t\t}
\t\t.shipping-info .df {
\t\t\tdisplay: -webkit-box;
\t\t\tdisplay: -webkit-flex;
\t\t\tdisplay: -moz-box;
\t\t\tdisplay: -ms-flexbox;
\t\t\tdisplay: flex;
\t\t}
\t</style>

\t<form id=\"wholesale\">
\t\t<h2 class=\"product-title3\">Twoje dane</h2>
\t\t<div class=\"wholesale-customer-data df jcsb\">
\t\t\t<div class=\"column left\">
\t\t\t\t<h3>Podstawowe dane</h3>
\t\t\t\t";
            // line 55
            if (($context["addresses"] ?? null)) {
                // line 56
                echo "\t\t\t\t\t<div class=\"form-block\" data-error=\"address_id\">
\t\t\t\t\t\t<select name=\"address[address_id]\" id=\"input-address\" data-nice-select>
\t\t\t\t\t\t\t<option value=\"\" disabled ";
                // line 58
                echo (( !twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "address_id", [], "any", false, false, false, 58)) ? (" selected") : (""));
                echo ">
\t\t\t\t\t\t\t\t--- Wybierz adres ---
\t\t\t\t\t\t\t</option>
\t\t\t\t\t\t\t";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["addresses"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 62
                    echo "\t\t\t\t\t\t\t\t<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "address_id", [], "any", false, false, false, 62);
                    echo "\" ";
                    echo (((twig_get_attribute($this->env, $this->source, $context["item"], "address_id", [], "any", false, false, false, 62) == twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "address_id", [], "any", false, false, false, 62))) ? (" selected") : (""));
                    echo ">";
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "city", [], "any", false, false, false, 62);
                    echo ",
\t\t\t\t\t\t\t\t\t";
                    // line 63
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "address_1", [], "any", false, false, false, 63);
                    echo "</option>
\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 65
                echo "\t\t\t\t\t\t</select>
\t\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t\t</div>
\t\t\t\t";
            } else {
                // line 69
                echo "\t\t\t\t\t<input type=\"hidden\" name=\"address[address_id]\" value=\"0\">
\t\t\t\t";
            }
            // line 71
            echo "\t\t\t\t<div class=\"form-block\" data-error=\"firstname\">
\t\t\t\t\t<input type=\"text\" name=\"address[firstname]\" value=\"";
            // line 72
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "firstname", [], "any", false, false, false, 72);
            echo "\" placeholder=\"";
            echo ($context["entry_firstname"] ?? null);
            echo "\">
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"lastname\">
\t\t\t\t\t<input type=\"text\" name=\"address[lastname]\" value=\"";
            // line 76
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "lastname", [], "any", false, false, false, 76);
            echo "\" placeholder=\"";
            echo ($context["entry_lastname"] ?? null);
            echo "\">
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"email\">
\t\t\t\t\t<input type=\"email\" name=\"address[email]\" value=\"";
            // line 80
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "email", [], "any", false, false, false, 80);
            echo "\" placeholder=\"";
            echo ($context["entry_email_address"] ?? null);
            echo "\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"telephone\">
\t\t\t\t\t<input type=\"text\" name=\"address[telephone]\" value=\"";
            // line 84
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "telephone", [], "any", false, false, false, 84);
            echo "\" placeholder=\"";
            echo ($context["entry_telephone"] ?? null);
            echo "\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"company\">
\t\t\t\t\t<input type=\"text\" name=\"address[company]\" value=\"";
            // line 88
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "company", [], "any", false, false, false, 88);
            echo "\" placeholder=\"";
            echo ($context["entry_company"] ?? null);
            echo "\" id=\"input-shipping-company\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"nip\">
\t\t\t\t\t<input type=\"text\" name=\"address[nip]\" value=\"";
            // line 92
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "nip", [], "any", false, false, false, 92);
            echo "\" placeholder=\"NIP\" id=\"input-shipping-nip\" inputmode=\"numeric\" pattern=\"[0-9]*\" maxlength=\"10\" oninput=\"this.value=this.value.replace(/\\D/g,'');\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>

\t\t\t</div>
\t\t\t<div class=\"column right\">
\t\t\t\t<h3>Dane do wysyłki</h3>
\t\t\t\t<!-- <div class=\"form-block\" data-error=\"address_1\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"textarea-wrapper\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<textarea name=\"address[address_1]\" class=\"form-control shipping\">";
            // line 101
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "address_1", [], "any", false, false, false, 101);
            echo "</textarea>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div> -->
\t\t\t\t<div class=\"form-block\" data-error=\"address_1\">
\t\t\t\t\t<input type=\"text\" name=\"address[address_1]\" value=\"";
            // line 105
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "address_1", [], "any", false, false, false, 105);
            echo "\" placeholder=\"";
            echo ($context["entry_address_1"] ?? null);
            echo "\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"city\">
\t\t\t\t\t<input type=\"text\" name=\"address[city]\" value=\"";
            // line 109
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "city", [], "any", false, false, false, 109);
            echo "\" placeholder=\"";
            echo ($context["entry_city"] ?? null);
            echo "\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"form-block\" data-error=\"postcode\">
\t\t\t\t\t<input type=\"text\" name=\"address[postcode]\" value=\"";
            // line 113
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "postcode", [], "any", false, false, false, 113);
            echo "\" placeholder=\"";
            echo ($context["entry_postcode"] ?? null);
            echo "\"/>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>


\t\t\t\t<h3>Komentarz do zamówienia</h3>
\t\t\t\t<div class=\"form-block\">
\t\t\t\t\t<div class=\"textarea-wrapper\">
\t\t\t\t\t\t<textarea name=\"address[comment]\" class=\"form-control comment";
            // line 121
            echo ((($context["addresses"] ?? null)) ? (" tall") : (""));
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, ($context["address"] ?? null), "comment", [], "any", false, false, false, 121);
            echo "</textarea>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"wholesale-products\">
\t\t\t";
            // line 127
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 128
                echo "\t\t\t\t<h2 class=\"product-title3\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 128);
                echo "</h2>
\t\t\t\t<div class=\"product-list\">
\t\t\t\t\t<table>
\t\t\t\t\t\t<thead>
\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t<th>Okładka</th>
\t\t\t\t\t\t\t\t<th class=\"name\">Nazwa produktu</th>
\t\t\t\t\t\t\t\t<th>Ilość opakowań zbiorczych</th>
\t\t\t\t\t\t\t\t<th>Sztuk w opakowaniu</th>
\t\t\t\t\t\t\t\t<th>Suma</th>
\t\t\t\t\t\t\t\t<th>Cena</th>
\t\t\t\t\t\t\t\t<th>Wszystko</th>
\t\t\t\t\t\t\t\t<th>Status</th>
\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t</thead>
\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t";
                // line 144
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "products", [], "any", false, false, false, 144));
                foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                    // line 145
                    echo "\t\t\t\t\t\t\t\t<tr class=\"mobile-item aic\" style=\"display:none !important;\" data-mobile-product=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 145);
                    echo "\">
\t\t\t\t\t\t\t\t\t<td class=\"trigger\" data-product-trigger>
\t\t\t\t\t\t\t\t\t\t<svg class=\"ta\">
\t\t\t\t\t\t\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#trigger\"></use>
\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mobile-image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    // line 152
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 152);
                    echo "\" alt=\"\">
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mobile-name\">";
                    // line 154
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 154);
                    echo "</td>
\t\t\t\t\t\t\t\t\t<td class=\"mobile-mark\">
\t\t\t\t\t\t\t\t\t\t<div class=\"buy-mark";
                    // line 156
                    echo ((twig_get_attribute($this->env, $this->source, (($__internal_compile_0 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 156)] ?? null) : null), "packs", [], "any", false, false, false, 156)) ? (" active") : (""));
                    echo " ta posr\" data-mark>
\t\t\t\t\t\t\t\t\t\t\t<svg class=\"posa\">
\t\t\t\t\t\t\t\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#check\"></use>
\t\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr class=\"product-row\" data-product=\"";
                    // line 163
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 163);
                    echo "\" data-price=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price_abs", [], "any", false, false, false, 163);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product[";
                    // line 164
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 164);
                    echo "][product_id]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 164);
                    echo "\">
\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product[";
                    // line 165
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 165);
                    echo "][price]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 165);
                    echo "\">
\t\t\t\t\t\t\t\t\t<td class=\"image\">
\t\t\t\t\t\t\t\t\t\t<img src=\"";
                    // line 167
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 167);
                    echo "\" alt=\"\">
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"name\">
\t\t\t\t\t\t\t\t\t\t";
                    // line 170
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 170);
                    echo "
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"packs\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mobile-label\">Ilość opakowań zbiorczych</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"cart-quantity df\" data-quantity data-min=\"";
                    // line 174
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "minimum", [], "any", false, false, false, 174);
                    echo "\" data-max=\"0\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"javascript:;\" class=\"gnt-btn df jcc aic posr\" data-qnt-btn=\"0\">-</a>
\t\t\t\t\t\t\t\t\t\t\t<input type=\"number\" name=\"product[";
                    // line 176
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 176);
                    echo "][packs]\" data-input-quantity class=\"form-control cnt\" readonly value=\"";
                    echo ((twig_get_attribute($this->env, $this->source, (($__internal_compile_1 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 176)] ?? null) : null), "packs", [], "any", false, false, false, 176)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_2 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 176)] ?? null) : null), "packs", [], "any", false, false, false, 176)) : (0));
                    echo "\">
\t\t\t\t\t\t\t\t\t\t\t<a href=\"javascript:;\" class=\"gnt-btn df jcc aic posr\" data-qnt-btn=\"1\">+</a>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"pack cnt\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mobile-label\">Sztuk w opakowaniu</div>
\t\t\t\t\t\t\t\t\t\t<span data-inpack>";
                    // line 182
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "in_pack", [], "any", false, false, false, 182);
                    echo "</span>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"wh-quantity cnt\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mobile-label\">Suma</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"char-value\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"number\" readonly class=\"input-hidden cnt\" name=\"product[";
                    // line 187
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 187);
                    echo "][quantity]\" data-amount value=\"";
                    echo ((twig_get_attribute($this->env, $this->source, (($__internal_compile_3 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 187)] ?? null) : null), "quantity", [], "any", false, false, false, 187)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_4 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 187)] ?? null) : null), "quantity", [], "any", false, false, false, 187)) : (0));
                    echo "\">
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"price cnt\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mobile-label\">Cena</div>
\t\t\t\t\t\t\t\t\t\t";
                    // line 192
                    if ((twig_get_attribute($this->env, $this->source, $context["product"], "old_price_numeric", [], "any", false, false, false, 192) > twig_get_attribute($this->env, $this->source, $context["product"], "price_numeric", [], "any", false, false, false, 192))) {
                        // line 193
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"price \">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"old-price\">";
                        // line 194
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "old_price", [], "any", false, false, false, 194);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"current\">";
                        // line 195
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price1", [], "any", false, false, false, 195);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t";
                    } else {
                        // line 198
                        echo "\t\t\t\t\t\t\t\t\t\t\t<div class=\"price\">
\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"current\">";
                        // line 199
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price1", [], "any", false, false, false, 199);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 202
                    echo "\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"product-total cnt\">
\t\t\t\t\t\t\t\t\t\t<div class=\"mobile-label\">Wszystko</div>
\t\t\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"product[";
                    // line 205
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 205);
                    echo "][total]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, (($__internal_compile_5 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 205)] ?? null) : null), "total", [], "any", false, false, false, 205);
                    echo "\" data-total>
\t\t\t\t\t\t\t\t\t\t<b>
\t\t\t\t\t\t\t\t\t\t\t<span data-total-text>";
                    // line 207
                    echo ((twig_get_attribute($this->env, $this->source, (($__internal_compile_6 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 207)] ?? null) : null), "total", [], "any", false, false, false, 207)) ? (twig_get_attribute($this->env, $this->source, (($__internal_compile_7 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 207)] ?? null) : null), "total", [], "any", false, false, false, 207)) : (0));
                    echo "</span>
\t\t\t\t\t\t\t\t\t\t\tzł</b>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t\t<td class=\"mark\">
\t\t\t\t\t\t\t\t\t\t<div class=\"buy-mark";
                    // line 211
                    echo ((twig_get_attribute($this->env, $this->source, (($__internal_compile_8 = ($context["cart_products"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 211)] ?? null) : null), "packs", [], "any", false, false, false, 211)) ? (" active") : (""));
                    echo " ta posr\" data-mark>
\t\t\t\t\t\t\t\t\t\t\t<svg class=\"posa\">
\t\t\t\t\t\t\t\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#check\"></use>
\t\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 219
                echo "\t\t\t\t\t\t</tbody>
\t\t\t\t\t</table>
\t\t\t\t</div>
\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 223
            echo "\t\t</div>
\t\t<div
\t\t\tclass=\"payment-totals-container\" style=\"display: flex; flex-wrap:wrap; justify-content: space-between; align-items: flex-start; width: 100%;\">
\t\t\t<!-- Первый блок: Оплата -->
\t\t\t<div class=\" payment\" style=\"flex: 1; margin-right: 20px;\">
\t\t\t\t<h2>PŁATNOŚĆ</h2>
\t\t\t\t<div class=\"checkout-payment\" data-payment>";
            // line 229
            echo ($context["payment"] ?? null);
            echo "</div>
\t\t\t</div>
\t\t\t<div id=\"payment\" style=\"display:none;\"></div>

\t\t\t<!-- Второй блок: Доставка -->
\t\t\t<div class=\"shipping\" style=\"flex: 1; margin-right: 20px;\">
\t\t\t\t<h2>DOSTAWA</h2>
\t\t\t\t<div class=\"shipping-info\">
\t\t\t\t\t";
            // line 237
            echo ($context["shipping"] ?? null);
            echo "
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<!-- Третий блок: Остальное -->
\t\t\t<div class=\" totals\" style=\"flex: 1;\">
\t\t\t\t<h2>Podsumowanie</h2>
\t\t\t\t<div class=\"total-item\">
\t\t\t\t\t<span>Cena + VAT:</span>
\t\t\t\t\t<span data-totals-subtotal>";
            // line 246
            echo twig_get_attribute($this->env, $this->source, ($context["totals"] ?? null), "subtotal", [], "any", false, false, false, 246);
            echo "</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"total-item\">
\t\t\t\t\t<span>Dostawa:</span>
\t\t\t\t\t<span data-totals-shipping>";
            // line 250
            echo twig_get_attribute($this->env, $this->source, ($context["totals"] ?? null), "shipping", [], "any", false, false, false, 250);
            echo "</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"total-item\">
\t\t\t\t\t<span>Rabat:</span>
\t\t\t\t\t<span data-totals-discount>";
            // line 254
            echo twig_get_attribute($this->env, $this->source, ($context["totals"] ?? null), "discount", [], "any", false, false, false, 254);
            echo "</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"total-item\">
\t\t\t\t\t<span>VAT:</span>
\t\t\t\t\t<span data-totals-tax>";
            // line 258
            echo twig_get_attribute($this->env, $this->source, ($context["totals"] ?? null), "tax", [], "any", false, false, false, 258);
            echo "</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"total-item\">
\t\t\t\t\t<span>Wszystko z VAT:</span>
\t\t\t\t\t<span data-totals-total>";
            // line 262
            echo twig_get_attribute($this->env, $this->source, ($context["totals"] ?? null), "total", [], "any", false, false, false, 262);
            echo "</span>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

\t\t<div id=\"general-error\" class=\"form-error\">";
            // line 267
            echo twig_get_attribute($this->env, $this->source, ($context["error"] ?? null), "general", [], "any", false, false, false, 267);
            echo "</div>


\t\t<div class=\"form-error\">";
            // line 270
            echo twig_get_attribute($this->env, $this->source, ($context["error"] ?? null), "shipping_method", [], "any", false, false, false, 270);
            echo "</div>


\t\t<div class=\"form-error\">";
            // line 273
            echo twig_get_attribute($this->env, $this->source, ($context["error"] ?? null), "payment_method", [], "any", false, false, false, 273);
            echo "</div>

\t\t<div class=\"confirm df jce\">
\t\t\t<button type=\"button\" id=\"wholesale-confirm\" class=\"btn df aic jcc\" onclick=\"confirm()\">
\t\t\t\tZamawiam
\t\t\t\t<svg width=\"24\" height=\"27\">
\t\t\t\t\t<use xlink:href=\"/catalog/view/theme/default/image/sprite.svg#cart\"></use>
\t\t\t\t</svg>
\t\t\t</button>
\t\t</div>
\t</form>
\t <script>
\t\t\t\t\t\t\t\tvar success = 'Dziękujemy za złożenie zamówienia w sklepie. W mailu otrzymasz informacje odnośnie zamówienia';
\t\t\t\t\t\t\t\t\$('[data-payment]').on('change', 'input', function() {
\t\t\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\t\t\turl: 'index.php?route=checkout/buy/change_payment&code='+\$(this).filter(':checked').val(),
\t\t\t\t\t\t\t\t\t\terror: function(data) {
\t\t\t\t\t\t\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\$(document).on('click', '[data-qnt-btn]', function(){
\t\t\t\t\t\t\t\t\tvar th = \$(this),
\t\t\t\t\t\t\t\t\t\tb = th.parents('[data-quantity]'),
\t\t\t\t\t\t\t\t\t\ti = b.find('input'),
\t\t\t\t\t\t\t\t\t\tv = parseInt(i.val());
\t\t\t\t\t\t\t\t\tif(th.data('qnt-btn') > 0) {
\t\t\t\t\t\t\t\t\t\tv++;
\t\t\t\t\t\t\t\t\t\tif(b.data('max') > 0 && v > b.data('max')) return false;
\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\tv = v - 1;
\t\t\t\t\t\t\t\t\t\tif(v < b.data('min')) return false;
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\ti.val(v);
\t\t\t\t\t\t\t\t\tif(th.parents('[data-cart-item]').length) cart.update(b.data('cart'), v);
\t\t\t\t\t\t\t\t\tif(typeof(wholesaleUpdate) == 'function') wholesaleUpdate(b.parents('[data-product]'), v);
\t\t\t\t\t\t\t\t\tif(typeof(cartUpdate) == 'function') cartUpdate(b.parents('[data-product]'), v);
\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\$(document).on('input', '[data-input-quantity]', function(){
\t\t\t\t\t\t\t\t\tvar th = \$(this),
\t\t\t\t\t\t\t\t\t\tb = th.parents('[data-quantity]'),
\t\t\t\t\t\t\t\t\t\tv = parseInt(th.val());
\t\t\t\t\t\t\t\t\tif(v < b.data('min')) th.val(b.data('min'));
\t\t\t\t\t\t\t\t\tif(b.data('max') > 0 && v > b.data('max')) th.val(b.data('max'));
\t\t\t\t\t\t\t\t\tif(th.parents('[data-cart-item]').length) cart.update(b.data('cart'), v);
\t\t\t\t\t\t\t\t\tif(typeof(wholesaleUpdate) == 'function') wholesaleUpdate(b.parents('[data-product]'), v);
\t\t\t\t\t\t\t\t\tif(typeof(cartUpdate) == 'function') cartUpdate(b.parents('[data-product]'), v);
\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\tfunction wholesaleUpdate(p, v) {
\t\t\t\t\t\t\t\t\t\t//console.log(p);
\t\t\t\t\t\t\t\t\t\t//console.log(v);
\t\t\t\t\t\t\t\t\t\tvar s = parseInt(p.find('[data-inpack]').text()) * v,
\t\t\t\t\t\t\t\t\t\t\tt = (Math.round(s * p.data('price')*100) / 100).toFixed(2).replace('.', ','),
\t\t\t\t\t\t\t\t\t\t\tpm = \$('#wholesale').find('[data-mobile-product=\"'+p.data('product')+'\"]');
\t\t\t\t\t\t\t\t\t\tp.find('[data-amount]').val(s);
\t\t\t\t\t\t\t\t\t\tp.find('[data-total]').val(t);
\t\t\t\t\t\t\t\t\t\tp.find('[data-total-text]').text(t);
\t\t\t\t\t\t\t\t\t\tif(v) {
\t\t\t\t\t\t\t\t\t\t\tp.find('[data-mark]').addClass('active');
\t\t\t\t\t\t\t\t\t\t\tpm.find('[data-mark]').addClass('active');
\t\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\t\tp.find('[data-mark]').removeClass('active');
\t\t\t\t\t\t\t\t\t\t\tpm.find('[data-mark]').removeClass('active');
\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t//\$('body').append(loader);
\t\t\t\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\t\t\t\turl: 'index.php?route=extension/module/nr_wholesale/calculate',
\t\t\t\t\t\t\t\t\t\t\ttype: 'post',
\t\t\t\t\t\t\t\t\t\t\tdataType: 'json',
\t\t\t\t\t\t\t\t\t\t\tdata: \$('#wholesale').serialize(),
\t\t\t\t\t\t\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\t\t\t\t\t\t\t//\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-subtotal]').html(json.subtotal);
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-discount]').html(json.discount);
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-shipping]').html(json.shipping);
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-tax]').html(json.tax);
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-total]').html(json.total);
\t\t\t\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\t\t\t\terror: function(data) {
\t\t\t\t\t\t\t\t\t\t\t\t//\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\tfunction confirm() {
\t\t\t\t\t\t\t\t\t\t\$('#wholesale-confirm').prop('disabled', true);
\t\t\t\t\t\t\t\t\t\t\$('[data-error]').removeClass('input-error').find('.form-error').text('').hide();
\t\t\t\t\t\t\t\t\t\t\$('body').append(loader);
\t\t\t\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\t\t\t\turl: 'index.php?route=extension/module/nr_wholesale/order',
\t\t\t\t\t\t\t\t\t\t\ttype: 'post',
\t\t\t\t\t\t\t\t\t\t\tdataType: 'json',
\t\t\t\t\t\t\t\t\t\t\tdata: \$('#wholesale').serialize(),
\t\t\t\t\t\t\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\t\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\t// if(json.error) {
\t\t\t\t\t\t\t\t\t\t\t\t// \t\$.each(json.error, function(i, v){
\t\t\t\t\t\t\t\t\t\t\t\t// \t\t\$('[data-error=\"'+i+'\"]').addClass('input-error').find('.form-error').text(v).show();
\t\t\t\t\t\t\t\t\t\t\t\t// \t});
\t\t\t\t\t\t\t\t\t\t\t\t// } else if(json.order_id) {
\t\t\t\t\t\t\t\t\t\t\t\t// \twindow.location.href = '/konto';
\t\t\t\t\t\t\t\t\t\t\t\t// \t//nrShowMessage(success, 1);
\t\t\t\t\t\t\t\t\t\t\t\t// }
\t\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t\t// checkJson(json);
\t\t\t\t\t\t\t\t\t\t\t\tif(json.error) {
\t\t\t\t\t\t\t\t\t\t\t\t\t\$.each(json.error, function(i, v){
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-error=\"'+i+'\"]').addClass('input-error').find('.form-error').text(v).show();
\t\t\t\t\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t\t\t\t\trenderErrors(json.error);
\t\t\t\t\t\t\t\t\t\t\t\t\t\$('#wholesale-confirm').prop('disabled', false);
\t\t\t\t\t\t\t\t\t\t\t\t\t\$('html, body').animate({ scrollTop: \$('#wholesale').offset().top }, 'slow');
\t\t\t\t\t\t\t\t\t\t\t\t} else if(json.payment) {
\t\t\t\t\t\t\t\t\t\t\t\t\ttry { \$('#payment').html(json.payment).find('#button-confirm').click(); } catch (e) {}
\t\t\t\t\t\t\t\t\t\t\t\t\ttry { \$('#payment').html(json.payment).find('.js-bluepayment-confirm').click(); } catch (e) {}
\t\t\t\t\t\t\t\t\t\t\t\t\t// try {
\t\t\t\t\t\t\t\t\t\t\t\t\t//  \tif (\$('#payment').html(json.payment).find('.js-bluepayment-confirm').length>0) {
\t\t\t\t\t\t\t\t\t\t\t\t\t// \t\twindow.location.href = 'index.php?route=extension/payment/bluepayment/processCheckout';
\t\t\t\t\t\t\t\t\t\t\t\t\t//  \t}
\t\t\t\t\t\t\t\t\t\t\t\t\t// } catch (e) {}
\t\t\t\t\t\t\t\t\t\t\t\t} else {
\t\t\t\t\t\t\t\t\t\t\t\t\tconsole.log(json);
\t\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\t\t\t\terror: function(data) {
\t\t\t\t\t\t\t\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\trenderErrors(data.responseJSON.error);
\t\t\t\t\t\t\t\t\t\t\t\t\$('#wholesale-confirm').prop('disabled', false);
\t\t\t\t\t\t\t\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\$('#input-address').on('change', function() {
\t\t\t\t\t\t\t\t\t\t//\$('body').append(loader);
\t\t\t\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\t\t\t\turl: 'index.php?route=extension/module/nr_wholesale/change_address',
\t\t\t\t\t\t\t\t\t\t\ttype: 'post',
\t\t\t\t\t\t\t\t\t\t\tdata: \$('#wholesale').serialize(),
\t\t\t\t\t\t\t\t\t\t\tsuccess: function(data) {window.location.reload();},
\t\t\t\t\t\t\t\t\t\t\terror: function(data) {
\t\t\t\t\t\t\t\t\t\t\t\t//\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t\$('[data-shipping-methods]').on('change', 'input', function() {
\t\t\t\t\t\t\t\t\t\t//console.log(1)
\t\t\t\t\t\t\t\t\t\t\$('body').append(loader);
\t\t\t\t\t\t\t\t\t\t\$.ajax({
\t\t\t\t\t\t\t\t\t\t\turl: 'index.php?route=extension/module/nr_wholesale/change_shipping',
\t\t\t\t\t\t\t\t\t\t\ttype: 'post',
\t\t\t\t\t\t\t\t\t\t\tdata: { shipping_method: \$(this).val() },
\t\t\t\t\t\t\t\t\t\t\tdataType: 'json',
\t\t\t\t\t\t\t\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\t\t\t\t\t\t\t//console.log(json)
\t\t\t\t\t\t\t\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-shipping]').html(json.shipping);
\t\t\t\t\t\t\t\t\t\t\t\t\$('[data-totals-total]').html(json.total);
\t\t\t\t\t\t\t\t\t\t\t},
\t\t\t\t\t\t\t\t\t\t\terror: function(data) {
\t\t\t\t\t\t\t\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t\t\t\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\t});
\t\t\t\t\t\t\t\t\tfunction renderErrors(errors) {
\t\t\t\t\t\t\t\t// поле-специфичные
\t\t\t\t\t\t\t\t\$.each(errors, function(key, msg) {
\t\t\t\t\t\t\t\t\tif (key === 'general' || key === 'shipping_method' || key === 'payment_method') return;
\t\t\t\t\t\t\t\t\tvar \$block = \$('[data-error=\"'+ key +'\"]');
\t\t\t\t\t\t\t\t\t\$block.addClass('input-error')
\t\t\t\t\t\t\t\t\t\t.find('.form-error').show().text(msg);
\t\t\t\t\t\t\t\t});
\t
\t\t\t\t\t\t\t\t// общие
\t\t\t\t\t\t\t\tvar general = errors.general
\t\t\t\t\t\t\t\t\t\t\t|| errors.shipping_method
\t\t\t\t\t\t\t\t\t\t\t|| errors.payment_method;
\t\t\t\t\t\t\t\tif (general) {
\t\t\t\t\t\t\t\t\t\$('#general-error').show().text(general);
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t}
\t
\t\t\t\t\t\t\t\tfunction scrollToTop() {
\t\t\t\t\t\t\t\t\$('html, body').animate({ scrollTop: \$('#wholesale').offset().top }, 'slow');
\t\t\t\t\t\t\t\t}
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</script>
";
        }
    }

    public function getTemplateName()
    {
        return "default/template/extension/module/nr_wholesale.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  529 => 273,  523 => 270,  517 => 267,  509 => 262,  502 => 258,  495 => 254,  488 => 250,  481 => 246,  469 => 237,  458 => 229,  450 => 223,  441 => 219,  427 => 211,  420 => 207,  413 => 205,  408 => 202,  402 => 199,  399 => 198,  393 => 195,  389 => 194,  386 => 193,  384 => 192,  374 => 187,  366 => 182,  355 => 176,  350 => 174,  343 => 170,  337 => 167,  330 => 165,  324 => 164,  318 => 163,  308 => 156,  303 => 154,  298 => 152,  287 => 145,  283 => 144,  263 => 128,  259 => 127,  248 => 121,  235 => 113,  226 => 109,  217 => 105,  210 => 101,  198 => 92,  189 => 88,  180 => 84,  171 => 80,  162 => 76,  153 => 72,  150 => 71,  146 => 69,  140 => 65,  132 => 63,  123 => 62,  119 => 61,  113 => 58,  109 => 56,  107 => 55,  81 => 31,  57 => 9,  53 => 7,  51 => 6,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/module/nr_wholesale.twig", "");
    }
}
