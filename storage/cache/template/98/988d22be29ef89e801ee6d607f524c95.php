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

/* default/template/checkout/buy.twig */
class __TwigTemplate_516021ed280e09d255982f465f15d65a extends Template
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
<style>
\t.cart-quantity {
\tborder: none;
\twidth: 150px;
}
.df, .checkbox > b, .radio > b {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
}
.checkout-profile .popup-input.w50 {
  width: calc(50% - 10px);
}
.method {
    padding: 0 18px;
    margin-bottom: 8px;
    font-size: 16px;
    line-height: 20px;
    color: #7D7D7D;
    font-weight: 700;
}
.method .name {
\twidth: 100%;
}
.method label {
\tpadding: 22px 0;
}
.method .radio > b {
    width: 16px;
    height: 16px;
    border-radius: 20px;
\tborder: 1px solid #D8D5D5;
    margin: 0 10px 0 5px;
    flex-shrink: 0;
}
.method .radio input {
    display: none;
}
.method .radio span .btn-map {
    line-height: 1.2;
    font-size: 14px;
    display: none;
    border-radius: 30px;
    text-decoration: none;
\tfont-weight: 400;
\t/*color: inherit;*/
\tmargin: 15px;
\tpadding: 15px;
\tbackground: #a68264;
\tcolor: #fff;
}
.method .radio b:before {
    content: '';
    display: block;
    width: 15px;
    height: 15px;
    background-color: transparent;
    border-radius: 8px;
}
.method .radio input:checked + b:before {
    background-color: #161211;
}
.method .radio input:checked + b + span > .btn-map {
    display: block;
}
.btn-map svg {
    width: 12px;
    height: 6px;
    margin-left: 10px;
    margin-bottom: 1px;
}
</style>

<div id=\"checkout-checkout\" class=\"page-wrapper container\">
\t<h1 class=\"page-title\" style=\"display:none;\">";
        // line 78
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t<form id=\"checkout\">
\t\t<div class=\"checkout-cart\">
\t\t\t<h2 class=\"checkout-block-title\">";
        // line 81
        echo ($context["text_cart"] ?? null);
        echo "</h2>
\t\t\t<table class=\"checkout-cart-rows\">
\t\t\t\t<thead class=\"checkout-cart-header\">
\t\t\t\t\t<tr>
\t\t\t\t\t\t<th class=\"header-name\">Product</th>
\t\t\t\t\t\t<th class=\"header-qnt\">Ilość</th>
\t\t\t\t\t\t<th class=\"header-price\">Cena</th>
\t\t\t\t\t\t<th class=\"header-sum\">Wartość</th>
\t\t\t\t\t\t<th class=\"header-del\">Usunąć</th>
\t\t\t\t\t</tr>
\t\t\t\t</thead>
\t\t\t\t<tbody class=\"checkout-cart-list\" data-cart>";
        // line 92
        echo ($context["cart"] ?? null);
        echo "</tbody>
\t\t\t</table>
\t\t</div>
\t\t<div class=\"checkout-main df jcsb\">
\t\t\t<div class=\"column left-col\">
\t\t\t\t<h2 class=\"checkout-block-title df aic\"><span>01</span>";
        // line 97
        echo ($context["text_your_details"] ?? null);
        echo "</h2>
\t\t\t\t<div class=\"checkout-profile\" data-address>";
        // line 98
        echo ($context["address"] ?? null);
        echo "</div>
\t\t\t\t";
        // line 99
        if ((($context["free_shipping"] ?? null) > 0)) {
            // line 100
            echo "\t\t\t\t<div class=\"shipping-header posr\">
\t\t\t\t\t<h2 class=\"column checkout-block-title df aic\"><span>02</span>";
            // line 101
            echo ($context["text_shipping_method"] ?? null);
            echo "</h2>
\t\t\t\t\t<div class=\"free-shipping df\">
\t\t\t\t\t\t<div class=\"description\">
\t\t\t\t\t\t\t<span>Dodaj jeszcze do koszyka produkty o wartości min. ";
            // line 104
            echo ($context["free_shipping"] ?? null);
            echo "<span class=\"currency-symbol\">";
            echo ($context["currency_symbol"] ?? null);
            echo "</span>, a otrzymasz darmową dostawę</span>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"value df fdc aic jcc \">
\t\t\t\t\t\t\t<div class=\"title\">Darmowa<br>dostawa od</div>
\t\t\t\t\t\t\t<div class=\"sum\">";
            // line 108
            echo ($context["free_shipping"] ?? null);
            echo "<span class=\"currency-symbol\">";
            echo ($context["currency_symbol"] ?? null);
            echo "</span></div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t";
        } else {
            // line 113
            echo "\t\t\t\t<h2 class=\"column checkout-block-title df aic\"><span>02</span>";
            echo ($context["text_shipping_method"] ?? null);
            echo "</h2>
\t\t\t\t";
        }
        // line 115
        echo "\t\t\t\t<div class=\"checkout-shipping\" data-shipping>";
        echo ($context["shipping"] ?? null);
        echo "</div>
\t\t\t</div>
\t\t\t<div class=\"column right-col\">
\t\t\t\t
\t\t\t\t<h2 class=\"column checkout-block-title df aic\"><span>03</span>";
        // line 119
        echo ($context["text_payment_method"] ?? null);
        echo "</h2>
\t\t\t\t<div class=\"checkout-payment\" data-payment>";
        // line 120
        echo ($context["payment"] ?? null);
        echo "</div>
\t\t\t\t<h2 class=\"column checkout-block-title df aic\"><span>04</span>";
        // line 121
        echo ($context["text_totals"] ?? null);
        echo "</h2>
\t\t\t\t<div class=\"checkout-codes\">
\t\t\t\t ";
        // line 123
        echo ($context["coupon"] ?? null);
        echo " 
\t\t\t\t<!-- ";
        // line 124
        echo ($context["reward"] ?? null);
        echo " -->
\t\t\t\t</div>
\t\t\t\t<div class=\"checkout-totals\" data-totals>";
        // line 126
        echo ($context["totals"] ?? null);
        echo "</div>
\t\t\t\t<div class=\"form-block\" data-error=\"agree\">
\t\t\t\t\t<label class=\"checkbox large-box df small-text\">
\t\t\t\t\t\t<input type=\"checkbox\" name=\"agree\" value=\"1\"";
        // line 129
        echo ((($context["agree"] ?? null)) ? (" checked") : (""));
        echo ">
\t\t\t\t\t\t<b></b>
\t\t\t\t\t\t<div>Zapoznałem się i akceptuję Regulamin Sklepu Internetowego, Politykę Prywatności w celu realizacji zamówienia. *</div>
\t\t\t\t\t</label>
\t\t\t\t\t<div class=\"form-error\"></div>
\t\t\t\t</div>
\t\t\t\t<div class=\"confirm df jce\">
\t\t\t\t\t<button type=\"button\" class=\"btn df aic jcc\" onclick=\"save()\">
\t\t\t\t\t\tZamawiam
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</form>
\t<div id=\"payment\" style=\"display:none;\"></div>
\t<input id=\"inpostPointSelected\" style=\"display:none;\" type=\"hidden\" value=\"0\"/>
</div>
";
        // line 146
        echo ($context["footer"] ?? null);
        echo "

";
        // line 148
        if (($context["map_key"] ?? null)) {
            // line 149
            echo "<script src=\"catalog/view/theme/default/js/inpost.js\"></script>
<script src=\"https://maps.googleapis.com/maps/api/js?key=";
            // line 150
            echo ($context["map_key"] ?? null);
            echo "&callback=initMap\"></script>
<script src=\"https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js\"></script>

";
            // line 153
            $context["geoWidgetToken"] = "eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJzQlpXVzFNZzVlQnpDYU1XU3JvTlBjRWFveFpXcW9Ua2FuZVB3X291LWxvIn0.eyJleHAiOjIwNTY3MTc1NjcsImlhdCI6MTc0MTM1NzU2NywianRpIjoiNjFlYTU4MzItNWZjNi00NDUxLTk3N2YtNTMzYjhiY2Y3NTYwIiwiaXNzIjoiaHR0cHM6Ly9sb2dpbi5pbnBvc3QucGwvYXV0aC9yZWFsbXMvZXh0ZXJuYWwiLCJzdWIiOiJmOjEyNDc1MDUxLTFjMDMtNGU1OS1iYTBjLTJiNDU2OTVlZjUzNTpiNmY4cEM5ZXNpS1l5YzZpOS1tWHV2eXd6M2dLOURBb0xBOS1SX0t4dXVVIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoic2hpcHgiLCJzZXNzaW9uX3N0YXRlIjoiODdmMzBhMmEtMTVmNS00MzA4LTg2YTQtNWFlZmNhZmY2MDA0Iiwic2NvcGUiOiJvcGVuaWQgYXBpOmFwaXBvaW50cyIsInNpZCI6Ijg3ZjMwYTJhLTE1ZjUtNDMwOC04NmE0LTVhZWZjYWZmNjAwNCIsImFsbG93ZWRfcmVmZXJyZXJzIjoic3BpY2hsZXJ6MjQucGwiLCJ1dWlkIjoiZTE2NGQ4OWYtZDJmMS00MmQwLTg3MTMtOWUwMmM1MjQ5ZTZmIn0.U_7O1HUjHcHUflbo90tZtJsdDK1-8nKjWw4jtjn-Yp68vdb39pzzQsAAGLMkvNIfxnKC0Gft9XvXEBby318CWXGYTFqG7usdu1Vte7YY6l6voaqSNSQYIs08GIinrdhR1w6K7qwxmakJ1vRpDFSr9fn79xdpsbM6LgmYi4GL8qNeevnkb-Sa1ULKVIU87Eoe0bvvTb7gRf1ldI5pswAjkKwbjTK2166YwdnR1HLoPd1KjJnqrHX9R4hCu_UolhV8OgiNQjLVhQ_FyNDjuJCudbik2VC4lZda9cesvVNXc8cKXzx7Vb3f1uZMNPjvtYGJNnhaorGSLNxvqHkNMsXJPw";
            // line 154
            echo "
<div class=\"modal fade\" id=\"inpostGeoWidgetModal\" tabindex=\"-1\" role=\"dialog\">
    
</div>
";
            // line 158
            if (($context["inpostSandbox"] ?? null)) {
                // line 159
                echo "    ";
                $context["geoWidgetUrl"] = "https://sandbox-easy-geowidget-sdk.easypack24.net";
            } else {
                // line 161
                echo "    ";
                $context["geoWidgetUrl"] = "https://geowidget.inpost.pl";
            }
            // line 163
            echo "<link rel=\"stylesheet\" href=\"";
            echo ($context["geoWidgetUrl"] ?? null);
            echo "/inpost-geowidget.css\" />
<script src=\"";
            // line 164
            echo ($context["geoWidgetUrl"] ?? null);
            echo "/inpost-geowidget.js\" defer></script>

";
        }
        // line 167
        echo "
<script>
//\$( document ).ready(function() {
//\tif (\$.cookie(\"txtcard\")!=undefined) \$('textarea[name=comment]').val('Tekst do kartki: '+\$.cookie(\"txtcard\"));
//});

\tfunction saveCoupon() {
\t\t\$(document).find('[data-error=\"coupon\"]').removeClass('input-error').find('.form-error').text('').hide();
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/save_coupon',
\t\t\ttype: 'post',
\t\t\tdataType: 'json',
\t\t\tdata: {
\t\t\t\tcoupon: \$(document).find('[name=\"coupon\"]').val(),
\t\t\t},
\t\t\tsuccess: function(json) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tif (json.error)  \$(document).find('[data-error=\"coupon\"]').addClass('input-error').find('.form-error').text(json.error).show();
\t\t\t\tif (json.success) nrShowMessage(json.success, 1);
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t}
\t
\tfunction saveReward() {
\t\t\$(document).find('[data-error=\"reward\"]').removeClass('input-error').find('.form-error').text('').hide();
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/save_reward',
\t\t\ttype: 'post',
\t\t\tdataType: 'json',
\t\t\tdata: {
\t\t\t\treward: \$(document).find('[name=\"reward\"]').val(),
\t\t\t},
\t\t\tsuccess: function(json) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tif (json.error)  \$(document).find('[data-error=\"reward\"]').addClass('input-error').find('.form-error').text(json.error).show();
\t\t\t\tif (json.success) {
\t\t\t\t\t\$(document).find('[data-points]').text(json.reward);
\t\t\t\t\tnrShowMessage(json.success, 1);
\t\t\t\t}
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t}
\t
\tfunction cartUpdate() {
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/refresh_cart',
\t\t\ttype: 'post',
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tconsole.log(json);
\t\t\t\t\$('#loader').remove();
\t\t\t\tcheckJson(json);
\t\t\t\t\$('[data-cart]').html(json.cart);
\t\t\t\t\$('[data-shipping]').html(json.shipping);
\t\t\t\t\$('[data-payment]').html(json.payment);
\t\t\t\t\$('[data-totals]').html(json.totals);
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t}
\t
\tfunction save() {
\t\t\$(document).find('[data-error]').removeClass('input-error').find('.form-error').text('').hide();
\t\tif (( \$(\"#inpostPointSelected\").val()==0 ) && ( \$(document).find('[data-modal-map]').css('display')=='block' ) ) {
\t\t\talert(\"Wybierz paczkomat!\");
\t\t} else {
\t\t\t\$('body').append(loader);
\t\t\t\$.ajax({
\t\t\t\turl: 'index.php?route=checkout/buy/save_order',
\t\t\t\ttype: 'post',
\t\t\t\tdataType: 'json',
\t\t\t\tdata: \$('#checkout').serialize(),
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\t//\$.removeCookie(\"txtcard\");
\t\t\t\t\tcheckJson(json);
\t\t\t\t\tif(json.error) {
\t\t\t\t\t\t\$.each(json.error, function(i, v){
\t\t\t\t\t\t\t\$('[data-error=\"'+i+'\"]').addClass('input-error').find('.form-error').text(v).show();
\t\t\t\t\t\t});
\t\t\t\t\t} else if(json.payment) {
\t\t\t\t\t\ttry { \$('#payment').html(json.payment).find('#button-confirm').click(); } catch (e) {}
\t\t\t\t\t\ttry { \$('#payment').html(json.payment).find('.js-bluepayment-confirm').click(); } catch (e) {}
\t\t\t\t\t\t// try {
\t\t\t\t\t\t//  \tif (\$('#payment').html(json.payment).find('.js-bluepayment-confirm').length>0) {
\t\t\t\t\t\t// \t\twindow.location.href = 'index.php?route=extension/payment/bluepayment/processCheckout';
\t\t\t\t\t\t//  \t}
\t\t\t\t\t\t// } catch (e) {}
\t\t\t\t\t} else {
\t\t\t\t\t\tconsole.log(json);
\t\t\t\t\t}
\t\t\t\t},
\t\t\t\terror: function(data) {
\t\t\t\t\t\$('#loader').remove();
\t\t\t\t\tconsole.log(data.responseText);
\t\t\t\t}
\t\t\t});
\t\t}

\t}
\t
\t\$('[data-address]').on('change', '#input-address', function() {
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/change_address&address_id='+\$(this).val(),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tcheckJson(json);
\t\t\t\t\$('[data-address]').html(json.address);
\t\t\t\tNiceSelect.bind(document.getElementById('input-address'));
\t\t\t\tNiceSelect.bind(document.getElementById('input-zone'));
\t\t\t\t\$('[data-shipping]').html(json.shipping);
\t\t\t\t\$('[data-payment]').html(json.payment);
\t\t\t\t\$('[data-totals]').html(json.totals);
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t});
\t
\t\$('[data-address]').on('change', '#input-zone', function() {
\t\t\$('[data-address]').find('[name=\"address[city]\"]').val('');
\t\t\$('[data-address]').find('[name=\"address[address_1]\"]').val('');
\t\t\$('[data-address]').find('[name=\"address[postcode]\"]').val('');
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/change_zone&zone_id='+\$(this).val(),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tcheckJson(json);
\t\t\t\t\$('[data-shipping]').html(json.shipping);
\t\t\t\t\$('[data-payment]').html(json.payment);
\t\t\t\t\$('[data-totals]').html(json.totals);
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t});
\t
\t\$('[data-shipping]').on('change', 'input', function() {
\t\t\$('body').append(loader);
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/change_shipping&code='+\$(this).filter(':checked').val(),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tcheckJson(json);
\t\t\t\t\$('[data-payment]').html(json.payment);
\t\t\t\t\$('[data-totals]').html(json.totals);
\t\t\t\t\$('body').append(json.s);
\t\t\t},
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t});
\t
\t\$('[data-payment]').on('change', 'input', function() {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=checkout/buy/change_payment&code='+\$(this).filter(':checked').val(),
\t\t\terror: function(data) {
\t\t\t\t\$('#loader').remove();
\t\t\t\tconsole.log(data.responseText);
\t\t\t}
\t\t});
\t});
\t
\tif(typeof(button) != 'function') {
\t\t\$.fn.button = function(s){return;}
\t}
\t
\t\$(document).on('click', '[data-qnt-btn]', function(){
\t\tvar th = \$(this),
\t\t\tb = th.parents('[data-quantity]'),
\t\t\ti = b.find('input'),
\t\t\tv = parseInt(i.val());
\t\tif(th.data('qnt-btn') > 0) {
\t\t\tv++;
\t\t\tif(b.is('[data-max]') && b.data('max') > 0 && v > b.data('max')) return false;
\t\t} else {
\t\t\tif(v < 2) return false;
\t\t\tv = v - 1;
\t\t\tif(b.is('[data-min]') && v < b.data('min')) return false;
\t\t}
\t\ti.val(v);
\t\tif(th.parents('[data-cart-item]').length) cart.update(b.data('cart'), v);
\t\tif(typeof(cartUpdate) == 'function') cartUpdate(b.parents('[data-product]'), v);
\t});

\t\$(document).on('input', '[data-input-quantity]', function(){
\t\tvar th = \$(this),
\t\t\tb = th.parents('[data-quantity]'),
\t\t\tv = parseInt(th.val());
\t\tif(b.is('[data-min]') && v < b.data('min')) th.val(b.data('min'));
\t\tif(b.is('[data-max]') && b.data('max') > 0 && v > b.data('max')) th.val(b.data('max'));
\t\tif(th.parents('[data-cart-item]').length) cart.update(b.data('cart'), v);
\t\tif(typeof(cartUpdate) == 'function') cartUpdate(b.parents('[data-product]'), v);
\t});

\tfunction checkJson(json) {
\t\tif(json.redirect == 1) {
\t\t\tdocument.location.reload();
\t\t} else if(json.redirect) {
\t\t\twindow.location.href = json.redirect;
\t\t}
\t\tif(json.warning) nrShowMessage(json.warning);
\t\tif(json.log) console.log(json.log);
\t}

</script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "default/template/checkout/buy.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  290 => 167,  284 => 164,  279 => 163,  275 => 161,  271 => 159,  269 => 158,  263 => 154,  261 => 153,  255 => 150,  252 => 149,  250 => 148,  245 => 146,  225 => 129,  219 => 126,  214 => 124,  210 => 123,  205 => 121,  201 => 120,  197 => 119,  189 => 115,  183 => 113,  173 => 108,  164 => 104,  158 => 101,  155 => 100,  153 => 99,  149 => 98,  145 => 97,  137 => 92,  123 => 81,  117 => 78,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/checkout/buy.twig", "");
    }
}
