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

/* core/modules/layout_discovery/layouts/twocol_bricks/layout--twocol-bricks.html.twig */
class __TwigTemplate_5aab237dab4746acf4882c6355124616 extends Template
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
        // line 18
        $context["classes"] = ["layout", "layout--twocol-bricks"];
        // line 23
        if (($context["content"] ?? null)) {
            // line 24
            yield "  <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 24), "html", null, true);
            yield ">
    ";
            // line 25
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "top", [], "any", false, false, true, 25)) {
                // line 26
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "top", [], "any", false, false, true, 26), "addClass", ["layout__region", "layout__region--top"], "method", false, false, true, 26), "html", null, true);
                yield ">
        ";
                // line 27
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "top", [], "any", false, false, true, 27), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 30
            yield "
    ";
            // line 31
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first_above", [], "any", false, false, true, 31)) {
                // line 32
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "first_above", [], "any", false, false, true, 32), "addClass", ["layout__region", "layout__region--first-above"], "method", false, false, true, 32), "html", null, true);
                yield ">
        ";
                // line 33
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first_above", [], "any", false, false, true, 33), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 36
            yield "
    ";
            // line 37
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second_above", [], "any", false, false, true, 37)) {
                // line 38
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "second_above", [], "any", false, false, true, 38), "addClass", ["layout__region", "layout__region--second-above"], "method", false, false, true, 38), "html", null, true);
                yield ">
        ";
                // line 39
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second_above", [], "any", false, false, true, 39), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 42
            yield "
    ";
            // line 43
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "middle", [], "any", false, false, true, 43)) {
                // line 44
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "middle", [], "any", false, false, true, 44), "addClass", ["layout__region", "layout__region--middle"], "method", false, false, true, 44), "html", null, true);
                yield ">
        ";
                // line 45
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "middle", [], "any", false, false, true, 45), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 48
            yield "
    ";
            // line 49
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first_below", [], "any", false, false, true, 49)) {
                // line 50
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "first_below", [], "any", false, false, true, 50), "addClass", ["layout__region", "layout__region--first-below"], "method", false, false, true, 50), "html", null, true);
                yield ">
        ";
                // line 51
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "first_below", [], "any", false, false, true, 51), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 54
            yield "
    ";
            // line 55
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second_below", [], "any", false, false, true, 55)) {
                // line 56
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "second_below", [], "any", false, false, true, 56), "addClass", ["layout__region", "layout__region--second-below"], "method", false, false, true, 56), "html", null, true);
                yield ">
        ";
                // line 57
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "second_below", [], "any", false, false, true, 57), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 60
            yield "
    ";
            // line 61
            if (CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "bottom", [], "any", false, false, true, 61)) {
                // line 62
                yield "      <div ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["region_attributes"] ?? null), "bottom", [], "any", false, false, true, 62), "addClass", ["layout__region", "layout__region--bottom"], "method", false, false, true, 62), "html", null, true);
                yield ">
        ";
                // line 63
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "bottom", [], "any", false, false, true, 63), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 66
            yield "  </div>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content", "attributes", "region_attributes"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/modules/layout_discovery/layouts/twocol_bricks/layout--twocol-bricks.html.twig";
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
        return array (  162 => 66,  156 => 63,  151 => 62,  149 => 61,  146 => 60,  140 => 57,  135 => 56,  133 => 55,  130 => 54,  124 => 51,  119 => 50,  117 => 49,  114 => 48,  108 => 45,  103 => 44,  101 => 43,  98 => 42,  92 => 39,  87 => 38,  85 => 37,  82 => 36,  76 => 33,  71 => 32,  69 => 31,  66 => 30,  60 => 27,  55 => 26,  53 => 25,  48 => 24,  46 => 23,  44 => 18,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "core/modules/layout_discovery/layouts/twocol_bricks/layout--twocol-bricks.html.twig", "/var/www/html/web/core/modules/layout_discovery/layouts/twocol_bricks/layout--twocol-bricks.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 18, "if" => 23);
        static $filters = array("escape" => 24);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                [],
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
