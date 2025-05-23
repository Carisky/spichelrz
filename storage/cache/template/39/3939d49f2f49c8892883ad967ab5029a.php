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

/* default/template/blog/category.twig */
class __TwigTemplate_de2ab57aa019990374bb4a59e1b5901c extends Template
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
.page-title {
\tfont-family: 'Playfair Display';
\tfont-style: normal;
\tfont-weight: 700;
\tfont-size: 58px;
\tline-height: 1;
\tmargin-bottom: 20px;
\ttext-transform: uppercase;
  }
  .blog-top {
\tmargin-bottom: 113px;
\tmax-width: 50%;
  }
@media (max-width: 1199px) {
  .blog-top {
    margin-bottom: 86px;
  }
}
@media (max-width: 991px) {
  .blog-top {
    margin-bottom: 40px;
  }
}
@media (max-width: 767px) {
  .blog-top {
    max-width: 48%;
    margin-bottom: 20px;
  }
}
@media (max-width: 600px) {
  .blog-top {
    max-width: 100%;
    padding-right: 10%;
  }
}
  .fww {
\t-webkit-flex-wrap: wrap;
\t-ms-flex-wrap: wrap;
\tflex-wrap: wrap;
  }
  .jcsb {
\t-webkit-box-pack: justify;
\t-webkit-justify-content: space-between;
\t-moz-box-pack: justify;
\t-ms-flex-pack: justify;
\tjustify-content: space-between;
  }
  .blog-item {
\twidth: 598px;
\tmargin-left:auto;
\tmargin-right:auto;
\tmargin-top:10%
  }
@media (max-width: 1349px) {
  .blog-item {
    width: 520px;
\tmargin-left:auto;
\tmargin-right:auto;
  }
}
@media (max-width: 1199px) {
  .blog-item {
    width: 430px;
  }
}
@media (max-width: 991px) {
  .blog-item {
    width: 340px;
  }
}
@media (max-width: 767px) {
  .blog-item {
    width: 48%;
  }
}
@media (max-width: 600px) {
  .blog-item {
    margin: 30px 0;
    width: 100%;
  }
}
  .blog-item h4 {
\tfont-family: 'Playfair Display';
\tfont-weight: 700;
\tfont-size: 28px;
\tline-height: 1.3;
\ttext-transform: uppercase;
  }
  .posr {
\tposition: relative;
  }
  .blog-item.odd {
\ttransform: translateY(-300px);
  }
@media (max-width: 991px) {
  .blog-item.odd {
    transform: translateY(-236px);
  }
}
@media (max-width: 767px) {
  .blog-item.odd {
    transform: translateY(-198px);
  }
}
@media (max-width: 600px) {
  .blog-item.odd {
    transform: translateY(0);
  }
}
  .blog-image {
\tpadding-top: 124%;
  }
  .blog-image .inner {
\tborder-radius: 60px;
\toverflow: hidden;
  }
  .blog-image img {
\theight: 100%;
\twidth: 100%;
\tobject-fit: cover;
  }
  .pp {
\tleft: 0;
\tright: 0;
\ttop: 0;
\tbottom: 0;
\tdisplay: block;
\tz-index: 2;
  }
  .jcc, .checkbox > b {
\t-webkit-box-pack: center;
\t-webkit-justify-content: center;
\t-moz-box-pack: center;
\t-ms-flex-pack: center;
\tjustify-content: center;
  }
  .aic, .checkbox > b {
\t-webkit-box-align: center;
\t-webkit-align-items: center;
\t-moz-box-align: center;
\t-ms-flex-align: center;
\talign-items: center;
  }
  .df, .checkbox > b {
\tdisplay: -webkit-box;
\tdisplay: -webkit-flex;
\tdisplay: -moz-box;
\tdisplay: -ms-flexbox;
\tdisplay: flex;
  }
#blog, #blog-article {
  margin-bottom: 220px;
}
@media (min-width: 768px) {
  .bcontainer {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .bcontainer {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .bcontainer {
    width: 1170px;
  }
}
@media (min-width: 1350px) {
  .bcontainer {
    width: 1300px;
  }
}
@media (min-width: 1510px) {
  .bcontainer {
    width: 1486px;
  }
}
.bcontainer {
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
/* .blog-wrapper {
  padding-top: 160px;
} */
 @media (max-width: 1440px) {
\t.blog-row {
\t  max-width: 750px;
\t  margin: auto;
\t  max-width: 100vw;
\t}
  }
@media (max-width: 600px) {
\t.blog-row {
\t  max-width: 450px;
\t  margin: 0 auto;
\t}
  }
* {
\tbox-sizing: border-box;
\toutline: 0 !important;
\t-webkit-tap-highlight-color: transparent !important;
}
img {max-width: 100%;}
</style>
<div id=\"blog\" class=\"blog-wrapper bcontainer\">
\t<div class=\"breadcrumbs df fww\">
    ";
        // line 212
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
            // line 213
            echo "\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 213)) {
                // line 214
                echo "\t\t<span>";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 214);
                echo "</span>
\t\t";
            } else {
                // line 216
                echo "\t\t<a href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 216);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 216);
                echo "</a>
\t\t<i>/</i>
\t\t";
            }
            // line 219
            echo "    ";
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
        // line 220
        echo "\t</div>
\t<div class=\"blog-listing\">
\t\t<div class=\"blog-top\">
\t\t\t<h1 class=\"page-title\">";
        // line 223
        echo ($context["heading_title"] ?? null);
        echo "</h1>
\t\t\t";
        // line 224
        if (($context["description"] ?? null)) {
            // line 225
            echo "\t\t\t<div class=\"blog-category-description\">";
            echo ($context["description"] ?? null);
            echo "</div>
\t\t\t";
        }
        // line 227
        echo "\t\t</div>
\t\t";
        // line 228
        if (($context["articles"] ?? null)) {
            // line 229
            echo "\t\t<div class=\"blog-row df fww jcsb\">
\t\t\t";
            // line 230
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                echo " 
\t\t\t<div class=\"blog-item posr ";
                // line 231
                echo (((twig_get_attribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, false, 231) % 2 != 0)) ? ("odd") : ("even"));
                echo "\">
\t\t\t\t<div class=\"blog-image posr\">
\t\t\t\t\t<div class=\"inner posa pp df aic jcc\">
\t\t\t\t\t\t<img src=\"";
                // line 234
                echo twig_get_attribute($this->env, $this->source, $context["article"], "thumb", [], "any", false, false, false, 234);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["article"], "name", [], "any", false, false, false, 234);
                echo "\">
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<h4>";
                // line 237
                echo twig_get_attribute($this->env, $this->source, $context["article"], "name", [], "any", false, false, false, 237);
                echo "</h4>
\t\t\t\t<a class=\"pp posa\" href=\"";
                // line 238
                echo twig_get_attribute($this->env, $this->source, $context["article"], "href", [], "any", false, false, false, 238);
                echo "\"></a>
\t\t\t</div>
\t\t\t";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 241
            echo "\t\t</div>
\t\t";
            // line 242
            echo ($context["pagination"] ?? null);
            echo "
\t\t";
        } else {
            // line 244
            echo "\t\t<p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
\t\t";
        }
        // line 246
        echo "\t\t";
        echo ($context["content_top"] ?? null);
        echo "
\t</div>
\t";
        // line 248
        echo ($context["content_bottom"] ?? null);
        echo "
\t";
        // line 249
        echo ($context["column_right"] ?? null);
        echo "
";
        // line 250
        echo ($context["column_left"] ?? null);
        echo "
</div>
";
        // line 252
        echo ($context["footer"] ?? null);
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "default/template/blog/category.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  412 => 252,  407 => 250,  403 => 249,  399 => 248,  393 => 246,  387 => 244,  382 => 242,  379 => 241,  362 => 238,  358 => 237,  350 => 234,  344 => 231,  325 => 230,  322 => 229,  320 => 228,  317 => 227,  311 => 225,  309 => 224,  305 => 223,  300 => 220,  286 => 219,  277 => 216,  271 => 214,  268 => 213,  251 => 212,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/blog/category.twig", "");
    }
}
