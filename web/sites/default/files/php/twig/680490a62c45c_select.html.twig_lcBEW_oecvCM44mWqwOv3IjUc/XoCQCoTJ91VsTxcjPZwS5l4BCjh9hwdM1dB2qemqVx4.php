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

/* themes/contrib/bootstrap/templates/input/select.html.twig */
class __TwigTemplate_ac1d751f7e36bb429d07d4014aa3692e extends Template
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
        $_v0 = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 19
            yield "  ";
            if (($context["input_group"] ?? null)) {
                // line 20
                yield "    <div class=\"input-group\">
  ";
            }
            // line 22
            yield "
  ";
            // line 23
            if (($context["prefix"] ?? null)) {
                // line 24
                yield "    ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["prefix"] ?? null), "html", null, true);
                yield "
  ";
            }
            // line 26
            yield "
  ";
            // line 31
            yield "  ";
            if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "offsetExists", ["multiple"], "method", false, false, true, 31)) {
                // line 32
                yield "    <div class=\"select-wrapper\">
  ";
            }
            // line 34
            yield "    ";
            $context["classes"] = ["form-control"];
            // line 35
            yield "    <select";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 35), "html", null, true);
            yield ">
      ";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 37
                yield "        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, true, 37) == "optgroup")) {
                    // line 38
                    yield "          <optgroup label=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "label", [], "any", false, false, true, 38), "html", null, true);
                    yield "\">
            ";
                    // line 39
                    $context['_parent'] = $context;
                    $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["option"], "options", [], "any", false, false, true, 39));
                    foreach ($context['_seq'] as $context["_key"] => $context["sub_option"]) {
                        // line 40
                        yield "              <option
                value=\"";
                        // line 41
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["sub_option"], "value", [], "any", false, false, true, 41), "html", null, true);
                        yield "\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((CoreExtension::getAttribute($this->env, $this->source, $context["sub_option"], "selected", [], "any", false, false, true, 41)) ? (" selected=\"selected\"") : ("")));
                        yield ">";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["sub_option"], "label", [], "any", false, false, true, 41), "html", null, true);
                        yield "</option>
            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_key'], $context['sub_option'], $context['_parent']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 43
                    yield "          </optgroup>
        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 44
$context["option"], "type", [], "any", false, false, true, 44) == "option")) {
                    // line 45
                    yield "          <option
            value=\"";
                    // line 46
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, true, 46), "html", null, true);
                    yield "\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((CoreExtension::getAttribute($this->env, $this->source, $context["option"], "selected", [], "any", false, false, true, 46)) ? (" selected=\"selected\"") : ("")));
                    yield ">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["option"], "label", [], "any", false, false, true, 46), "html", null, true);
                    yield "</option>
        ";
                }
                // line 48
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['option'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            yield "    </select>
  ";
            // line 50
            if ( !CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "offsetExists", ["multiple"], "method", false, false, true, 50)) {
                // line 51
                yield "    </div>
  ";
            }
            // line 53
            yield "
  ";
            // line 54
            if (($context["suffix"] ?? null)) {
                // line 55
                yield "    ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["suffix"] ?? null), "html", null, true);
                yield "
  ";
            }
            // line 57
            yield "
  ";
            // line 58
            if (($context["input_group"] ?? null)) {
                // line 59
                yield "    </div>
  ";
            }
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::spaceless($_v0));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["input_group", "prefix", "attributes", "options", "suffix"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/templates/input/select.html.twig";
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
        return array (  167 => 18,  161 => 59,  159 => 58,  156 => 57,  150 => 55,  148 => 54,  145 => 53,  141 => 51,  139 => 50,  136 => 49,  130 => 48,  121 => 46,  118 => 45,  116 => 44,  113 => 43,  101 => 41,  98 => 40,  94 => 39,  89 => 38,  86 => 37,  82 => 36,  77 => 35,  74 => 34,  70 => 32,  67 => 31,  64 => 26,  58 => 24,  56 => 23,  53 => 22,  49 => 20,  46 => 19,  44 => 18,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap/templates/input/select.html.twig", "/var/www/html/web/themes/contrib/bootstrap/templates/input/select.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("apply" => 18, "if" => 19, "set" => 34, "for" => 36);
        static $filters = array("escape" => 24, "spaceless" => 18);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['apply', 'if', 'set', 'for'],
                ['escape', 'spaceless'],
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
