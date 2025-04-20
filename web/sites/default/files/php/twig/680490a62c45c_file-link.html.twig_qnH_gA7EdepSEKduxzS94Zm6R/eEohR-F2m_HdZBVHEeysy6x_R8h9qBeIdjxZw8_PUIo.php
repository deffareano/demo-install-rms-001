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

/* themes/contrib/bootstrap/templates/file/file-link.html.twig */
class __TwigTemplate_bbd310fbd61a19aeb5b61a332578ae84 extends Template
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
            // line 20
            $context["classes"] = [((            // line 21
($context["icon_only"] ?? null)) ? ("icon-only") : ("")), (( !            // line 22
($context["icon_only"] ?? null)) ? (("icon-" . \Drupal\Component\Utility\Html::getClass(($context["icon_position"] ?? null)))) : (""))];
            // line 25
            yield "  <span";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 25), "html", null, true);
            yield ">
    ";
            // line 26
            if (($context["icon_only"] ?? null)) {
                // line 27
                yield "      <span class=\"file-icon\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["icon"] ?? null), "html", null, true);
                yield "</span>
      <span class=\"sr-only\">
        <span class=\"file-link\">";
                // line 29
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
                yield "</span>
        <span class=\"file-size\">";
                // line 30
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["file_size"] ?? null), "html", null, true);
                yield "</span>
      </span>
    ";
            } else {
                // line 33
                yield "      ";
                if ((($context["icon_position"] ?? null) == "after")) {
                    // line 34
                    yield "        <span class=\"file-link\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
                    yield "</span><span class=\"file-size\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["file_size"] ?? null), "html", null, true);
                    yield "</span><span class=\"file-icon\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["icon"] ?? null), "html", null, true);
                    yield "</span>
      ";
                } else {
                    // line 36
                    yield "        <span class=\"file-icon\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["icon"] ?? null), "html", null, true);
                    yield "</span><span class=\"file-link\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
                    yield "</span><span class=\"file-size\">";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["file_size"] ?? null), "html", null, true);
                    yield "</span>
      ";
                }
                // line 38
                yield "    ";
            }
            // line 39
            yield "  </span>
";
            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::spaceless($_v0));
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["icon_only", "icon_position", "attributes", "icon", "link", "file_size"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/templates/file/file-link.html.twig";
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
        return array (  106 => 18,  101 => 39,  98 => 38,  88 => 36,  78 => 34,  75 => 33,  69 => 30,  65 => 29,  59 => 27,  57 => 26,  52 => 25,  50 => 22,  49 => 21,  48 => 20,  46 => 19,  44 => 18,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap/templates/file/file-link.html.twig", "/opt/lampp/app/rekod4sekolah/web/themes/contrib/bootstrap/templates/file/file-link.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("apply" => 18, "set" => 20, "if" => 26);
        static $filters = array("clean_class" => 22, "escape" => 25, "spaceless" => 18);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['apply', 'set', 'if'],
                ['clean_class', 'escape', 'spaceless'],
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
