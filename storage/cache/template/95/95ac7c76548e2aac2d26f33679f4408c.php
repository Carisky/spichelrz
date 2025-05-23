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

/* default/template/extension/payment/payu.twig */
class __TwigTemplate_027fc9fa733a62b6979d5c4003655a36 extends Template
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
        echo "<div class=\"buttons\">
    <div class=\"pull-right\">
        <input type=\"button\" value=\"";
        // line 3
        echo ($context["button_confirm"] ?? null);
        echo "\" id=\"button-confirm\" data-loading-text=\"";
        echo ($context["text_loading"] ?? null);
        echo "\" class=\"btn btn-primary\" />
    </div>
</div>
<div id=\"payu-error\"></div>
<script type=\"text/javascript\"><!--
    \$('#button-confirm').on('click', function() {
        \$.ajax({
            type: 'get',
            url: '";
        // line 11
        echo ($context["action"] ?? null);
        echo "',
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                \$('#button-confirm').button('loading');
            },
            complete: function() {
                \$('#button-confirm').button('reset');
            },
            success: function (ret) {
                if (ret.status === 'SUCCESS') {
                    location = ret.redirectUri
                } else {
                    \$('#payu-error').empty().append(ret.message);
                }
            }
        });
    });//--></script>
";
    }

    public function getTemplateName()
    {
        return "default/template/extension/payment/payu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 11,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/extension/payment/payu.twig", "");
    }
}
