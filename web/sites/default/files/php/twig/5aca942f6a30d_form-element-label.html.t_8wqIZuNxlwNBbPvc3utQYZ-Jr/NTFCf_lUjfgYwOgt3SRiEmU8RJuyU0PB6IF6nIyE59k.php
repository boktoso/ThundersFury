<?php

/* themes/custom/atlas-bootstrap/templates/input/form-element-label.html.twig */
class __TwigTemplate_62ae4fede03e28cbaef3f629480db5d47b9a88eff9651baa15053f1d9f672667 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 20, "if" => 28);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 20
        $context["classes"] = array(0 => "control-label", 1 => (((        // line 22
($context["title_display"] ?? null) == "after")) ? ("option") : ("")), 2 => (((        // line 23
($context["title_display"] ?? null) == "invisible")) ? ("sr-only") : ("")), 3 => ((        // line 24
($context["required"] ?? null)) ? ("js-form-required") : ("")), 4 => ((        // line 25
($context["required"] ?? null)) ? ("form-required") : ("")));
        // line 28
        if ( !twig_test_empty(($context["title"] ?? null))) {
            // line 29
            echo "<label";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute(($context["attributes"] ?? null), "addClass", array(0 => ($context["classes"] ?? null)), "method"), "html", null, true));
            echo ">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["element"] ?? null), "html", null, true));
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["title"] ?? null), "html", null, true));
            // line 30
            if (($context["description"] ?? null)) {
                // line 31
                echo "<p class=\"help-block\">";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["description"] ?? null), "html", null, true));
                echo "</p>";
            }
            // line 33
            echo "</label>";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/atlas-bootstrap/templates/input/form-element-label.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 33,  59 => 31,  57 => 30,  51 => 29,  49 => 28,  47 => 25,  46 => 24,  45 => 23,  44 => 22,  43 => 20,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "themes/custom/atlas-bootstrap/templates/input/form-element-label.html.twig", "/var/www/thunder/web/themes/custom/atlas-bootstrap/templates/input/form-element-label.html.twig");
    }
}
