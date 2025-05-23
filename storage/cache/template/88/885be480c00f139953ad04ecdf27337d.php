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

/* default/template/common/shop.twig */
class __TwigTemplate_d736d7d7320bfcf9d1bd86e9441e9bde extends Template
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
<div class=\"shop\">
\t";
        // line 3
        if (($context["breadcrumbs"] ?? null)) {
            // line 4
            echo "\t\t<div class=\"breadcrumbs\">
\t\t\t";
            // line 5
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
                // line 6
                echo "\t\t\t\t<div>
\t\t\t\t\t";
                // line 7
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 7)) {
                    // line 8
                    echo "\t\t\t\t\t\t<span class=\"last\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 8);
                    echo "</span>
\t\t\t\t\t";
                } else {
                    // line 10
                    echo "\t\t\t\t\t\t<a class=\"link\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 10);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 10);
                    echo "</a>
\t\t\t\t\t\t<span>
\t\t\t\t\t\t\t/
\t\t\t\t\t\t</span>
\t\t\t\t\t\t<!-- Разделитель -->
\t\t\t\t\t";
                }
                // line 16
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
            // line 18
            echo "\t\t</div>
\t";
        }
        // line 20
        echo "
\t<div id=\"categories-menu\" class=\"modal-menu\">
\t\t<div class=\"top\">
\t\t\t<div class=\"title\">Kategorie produktów</div>
\t\t\t<span class=\"close-btn\" id=\"categories-menu-close\">&times;</span>
\t\t</div>
\t\t<div class=\"categories-list\">
\t\t\t";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["shop_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 28
            echo "\t\t\t\t<a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 28);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 28);
            echo "</a>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "\t\t</div>
\t</div>


\t<div class=\"title\">
\t\tSklep
\t</div>
\t<div class=\"sorters\">
\t\t<div class=\"sorter\">

\t\t\t<div class=\"dropdown-trigger\">
\t\t\t\t<img src=\"image/catalog/assets/categories_ico.svg\" alt=\"Sortowanie\"/>
\t\t\t\t<span id=\"param-sorter-text\" class=\"trigger-text\">Kategoria</span>
\t\t\t</div>
\t\t\t<div class=\"dropdown-menu\">
\t\t\t\t";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["shop_categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 46
            echo "\t\t\t\t\t<div class=\"dropdown-item\">
\t\t\t\t\t\t<a href=";
            // line 47
            echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 47);
            echo ">
\t\t\t\t\t\t\t";
            // line 48
            echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 48);
            echo "</a>

\t\t\t\t\t</div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "\t\t\t</div>
\t\t</div>

\t\t<div class=\"sorter\">
\t\t\t<div class=\"dropdown\">
\t\t\t\t<div class=\"dropdown-trigger\">
\t\t\t\t\t<img src=\"image/catalog/assets/sorting_ico.svg\" alt=\"Sortowanie\"/>
\t\t\t\t\t<span id=\"param-sorter-text\" class=\"trigger-text\">Sortowanie</span>
\t\t\t\t</div>
\t\t\t\t<div class=\"dropdown-menu\">
\t\t\t\t\t";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["sorts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["sort_option"]) {
            // line 63
            echo "\t\t\t\t\t\t<div class=\"dropdown-item\" data-value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["sort_option"], "value", [], "any", false, false, false, 63);
            echo "\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["sort_option"], "value", [], "any", false, false, false, 63) == ($context["sort"] ?? null))) {
                echo " class=\"selected\" ";
            }
            echo ">
\t\t\t\t\t\t\t";
            // line 64
            echo twig_get_attribute($this->env, $this->source, $context["sort_option"], "text", [], "any", false, false, false, 64);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sort_option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div id=\"products-list\" class=\"products-list\"></div>
\t<div id=\"pagination\" class=\"pagination\"></div>


</div>


";
        // line 79
        echo ($context["footer"] ?? null);
        echo "

 <script>
document.addEventListener(\"DOMContentLoaded\", function() {
    // Получаем путь из URL, например: \"/owoce-w-syropie\"
    var path = window.location.pathname;
    // Разбиваем путь по \"/\" и отфильтровываем пустые элементы
    var segments = path.split('/').filter(function(segment) {
        return segment.length > 0;
    });

    if (segments.length > 0) {
        // Берём последний сегмент, который содержит имя категории
        var lastSegment = segments[segments.length - 1];
        // Заменяем тире (и возможные подчеркивания) на пробелы
        var formattedText = lastSegment.replace(/[-_]+/g, ' ');
        // Делаем первую букву заглавной
        formattedText = formattedText.charAt(0).toUpperCase() + formattedText.slice(1);

        // Ищем триггер для категории по alt у изображения
        var categoryImage = document.querySelector('.dropdown-trigger img[alt=\"Kategorie produktów\"]');
        if (categoryImage) {
            var triggerTextElem = categoryImage.parentElement.querySelector('.trigger-text');
            if (triggerTextElem) {
                triggerTextElem.textContent = formattedText;
            }
        }
    }

\t    // Получаем параметр сортировки из URL
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    const sorterTextElem = document.getElementById('param-sorter-text');

    if (sortParam && sorterTextElem) {
        let displayText = '';
        switch (sortParam) {
            case 'popularity':
                displayText = 'popularność';
                break;
            case 'rating':
            case 'rating-DESC':
                displayText = 'ocena ↓';
                break;
            case 'rating-ASC':
                displayText = 'ocena ↑';
                break;
            case 'newest':
                displayText = 'najnowsze';
                break;
            case 'p.price-ASC':
                displayText = 'cena ↑';
                break;
            case 'p.price-DESC':
                displayText = 'cena ↓';
                break;
            case 'pd.name-ASC':
                displayText = 'A<Z';
                break;
            case 'pd.name-DESC':
                displayText = 'Z>A';
                break;
            case 'p.model-ASC':
                displayText = 'model A<Z';
                break;
            case 'p.model-DESC':
                displayText = 'model Z>A';
                break;
            default:
                displayText = 'Sortowanie';
        }
        sorterTextElem.textContent = displayText;
    }
});


  document.addEventListener('click', function(e) {
    // Если клик произошёл по триггеру — переключаем видимость меню
    const trigger = e.target.closest('.dropdown-trigger');
    if (trigger) {
      const dropdown = trigger.parentElement;
      const menu = dropdown.querySelector('.dropdown-menu');
      // Переключаем отображение меню
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    } else {
      // Если клик вне dropdown — скрываем все меню
      document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
      });
    }
  });

  // Обработка кликов по элементам выпадающего списка
  document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
      // Если элемент имеет data-href — переходим по ссылке
      const href = this.getAttribute('data-href');
      if (href !== null && href !== '') {
        window.location.href = href;
      }
      // Если есть data-value, обновляем сортировку через URL-параметр sort
      const value = this.getAttribute('data-value');
      if (value !== null && value !== '') {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', value);
        window.location.href = url.toString();
      }
    });
  });

  
</script>
";
    }

    public function getTemplateName()
    {
        return "default/template/common/shop.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 79,  202 => 67,  193 => 64,  184 => 63,  180 => 62,  168 => 52,  158 => 48,  154 => 47,  151 => 46,  147 => 45,  130 => 30,  119 => 28,  115 => 27,  106 => 20,  102 => 18,  87 => 16,  75 => 10,  69 => 8,  67 => 7,  64 => 6,  47 => 5,  44 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/shop.twig", "");
    }
}
