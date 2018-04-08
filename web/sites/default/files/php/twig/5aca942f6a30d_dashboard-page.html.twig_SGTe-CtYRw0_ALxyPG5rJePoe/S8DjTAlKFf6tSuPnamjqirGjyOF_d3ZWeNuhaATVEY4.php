<?php

/* modules/custom/gameengine/templates/dashboard-page.html.twig */
class __TwigTemplate_1967fdf2782a3410a58d24173603a89290ff8948a763985a8fc8cced88e44ada extends Twig_Template
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
        $tags = array("include" => 7);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('include'),
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

        // line 1
        echo "<div id=\"wrapper2\" class=\"container\">
\t<div class=\"main-wrapper\">
\t\t<div class=\"main-inner-wrapper\">
\t\t\t<div class=\"world-text-wrapper\" id=\"world-text-wrapper\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-xs-12 world-text\">
\t\t\t\t\t\t";
        // line 7
        $this->loadTemplate("modules/custom/gameengine/templates/dashboard/world-text.html.twig", "modules/custom/gameengine/templates/dashboard-page.html.twig", 7)->display($context);
        // line 8
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"user-text-wrapper\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-xs-12 user-input-wrapper\">
\t\t\t\t\t\t";
        // line 14
        $this->loadTemplate("modules/custom/gameengine/templates/dashboard/input.html.twig", "modules/custom/gameengine/templates/dashboard-page.html.twig", 14)->display($context);
        // line 15
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/gameengine/templates/dashboard-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 15,  61 => 14,  53 => 8,  51 => 7,  43 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "modules/custom/gameengine/templates/dashboard-page.html.twig", "/var/www/thunder/web/modules/custom/gameengine/templates/dashboard-page.html.twig");
    }
}
