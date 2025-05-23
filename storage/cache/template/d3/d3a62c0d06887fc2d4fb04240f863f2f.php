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

/* default/template/product/category.twig */
class __TwigTemplate_307ebd9450dfe65e3b01221e7b719aed extends Template
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
";
        // line 2
        echo ($context["test_var"] ?? null);
        echo "
<div class=\"shop\">
\t";
        // line 4
        if (($context["breadcrumbs"] ?? null)) {
            // line 5
            echo "\t\t<div class=\"breadcrumbs\">
\t\t\t";
            // line 6
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
                // line 7
                echo "\t\t\t\t<div>
\t\t\t\t\t";
                // line 8
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 8)) {
                    // line 9
                    echo "\t\t\t\t\t\t<span class=\"last\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 9);
                    echo "</span>
\t\t\t\t\t";
                } else {
                    // line 11
                    echo "\t\t\t\t\t\t<a class=\"link\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
                    echo "</a>
\t\t\t\t\t\t<span>/</span>
\t\t\t\t\t";
                }
                // line 14
                echo "\t\t\t\t</div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "\t\t</div>
\t";
        }
        // line 18
        echo "

\t<div class=\"title\">Sklep</div>

\t<div class=\"sorters\">
\t\t<div class=\"sorter\">
\t\t\t<div class=\"dropdown\">
\t\t\t\t<div class=\"dropdown-trigger\">
\t\t\t\t\t<img src=\"image/catalog/assets/categories_ico.svg\" alt=\"Kategorie produktów\"/>
\t\t\t\t\t<span class=\"trigger-text\">Kategorie produktów</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"dropdown-menu\">
\t\t\t\t\t<div class=\"dropdown-item\" data-href=\"\">Kategorie produktów</div>
\t\t\t\t\t";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 32
            echo "\t\t\t\t\t\t<div class=\"dropdown-item\" data-href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 32);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 32);
            echo "</div>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"sorter\">
\t\t\t<div class=\"dropdown\">
\t\t\t\t<div class=\"dropdown-trigger\">
\t\t\t\t\t<img src=\"image/catalog/assets/sorting_ico.svg\" alt=\"Sortowanie\"/>
\t\t\t\t\t<span id=\"param-sorter-text\" class=\"trigger-text\">Sortowanie</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"dropdown-menu\">
\t\t\t\t\t";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sorts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sort_option"]) {
            // line 46
            echo "\t\t\t\t\t\t<div class=\"dropdown-item\" data-value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["sort_option"], "value", [], "any", false, false, false, 46);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["sort_option"], "value", [], "any", false, false, false, 46) == ($context["sort"] ?? null))) {
                echo " class=\"selected\" ";
            }
            echo ">
\t\t\t\t\t\t\t";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["sort_option"], "text", [], "any", false, false, false, 47);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort_option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>


</div>


<div id=\"products-list\" class=\"products-list\">
  
</div>

<div id=\"pagination\" class=\"pagination\">";
        // line 63
        echo ($context["pagination"] ?? null);
        echo "</div>

<div class=\"additional\">
\t<div class=\"block\">
\t\t";
        // line 67
        echo ($context["description"] ?? null);
        echo "
\t</div>
</div></div> <script>
\tdocument.addEventListener(\"DOMContentLoaded\", function() {
\t    // Получаем путь из URL, например: \"/owoce-w-syropie\"
\t    var path = window.location.pathname;
\t    // Разбиваем путь по \"/\" и отфильтровываем пустые элементы
\t    var segments = path.split('/').filter(function(segment) {
\t        return segment.length > 0;
\t    });
\t    if (segments.length > 0) {
\t        // Берём последний сегмент, который содержит имя категории
\t        var lastSegment = segments[segments.length - 1];
\t        // Заменяем тире (и возможные подчеркивания) на пробелы
\t        var formattedText = lastSegment.replace(/[-_]+/g, ' ');
\t        // Делаем первую букву заглавной
\t        formattedText = formattedText.charAt(0).toUpperCase() + formattedText.slice(1);
\t
\t        // Ищем триггер для категории по alt у изображения
\t        var categoryImage = document.querySelector('.dropdown-trigger img[alt=\"Kategorie produktów\"]');
\t        if (categoryImage) {
\t            var triggerTextElem = categoryImage.parentElement.querySelector('.trigger-text');
\t            if (triggerTextElem) {
\t                triggerTextElem.textContent = formattedText;
\t            }
\t        }
\t    }
\t
\t
\t\t    // Получаем параметр сортировки из URL
\t    const urlParams = new URLSearchParams(window.location.search);
\t    const sortParam = urlParams.get('sort');
\t    const sorterTextElem = document.getElementById('param-sorter-text');
\t
\t    if (sortParam && sorterTextElem) {
\t        let displayText = '';
\t        switch (sortParam) {
\t            case 'popularity':
\t                displayText = 'popularność';
\t                break;
\t            case 'rating':
\t            case 'rating-DESC':
\t                displayText = 'ocena ↓';
\t                break;
\t            case 'rating-ASC':
\t                displayText = 'ocena ↑';
\t                break;
\t            case 'newest':
\t                displayText = 'najnowsze';
\t                break;
\t            case 'p.price-ASC':
\t                displayText = 'cena ↑';
\t                break;
\t            case 'p.price-DESC':
\t                displayText = 'cena ↓';
\t                break;
\t            case 'pd.name-ASC':
\t                displayText = 'A<Z';
\t                break;
\t            case 'pd.name-DESC':
\t                displayText = 'Z>A';
\t                break;
\t            case 'p.model-ASC':
\t                displayText = 'model A<Z';
\t                break;
\t            case 'p.model-DESC':
\t                displayText = 'model Z>A';
\t                break;
\t            default:
\t                displayText = 'Sortowanie';
\t        }
\t        sorterTextElem.textContent = displayText;
\t    }
\t});
\t
\t
\t  document.addEventListener('click', function(e) {
\t    // Если клик произошёл по триггеру — переключаем видимость меню
\t    const trigger = e.target.closest('.dropdown-trigger');
\t    if (trigger) {
\t      const dropdown = trigger.parentElement;
\t      const menu = dropdown.querySelector('.dropdown-menu');
\t      // Переключаем отображение меню
\t      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
\t    } else {
\t      // Если клик вне dropdown — скрываем все меню
\t      document.querySelectorAll('.dropdown-menu').forEach(menu => {
\t        menu.style.display = 'none';
\t      });
\t    }
\t  });
\t
\t  // Обработка кликов по элементам выпадающего списка
\t  document.querySelectorAll('.dropdown-item').forEach(item => {
\t    item.addEventListener('click', function() {
\t      // Если элемент имеет data-href — переходим по ссылке
\t      const href = this.getAttribute('data-href');
\t      if (href !== null && href !== '') {
\t        window.location.href = href;
\t      }
\t      // Если есть data-value, обновляем сортировку через URL-параметр sort
\t      const value = this.getAttribute('data-value');
\t      if (value !== null && value !== '') {
\t        const url = new URL(window.location.href);
\t        url.searchParams.set('sort', value);
\t        window.location.href = url.toString();
\t      }
\t    });
\t  });
\t
\t  
\t</script>";
        // line 178
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "default/template/product/category.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  308 => 178,  194 => 67,  187 => 63,  172 => 50,  163 => 47,  154 => 46,  150 => 45,  137 => 34,  126 => 32,  122 => 31,  107 => 18,  103 => 16,  88 => 14,  79 => 11,  73 => 9,  71 => 8,  68 => 7,  51 => 6,  48 => 5,  46 => 4,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/product/category.twig", "");
    }
}
