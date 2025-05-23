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

/* default/template/account/register.twig */
class __TwigTemplate_38c6b02498c42cbd3def4bdbf7948dcf extends Template
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

<div class=\"alert alert-danger alert-dismissible\" id=\"error-warning\">
\t";
        // line 4
        echo ($context["error_warning"] ?? null);
        echo "</div>

<div id=\"account-register\">
\t<h1>ZAREJESTRUJ SIĘ</h1>
\t<p>masz już konto<a href=\"index.php?route=account/login\">
\t\t\tzaloguj się</a>
\t</p>

\t<form id=\"form-register\" action=\"";
        // line 12
        echo ($context["register"] ?? null);
        echo "\" method=\"post\" data-oc-toggle=\"ajax\">

\t\t<div class=\"form-group required custom-field\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"firstname\" value=\"\" placeholder=\"";
        // line 16
        echo ($context["entry_firstname"] ?? null);
        echo "\" id=\"input-firstname\" class=\"form-control\"/>
\t\t\t\t<div id=\"error-firstname\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group required custom-field\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"lastname\" value=\"\" placeholder=\"";
        // line 23
        echo ($context["entry_lastname"] ?? null);
        echo "\" id=\"input-lastname\" class=\"form-control\"/>
\t\t\t\t<div id=\"error-lastname\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group required  custom-field\" data-sort=\"2\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"custom_field[account][1]\" value=\"\" placeholder=\"Nazwa firmy\" id=\"input-custom-field1\" class=\"form-control\">
\t\t\t\t<div id=\"error-firma\"></div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"form-group required  custom-field\" data-sort=\"3\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"custom_field[account][3]\" value=\"\" placeholder=\"Numer NIP\" id=\"input-custom-field3\" class=\"form-control\">
\t\t\t\t<div id=\"error-nip\"></div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"form-group required  custom-field\" data-sort=\"4\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"custom_field[account][4]\" value=\"\" placeholder=\"Pełny adres\" id=\"input-custom-field4\" class=\"form-control\">
\t\t\t\t<div id=\"error-adres\"></div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"form-group required  custom-field\" data-sort=\"5\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"custom_field[account][6]\" value=\"\" placeholder=\"Miejscowość\" id=\"input-custom-field6\" class=\"form-control\">
\t\t\t\t<div id=\"error-misto\"></div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"form-group required  custom-field\" data-sort=\"6\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"text\" name=\"custom_field[account][7]\" value=\"\" placeholder=\"Kod pocztowy\" id=\"input-custom-field7\" class=\"form-control\">
\t\t\t\t<div id=\"error-kod\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group required\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"email\" name=\"email\" value=\"\" placeholder=\"";
        // line 61
        echo ($context["entry_email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\"/>
\t\t\t\t<div id=\"error-email\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group required\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"tel\" name=\"telephone\" value=\"\" placeholder=\"";
        // line 68
        echo ($context["entry_telephone"] ?? null);
        echo "\" id=\"input-telephone\" class=\"form-control\"/>
\t\t\t\t<div id=\"error-telephone\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group required\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"password\" name=\"password\" value=\"\" placeholder=\"";
        // line 75
        echo ($context["entry_password"] ?? null);
        echo "\" id=\"input-password\" class=\"form-control\"/>
\t\t\t\t<div id=\"error-password\"></div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"form-group\">
\t\t\t<div class=\"col-sm-10\">
\t\t\t\t<input type=\"hidden\" name=\"newsletter\" value=\"0\"/>
\t\t\t\t<input type=\"checkbox\" name=\"newsletter\" value=\"1\" id=\"input-newsletter\" class=\"form-control\"/>
\t\t\t\t<p>Newsletter</p>

\t\t\t</div>
\t\t</div>

\t\t";
        // line 89
        echo ($context["captcha"] ?? null);
        echo "
\t\t<div class=\"form-group required\">
\t\t\t";
        // line 91
        if (($context["text_agree"] ?? null)) {
            // line 92
            echo "\t\t\t\t<div class=\"col-sm-10\">
\t\t\t\t\t<input type=\"checkbox\" name=\"agree\" value=\"1\" class=\"form-control\"/>
\t\t\t\t\t<p>Przeczytałem i zgadzam się z Regulamin sklepu</p>
\t\t\t\t</div>
\t\t\t";
        }
        // line 97
        echo "\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<button type=\"submit\">ZAREJESTRUJ SIĘ</button>
\t\t</div>
\t</form>

\t<div>
\t\t<a href=\"";
        // line 104
        echo ($context["login"] ?? null);
        echo "\">";
        echo ($context["text_login_button"] ?? null);
        echo "</a>
\t</div>
</div>

 <script>
\$( \"#form-register\" ).on( \"submit\", function( event ) {
  event.preventDefault();
  \$(document).find('.form-error').text('').hide();
  \$.ajax({
\turl: '/index.php?route=account/register/register',
\ttype: 'post',
\tdataType: 'json',
\tdata: \$('#form-register').serialize(),
\tsuccess: function(json) {
\t\t\$('#loader').remove();
\t\tif(json.error) {
\t\t\t\$.each(json.error, function(i, v){
\t\t\t\t\$('#error-'+i).addClass('form-error').text(v).show();
\t\t\t});
\t\t} else if(json.redirect) {
\t\t\twindow.location.href = json.redirect;
\t\t}
\t\t// else {
\t\t// \t\$( \"#form-register\" ).trigger( \"submit\" ); //console.log(json);
\t\t// }
\t},
\terror: function(data) {
\t\t\$('#loader').remove();
\t\tconsole.log(data.responseText);
\t}
  });
});

</script>

";
        // line 139
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/account/register.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  212 => 139,  172 => 104,  163 => 97,  156 => 92,  154 => 91,  149 => 89,  132 => 75,  122 => 68,  112 => 61,  71 => 23,  61 => 16,  54 => 12,  43 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/account/register.twig", "");
    }
}
