<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* menu.html.twig */
class __TwigTemplate_311d9f3feac0a7a1999d101284542685 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 54
        yield "
";
        // line 60
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->getTemplateForMacro("macro_menu_links", $context, 60, $this->getSourceContext())->macro_menu_links(...[($context["items"] ?? null), ($context["attributes"] ?? null), 0, ((($context["classes"] ?? null)) ?: (["menu", ("menu--" . \Drupal\Component\Utility\Html::getClass(($context["menu_name"] ?? null))), "nav"])), ((($context["dropdown_classes"] ?? null)) ?: (["dropdown-menu"]))]));
        yield "
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["items", "attributes", "classes", "menu_name", "dropdown_classes", "menu_level", "loop"]);        yield from [];
    }

    // line 22
    public function macro_menu_links($items = null, $attributes = null, $menu_level = null, $classes = null, $dropdown_classes = null, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "items" => $items,
            "attributes" => $attributes,
            "menu_level" => $menu_level,
            "classes" => $classes,
            "dropdown_classes" => $dropdown_classes,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 23
            yield "  ";
            if (($context["items"] ?? null)) {
                // line 24
                yield "    <ul";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [(((($context["menu_level"] ?? null) == 0)) ? (($context["classes"] ?? null)) : (($context["dropdown_classes"] ?? null)))], "method", false, false, true, 24), "html", null, true);
                yield ">
    ";
                // line 25
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["items"] ?? null));
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
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 26
                    yield "      ";
                    // line 27
                    $context["item_classes"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 27), "getOption", ["container_attributes"], "method", false, false, true, 27), "class", [], "any", false, false, true, 27);
                    // line 29
                    yield "      ";
                    // line 30
                    $context["item_classes"] = [(((CoreExtension::getAttribute($this->env, $this->source,                     // line 31
$context["item"], "is_expanded", [], "any", false, false, true, 31) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 31))) ? ("expanded dropdown") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 32
$context["item"], "in_active_trail", [], "any", false, false, true, 32)) ? ("active active-trail") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 33
$context["loop"], "first", [], "any", false, false, true, 33)) ? ("first") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 34
$context["loop"], "last", [], "any", false, false, true, 34)) ? ("last") : (""))];
                    // line 37
                    yield "      <li";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 37), "addClass", [($context["item_classes"] ?? null)], "method", false, false, true, 37), "html", null, true);
                    yield ">
        ";
                    // line 38
                    $context["link_title"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 38);
                    // line 39
                    yield "        ";
                    $context["link_attributes"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link_attributes", [], "any", false, false, true, 39);
                    // line 40
                    yield "        ";
                    if ((((($context["menu_level"] ?? null) == 0) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "is_expanded", [], "any", false, false, true, 40)) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 40))) {
                        // line 41
                        yield "          ";
                        $context["link_title"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link_title"] ?? null), "html", null, true);
                            yield " <span class=\"caret\"></span>";
                            yield from [];
                        })())) ? '' : new Markup($tmp, $this->env->getCharset());
                        // line 42
                        yield "          ";
                        $context["link_attributes"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["link_attributes"] ?? null), "addClass", ["dropdown-toggle"], "method", false, false, true, 42), "setAttribute", ["data-toggle", "dropdown"], "method", false, false, true, 42);
                        // line 43
                        yield "        ";
                    }
                    // line 44
                    yield "        ";
                    // line 45
                    yield "        ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink(($context["link_title"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 45), CoreExtension::getAttribute($this->env, $this->source, ($context["link_attributes"] ?? null), "addClass", [((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "in_active_trail", [], "any", false, false, true, 45)) ? ("active-trail") : (""))], "method", false, false, true, 45)), "html", null, true);
                    yield "
        ";
                    // line 46
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 46)) {
                        // line 47
                        yield "          ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->getTemplateForMacro("macro_menu_links", $context, 47, $this->getSourceContext())->macro_menu_links(...[CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 47), CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "removeClass", [($context["classes"] ?? null)], "method", false, false, true, 47), (($context["menu_level"] ?? null) + 1), ($context["classes"] ?? null), ($context["dropdown_classes"] ?? null)]));
                        yield "
        ";
                    }
                    // line 49
                    yield "      </li>
    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                yield "    </ul>
  ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "menu.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  164 => 51,  149 => 49,  143 => 47,  141 => 46,  136 => 45,  134 => 44,  131 => 43,  128 => 42,  121 => 41,  118 => 40,  115 => 39,  113 => 38,  108 => 37,  106 => 34,  105 => 33,  104 => 32,  103 => 31,  102 => 30,  100 => 29,  98 => 27,  96 => 26,  79 => 25,  74 => 24,  71 => 23,  55 => 22,  47 => 60,  44 => 54,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "menu.html.twig", "themes/contrib/bootstrap/templates/menu/menu.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("macro" => 22, "if" => 23, "for" => 25, "set" => 27);
        static $filters = array("clean_class" => 60, "escape" => 24);
        static $functions = array("link" => 45);

        try {
            $this->sandbox->checkSecurity(
                ['macro', 'if', 'for', 'set'],
                ['clean_class', 'escape'],
                ['link'],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
